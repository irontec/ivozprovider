<?php

namespace Worker;

use Assert\Assertion;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationRepository;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateRepository;
use Ivoz\Cgr\Domain\Model\TpRate\TpRateRepository;
use Ivoz\Cgr\Infrastructure\Cgrates\Service\ReloadService;
use Ivoz\Core\Domain\RegisterCommandTrait;
use Ivoz\Core\Domain\RequestId;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Ivoz\Provider\Domain\Job\RatesImporterJobInterface;
use Ivoz\Provider\Domain\Model\Destination\DestinationRepository;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateRepository;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupRepository;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Rates
{
    const CHUNK_SIZE = 100;
    const MAX_LINES = 75001;

    use RegisterCommandTrait;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        private EntityManagerInterface $em,
        private DestinationRepository $destinationRepository,
        private DestinationRateGroupRepository $destinationRateGroupRepository,
        private TpDestinationRepository $tpDestinationRepository,
        private DestinationRateRepository $destinationRateRepository,
        private TpRateRepository $tpRateRepository,
        private TpDestinationRateRepository $tpDestinationRateRepository,
        private EntityTools $entityTools,
        private RedisMasterFactory $redisMasterFactory,
        private int $redisDb,
        private int $redisTimeout,
        private Logger $logger,
        private ReloadService $reloadService
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;

        ini_set('default_socket_timeout', (string) $redisTimeout);
    }

    public function import(): Response
    {
        try {
            $params = $this->getJobPayload();

            /** @var DestinationRateGroupInterface | null $destinationRateGroup */
            $destinationRateGroup = $this->destinationRateGroupRepository->find(
                $params['id']
            );

            if (!$destinationRateGroup) {
                $this->logger->error('Unknown destination rate with id ' . $params['id']);
                throw new \Exception('Unknown destination rate');
            }

            $destinationRateGroupId = (int) $destinationRateGroup->getId();
            $brand = $destinationRateGroup->getBrand();
            $brandId = (int) $brand->getId();

            $roundingMethod = $destinationRateGroup->getRoundingMethod();

            /** @var DestinationRateGroupDto $destinationRateGroupDto */
            $destinationRateGroupDto = $this
                ->entityTools
                ->entityToDto(
                    $destinationRateGroup
                );

            $destinationRateGroupDto->setStatus('inProgress');
            $this
                ->entityTools
                ->persistDto(
                    $destinationRateGroupDto,
                    $destinationRateGroup,
                    true
                );

            $this->logger->debug('Importer in progress');

            $importerArguments = $destinationRateGroup
                ->getFile()
                ->getImporterArguments();

            $csvEncoderSettings = [
                CsvEncoder::DELIMITER_KEY => $importerArguments['delimiter'] ?? ',',
                CsvEncoder::ENCLOSURE_KEY => $importerArguments['enclosure'] ?? '"',
                CsvEncoder::ESCAPE_CHAR_KEY => $importerArguments['scape'] ?? '\\'
            ];

            $csvEncoder = new CsvEncoder($csvEncoderSettings);
            $serializer = new Serializer([new ObjectNormalizer()], [$csvEncoder]);
            $csvContents = file_get_contents($destinationRateGroupDto->getFilePath());
            if ($importerArguments['ignoreFirst']) {
                $csvContents = preg_replace('/^.+\n/', '', $csvContents);
            }

            $header = implode(',', $importerArguments['columns']) . "\n";
            $csvContents = $header . $csvContents;

            $unfilterdCsvLines = $serializer->decode(
                $csvContents,
                'csv'
            );

            if (!is_array($unfilterdCsvLines)) {
                $unfilterdCsvLines = [];
            }

            $csvLines = array_map(
                function (array $line): array {
                    unset($line['ignore']);
                    /** $line array<string, string> */
                    return $line;
                },
                $unfilterdCsvLines,
            );

            $destinationRates = [];
            $destinations = [];

            if (current($csvLines) && !is_array(current($csvLines))) {
                // We require an array of arrays
                $csvLines = [$csvLines];
            }

            Assertion::lessOrEqualThan(
                count($csvLines),
                self::MAX_LINES,
                'File cannot exceed ' . self::MAX_LINES . ' lines'
            );

            // Parse every CSV line
            $lineNum = $importerArguments['ignoreFirst']
                ? 1
                : 0;

            $parsedPrefixes = [];

            /** @var array<string,string> $line */
            foreach ($csvLines as $k => $line) {
                $lineNum++;

                // Ignore empty lines
                $isEmptyRow =
                    count($line) === 1
                    && empty(trim($line['destinationName']));

                if ($isEmptyRow) {
                    unset($csvLines[$k]);
                    continue;
                }

                // Trim spaces from every column
                foreach ($line as $key => $column) {
                    $line[$key] = trim($column);
                    $csvLines[$k][$key] = $line[$key];
                }

                // Validate columns number
                Assertion::count(
                    $line,
                    5,
                    'Five columns were expected on line ' . $lineNum
                );

                // Validate destinationName
                Assertion::notEmpty(
                    $line['destinationName'],
                    'Empty destination name was found on line ' . $lineNum
                );

                // Validate destinationPrefix
                Assertion::regex(
                    $line['destinationPrefix'],
                    '/^\\+[0-9]+$/',
                    'Destination prefix does not match expected format on line ' . $lineNum
                );

                $prefixAlreadyUsed = in_array(
                    $line['destinationPrefix'],
                    $parsedPrefixes
                );

                Assertion::false(
                    $prefixAlreadyUsed,
                    'Duplicated prefix on line ' . $lineNum
                );

                // Validate & set format to rateCost
                Assertion::numeric(
                    $line['rateCost'],
                    'Numeric rateCost was expected on line ' . $lineNum
                );
                Assertion::greaterOrEqualThan(
                    $line['rateCost'],
                    0,
                    'rateCost was expected to be >= zero on line ' . $lineNum
                );
                Assertion::true(
                    $line['rateCost'] == floatval($line['rateCost']),
                    'Float rateCost was expected on line ' . $lineNum
                );
                $csvLines[$k]['rateCost'] = floatval($line['rateCost']);

                // Validate & set format to connectionCharge
                Assertion::numeric(
                    $line['connectionCharge'],
                    'Numeric connectionCharge was expected on line ' . $lineNum
                );
                Assertion::greaterOrEqualThan(
                    $line['connectionCharge'],
                    0,
                    'connectionCharge was expected to be >= zero on line ' . $lineNum
                );
                Assertion::true(
                    $line['connectionCharge'] == floatval($line['connectionCharge']),
                    'Float connectionCharge was expected on line ' . $lineNum
                );
                $csvLines[$k]['connectionCharge'] = floatval($line['connectionCharge']);

                // Validate & set format to rateIncrement
                Assertion::numeric(
                    $line['rateIncrement'],
                    'Numeric rateIncrement was expected on line ' . $lineNum
                );
                Assertion::greaterThan(
                    $line['rateIncrement'],
                    0,
                    'rateIncrement was expected to be greater than zero on line ' . $lineNum
                );
                Assertion::integerish(
                    $line['rateIncrement'],
                    'Integer rateIncrement was expected on line ' . $lineNum
                );
                $csvLines[$k]['rateIncrement'] = intval($line['rateIncrement']);

                $destinationName = utf8_encode($line['destinationName']);
                $destinations[] = sprintf(
                    '("%s", "%s", "%s", "%s", "%s", "%d" )',
                    $line['destinationPrefix'],
                    $destinationName,
                    $destinationName,
                    $destinationName,
                    $destinationName,
                    $brandId
                );

                $parsedPrefixes[] = $line['destinationPrefix'];
            }

            if (!$destinations) {
                throw new \Exception(
                    "No lines parsed from CSV File: " . $params['filePath']
                );
            }
        } catch (\Exception $e) {
            $this->logger->error(
                $e->getMessage()
            );

            if (!isset($destinationRateGroupDto)) {
                exit(1);
            }

            if (!isset($destinationRateGroup)) {
                exit(1);
            }

            $destinationRateGroupDto
                ->setStatus('error')
                ->setLastExecutionError(
                    $e->getMessage()
                );

            $this
                ->entityTools
                ->persistDto(
                    $destinationRateGroupDto,
                    $destinationRateGroup,
                    true
                );

            exit(1);
        }

        $disableDestinations = true;

        try {
            $this->em->getConnection()->beginTransaction();

            /**
             * Create any missing Destinations
             */
            $this->logger->debug('About to insert Destinations');
            $destinationChunks = array_chunk($destinations, self::CHUNK_SIZE);
            foreach ($destinationChunks as $destination) {
                $affectedRows = $this
                    ->destinationRepository
                    ->insertIgnoreFromArray($destination);

                // Reload CGRateS destinations only if new prefixes have been added
                if ($affectedRows > 0) {
                    $disableDestinations = false;
                }
            }

            if (!$disableDestinations) {
                /**
                 * Create any missing tp_destinations from Destination table
                 */
                $this->logger->debug('About to insert tp_destinations');
                $this
                    ->tpDestinationRepository
                    ->syncWithBusiness($brandId);
            }

            /**
             *  Update DestinationRates with each CSV row
             */
            $destinationPrefixes = $this
                ->destinationRepository
                ->getPrefixArrayByBrandId($brandId);

            /** @var array<string,string> $line */
            foreach ($csvLines as $line) {
                $prefix = $line['destinationPrefix'];

                $destinationRates[] =
                    sprintf(
                        '("%s", "%s", "%ss", %s, %d)',
                        $line["rateCost"],
                        $line["connectionCharge"],
                        $line["rateIncrement"],
                        $destinationPrefixes[$prefix],
                        $destinationRateGroupId
                    );
            }

            $this->logger->debug('About to insert DestinationRates');
            $tpDestinationRateChunks = array_chunk($destinationRates, self::CHUNK_SIZE);
            foreach ($tpDestinationRateChunks as $destinationRates) {
                $this
                    ->destinationRateRepository
                    ->insertIgnoreFromArray($destinationRates);
            }

            /**
             * Update tp_rates with each DestinationRates row
             */
            $this->logger->debug('About to insert tp_rates');
            $this
                ->tpRateRepository
                ->syncWithBusiness(
                    $destinationRateGroupId
                );

            /**
             * Update tp_destination_rates with each DestinationRates row
             */
            $this
                ->tpDestinationRateRepository
                ->syncWithBussines($destinationRateGroupId, $roundingMethod);

            $destinationRateGroupDto
                ->setStatus('imported')
                ->setLastExecutionError(null);

            $this
                ->entityTools
                ->persistDto(
                    $destinationRateGroupDto,
                    $destinationRateGroup,
                    true
                );

            $this->em->getConnection()->commit();
        } catch (\Exception $exception) {
            $this->logger->error('Importer error. Rollback');
            $this->em->getConnection()->rollback();

            $destinationRateGroupDto
                ->setStatus('error')
                ->setLastExecutionError(
                    $exception->getMessage()
                );

            $this
                ->entityTools
                ->persistDto(
                    $destinationRateGroupDto,
                    $destinationRateGroup,
                    true
                );

            $this->em->close();
        }

        try {
            $this->reloadService->execute(
                $brand->getCgrTenant(),
                $disableDestinations
            );
            $this->logger->debug('Importer finished successfuly');
        } catch (\Exception $e) {
            $this->logger->error('Service reload failed');
        }

        return new Response('');
    }

    private function getJobPayload(): array
    {
        $redisMaster = $this
            ->redisMasterFactory
            ->create(
                $this->redisDb
            );

        try {
            /** @var array<string> | false $response */
            $response = $redisMaster->blPop(
                [RatesImporterJobInterface::CHANNEL],
                $this->redisTimeout
            );

            if (!$response) {
                throw new \DomainException('redis blPop error on channel ' . RatesImporterJobInterface::CHANNEL);
            }

            $data = end($response);
            return \json_decode($data, true);
        } catch (\RedisException $e) {
            $this->logger->error('Invoicer timeout');
            exit(1);
        }
    }
}
