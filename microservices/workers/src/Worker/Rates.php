<?php

namespace Worker;

use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationRepository;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateRepository;
use Ivoz\Cgr\Domain\Model\TpRate\TpRateRepository;
use Ivoz\Core\Application\Service\EntityTools;
use GearmanJob;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\ReloadService;
use Ivoz\Provider\Domain\Model\Destination\DestinationRepository;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateRepository;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupRepository;
use Mmoreram\GearmanBundle\Driver\Gearman;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Application\RegisterCommandTrait;
use Assert\Assertion;

/**
 * @Gearman\Work(
 *     name = "Rates",
 *     description = "Handle Rates related async tasks",
 *     service = "Worker\Rates",
 *     iterations = 1
 * )
 */
class Rates
{
    const CHUNK_SIZE = 100;
    const MAX_LINES = 75001;

    use RegisterCommandTrait;

    private $eventPublisher;
    private $requestId;
    private $em;
    private $destinationRepository;
    private $tpDestinationRepository;
    private $destinationRateRepository;
    private $tpRateRepository;
    private $tpDestinationRateRepository;
    private $entityTools;
    private $logger;
    private $destinationRateGroupRepository;
    private $reloadService;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        EntityManagerInterface $em,
        DestinationRepository $destinationRepository,
        DestinationRateGroupRepository $destinationRateGroupRepository,
        TpDestinationRepository $tpDestinationRepository,
        DestinationRateRepository $destinationRateRepository,
        TpRateRepository $tpRateRepository,
        TpDestinationRateRepository $tpDestinationRateRepository,
        EntityTools $entityTools,
        Logger $logger,
        ReloadService $reloadService
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
        $this->em = $em;
        $this->destinationRepository = $destinationRepository;
        $this->tpDestinationRepository = $tpDestinationRepository;
        $this->destinationRateGroupRepository = $destinationRateGroupRepository;
        $this->destinationRateRepository = $destinationRateRepository;
        $this->tpDestinationRateRepository = $tpDestinationRateRepository;
        $this->tpRateRepository = $tpRateRepository;
        $this->entityTools = $entityTools;
        $this->logger = $logger;
        $this->reloadService = $reloadService;
    }

    /**
     * @Gearman\Job(
     *     name = "import",
     *     description = "Import Pricing data from CSV file"
     * )
     *
     * @param GearmanJob $serializedJob Serialized object with job parameters
     * @return boolean
     * @throws \Exception
     */
    public function import(GearmanJob $serializedJob)
    {
        // Thanks Gearmand, you've done your job
        $serializedJob->sendComplete("DONE");
        $this->registerCommand('Worker', 'rates');

        $job = igbinary_unserialize($serializedJob->workload());
        $params = $job->getParams();

        /** @var DestinationRateGroupInterface | null $destinationRateGroup */
        $destinationRateGroup = $this->destinationRateGroupRepository->find(
            $params['id']
        );

        if (!$destinationRateGroup) {
            $this->logger->error('Unknown destination rate with id ' . $params['id']);
            throw new \Exception('Unknown destination rate');
        }

        $destinationRateGroupId = $destinationRateGroup->getId();
        $brand = $destinationRateGroup->getBrand();
        $brandId = $brand->getId();

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

        $csvEncoder = new CsvEncoder(
            $importerArguments['delimiter'] ?? ',',
            $importerArguments['enclosure'] ?? '"',
            $importerArguments['scape'] ?? '\\'
        );

        $serializer = new Serializer([new ObjectNormalizer()], [$csvEncoder]);
        $csvContents = file_get_contents($destinationRateGroupDto->getFilePath());
        if ($importerArguments['ignoreFirst']) {
            $csvContents = preg_replace('/^.+\n/', '', $csvContents);
        }

        $header = implode(',', $importerArguments['columns']) . "\n";
        $csvContents = $header . $csvContents;

        $csvLines = $serializer->decode(
            $csvContents,
            'csv'
        );
        $destinationRates = [];
        $destinations = [];

        if (current($csvLines) && !is_array(current($csvLines))) {
            // We require an array of arrays
            $csvLines = [$csvLines];
        }

        try {
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
                    'Duplicated prefix on line '. $lineNum
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

            $destinationRateGroupDto
                ->setStatus('error');

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
                $this
                    ->destinationRepository
                    ->insertIgnoreFromArray($destination);
            }

            /**
             * Create any missing tp_destinations from Destination table
             */
            $this->logger->debug('About to insert tp_destinations');
            $this
                ->tpDestinationRepository
                ->syncWithBusiness();

            /**
             *  Update DestinationRates with each CSV row
             */
            $destinationPrefixes = $this
                ->destinationRepository
                ->getPrefixArrayByBrandId($brandId);

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
                $affectedRows = $this
                    ->destinationRateRepository
                    ->insertIgnoreFromArray($destinationRates);

                // Reload CGRateS destinations only if new prefixes have been added
                if ($affectedRows > 0) {
                    $disableDestinations = false;
                }
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
                ->syncWithBussines($destinationRateGroupId);

            $destinationRateGroupDto->setStatus('imported');
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

            $destinationRateGroupDto->setStatus('error');
            $this
                ->entityTools
                ->persistDto(
                    $destinationRateGroupDto,
                    $destinationRateGroup,
                    true
                );

            $this->em->close();

            throw $exception;
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

        return true;
    }
}
