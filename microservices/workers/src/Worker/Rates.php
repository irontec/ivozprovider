<?php

namespace Worker;

use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Core\Application\Service\EntityTools;
use GearmanJob;
use Ivoz\Core\Application\Service\Assembler\DtoAssembler;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\ReloadService;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupRepository;
use Mmoreram\GearmanBundle\Driver\Gearman;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var DestinationRateGroupRepository
     */
    protected $destinationRateGroupRepository;

    /**
     * @var ReloadService
     */
    protected $reloadService;

    /**
     * Rates constructor.
     *
     * @param EntityManagerInterface $em
     * @param DestinationRateGroupRepository $destinationRateGroupRepository
     * @param EntityTools $entityTools
     * @param Logger $logger
     * @param ReloadService $reloadService
     */
    public function __construct(
        EntityManagerInterface $em,
        DestinationRateGroupRepository $destinationRateGroupRepository,
        EntityTools $entityTools,
        Logger $logger,
        ReloadService $reloadService
    ) {
        $this->em = $em;
        $this->destinationRateGroupRepository = $destinationRateGroupRepository;
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

        try {
            $this->em->getConnection()->beginTransaction();

            /**
             * Create any missing Destinations
             */
            $this->logger->debug('About to insert Destinations');
            $destinationChunks = array_chunk($destinations, 100);
            foreach ($destinationChunks as $destination) {
                $destinationInsert = 'INSERT IGNORE INTO Destinations (prefix, name_en, name_es, brandId) VALUES '
                        . implode(",", $destination);
                $this->em->getConnection()->executeQuery($destinationInsert);
            }

            /**
             * Create any missing tp_destinations from Destination table
             */
            $this->logger->debug('About to insert tp_destinations');
            $tpDestinationInsert = 'INSERT IGNORE INTO tp_destinations (tpid, tag, prefix, destinationId)
                        SELECT CONCAT("b", brandId), CONCAT("b", brandId, "dst", id), prefix, id FROM Destinations';
            $this->em->getConnection()->executeQuery($tpDestinationInsert);

            /**
             *  Update DestinationRates with each CSV row
             */
            $this->logger->debug('About to insert DestinationRates');
            $tpDestinationRateChunks = array_chunk($destinationRates, 100);
            foreach ($tpDestinationRateChunks as $destinationRates) {
                $tpDestinationRateInsert = 'INSERT INTO DestinationRates
                              (rate, connectFee, rateIncrement, destinationId, destinationRateGroupId)
                              VALUES ' . implode(",", $destinationRates) .
                              'ON DUPLICATE KEY UPDATE 
                                rate = VALUES(rate),
                                connectFee = VALUES(connectFee),
                                rateIncrement = VALUES(rateIncrement)';
                $this->em->getConnection()->executeQuery($tpDestinationRateInsert);
            }

            /**
             * Update tp_rates with each DestinationRates row
             */
            $this->logger->debug('About to insert tp_rates');
            $tpRatesInsert = "INSERT INTO tp_rates
                          (tpid, tag, rate, connect_fee, rate_increment, group_interval_start, destinationRateId)
                        SELECT CONCAT('b', DRG.brandId), CONCAT('b', DRG.brandId, 'rt', DR.id), rate, connectFee, rateIncrement, groupIntervalStart, DR.id
                          FROM DestinationRates DR
                          INNER JOIN DestinationRateGroups DRG ON DRG.id = DR.destinationRateGroupId
                          WHERE DRG.id = $destinationRateGroupId
                          ON DUPLICATE KEY UPDATE
                            rate = VALUES(rate),
                            connect_fee = VALUES(connect_fee),
                            rate_increment = VALUES(rate_increment),
                            group_interval_start = VALUES(group_interval_start)";
            $this->em->getConnection()->executeQuery($tpRatesInsert);

            /**
             * Update tp_destination_rates with each DestinationRates row
             */
            $this->logger->debug('About to update tp_destination_rates');
            $tpDestinationRatesInsert = "INSERT IGNORE tp_destination_rates (tpid, tag, destinations_tag, rates_tag, destinationRateId)
                        SELECT CONCAT('b', DRG.brandId), CONCAT('b', DRG.brandId, 'dr', DRG.id), CONCAT('b', DRG.brandId, 'dst', DR.destinationId),
                         CONCAT('b', DRG.brandId, 'rt', DR.id), DR.id
                          FROM DestinationRates DR
                          INNER JOIN DestinationRateGroups DRG ON DRG.id = DR.destinationRateGroupId
                          WHERE DRG.id = $destinationRateGroupId";
            $this->em->getConnection()->executeQuery($tpDestinationRatesInsert);

            $this->em->getConnection()->commit();

            $destinationRateGroupDto->setStatus('imported');
            $this
                ->entityTools
                ->persistDto(
                    $destinationRateGroupDto,
                    $destinationRateGroup,
                    true
                );

            $this->reloadService->execute($brand->getCgrTenant());
            $this->logger->debug('Importer finished successfuly');
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

        return true;
    }
}
