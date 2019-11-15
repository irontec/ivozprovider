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

        /** @var DestinationRateGroupInterface $destinationRateGroup */
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

        // Parse every CSV line
        foreach ($csvLines as $line) {
            $line["Per minute charge"]  = sprintf("%.4f", $line["rateCost"]);
            $line["Connection charge"]  = sprintf("%.4f", $line["connectionCharge"]);

            $destinations[] = sprintf(
                '("%s",  "%s",  "%s", "%d" )',
                $line['destinationPrefix'],
                $line['destinationName'],
                $line['destinationName'],
                $brandId
            );

            $destinationRates[] =
                sprintf(
                    '("%s", "%s", "%ss", %s, %d)',
                    $line["rateCost"],
                    $line["connectionCharge"],
                    $line["rateIncrement"],
                    sprintf(
                        '(SELECT id FROM Destinations WHERE prefix = "%s" AND brandId = %d LIMIT 1)',
                        $line['destinationPrefix'],
                        $brandId
                    ),
                    $destinationRateGroupId
                );
        }

        if (!$destinationRates) {
            echo "No lines parsed from CSV File: " . $params['filePath'];
            $destinationRateGroupDto->setStatus('error');
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
