<?php

namespace Worker;

use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use GearmanJob;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateDto;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateRepository;
use Ivoz\Core\Application\Service\Assembler\DtoAssembler;
use Mmoreram\GearmanBundle\Driver\Gearman;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Ivoz\Core\Infrastructure\Domain\Service\Redis\Client;

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
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var DestinationRateInterface
     */
    protected $destinationRateRepository;

    /**
     * @var DtoAssembler
     */
    protected $dtoAssembler;


    /**
     * @var Client
     */
    protected $redisClient;

    /**
     * Rates constructor.
     * @param EntityManagerInterface $em
     * @param DestinationRateRepository $destinationRateRepository
     * @param DtoAssembler $dtoAssembler
     * @param EntityPersisterInterface $entityPersister
     * @param Logger $logger
     * @param Client $redisClient
     */
    public function __construct(
        EntityManagerInterface $em,
        DestinationRateRepository $destinationRateRepository,
        DtoAssembler $dtoAssembler,
        EntityPersisterInterface $entityPersister,
        Logger $logger,
        Client $redisClient
    ) {
        $this->em = $em;
        $this->destinationRateRepository = $destinationRateRepository;
        $this->dtoAssembler = $dtoAssembler;
        $this->entityPersister = $entityPersister;
        $this->logger = $logger;
        $this->redisClient = $redisClient;
    }

    /**
     * @Gearman\Job(
     *     name = "import",
     *     description = "Import Pricing data from CSV file"
     * )
     *
     * @param GearmanJob $serializedJob Serialized object with job parameters
     * @return boolean
     */
    public function import(GearmanJob $serializedJob)
    {
        // Thanks Gearmand, you've done your job
        $serializedJob->sendComplete("DONE");

        $job = igbinary_unserialize($serializedJob->workload());
        $params = $job->getParams();

        /** @var DestinationRateInterface $destinationRate */
        $destinationRate = $this->destinationRateRepository->find(
            $params['id']
        );

        if (!$destinationRate) {
            $this->logger->error('Unknown destination rate with id ' . $params['id']);
            throw new \Exception();
        }

        $destinationRateId = $destinationRate->getId();
        $brandId = $destinationRate->getBrand()->getId();

        /** @var DestinationRateDto $destinationRateDto */
        $destinationRateDto = $this->dtoAssembler->toDto(
            $destinationRate
        );

        $destinationRateDto->setStatus('inProgress');
        $this
            ->entityPersister
            ->persistDto($destinationRateDto, $destinationRate, true);
        $this->logger->debug('Importer in progress');

        $importerArguments = $destinationRate
            ->getFile()
            ->getImporterArguments();

        $csvEncoder = new CsvEncoder(
            $importerArguments['delimiter'] ?? ',',
            $importerArguments['enclosure'] ?? '"',
            $importerArguments['scape'] ?? '\\'
        );
        $serializer = new Serializer([new ObjectNormalizer()], [$csvEncoder]);
        $csvContents = file_get_contents($destinationRateDto->getFilePath());
        if ($importerArguments['ignoreFirst']) {
            $csvContents = preg_replace('/^.+\n/', '', $csvContents);
        }

        $header = implode(',', $importerArguments['columns']) . "\n";
        $csvContents = $header . $csvContents;

        $csvLines = $serializer->decode(
            $csvContents,
            'csv'
        );
        $tpDestinationRates = [];

        if (current($csvLines) && !is_array(current($csvLines))) {
            // We require an array of arrays
            $csvLines = [$csvLines];
        }

        // Parse every CSV line
        foreach ($csvLines as $line) {

            $line["Per minute charge"]  = sprintf("%.4f", $line["rateCost"]);
            $line["Connection charge"]  = sprintf("%.4f", $line["connectionCharge"]);

            $tpDestinationRates[] =
                sprintf('("%s", "%s", "%s", "%s", "%ss", %s)',
                    $line['destinationPrefix'],
                    $line['destinationName'],
                    $line["connectionCharge"],
                    $line["rateCost"],
                    $line["rateIncrement"],
                    sprintf('(SELECT id FROM DestinationRates WHERE id = %d LIMIT 1)', $destinationRateId)
            );
        }

        if (!$tpDestinationRates) {
            echo "No lines parsed from CSV File: " . $params['filePath'];
            $destinationRateDto->setStatus('error');
            $this
                ->entityPersister
                ->persistDto($destinationRateDto, $destinationRate, true);
            exit(1);
        }

        try {
            $this->em->getConnection()->beginTransaction();

            ////////////////////////////
            /// tp_destination_rates
            ////////////////////////////
            $this->logger->debug('About to insert tp_destination_rates');
            $tpDestinationRateChunks = array_chunk($tpDestinationRates, 100);
            foreach ($tpDestinationRateChunks as $tpDestinationRates) {

                $tpDestinationRateInsert = 'REPLACE INTO tp_destination_rates (prefix, prefix_name, connect_fee, rate, rate_increment, destinationRateId) VALUES ' . implode(",", $tpDestinationRates);
                $this->em->getConnection()->executeQuery($tpDestinationRateInsert);
            }

            $this->logger->debug('About to update tp_destination_rates');
            $tpDestinationRateUpdateTags = "UPDATE tp_destination_rates SET
                              tag = CONCAT('b" . $brandId . "dr', destinationRateId),
                              rates_tag = CONCAT('b" . $brandId . "dr', destinationRateId, 'rt', id),
                              destinations_tag = CONCAT('b" . $brandId . "dr', destinationRateId, 'dst', id)";
            $this->em->getConnection()->executeQuery($tpDestinationRateUpdateTags);

            ////////////////////////////
            /// tp_destinations
            ////////////////////////////
            $this->logger->debug('About to insert tp_destinations');
            $tpDestinationInsert = "REPLACE INTO tp_destinations
                          (tag, prefix, name, tpDestinationRateId)
                        SELECT destinations_tag, prefix, prefix_name, id
                          FROM tp_destination_rates
                          WHERE destinationRateId = (SELECT id FROM DestinationRates WHERE id = '$destinationRateId')";
            $this->em->getConnection()->executeQuery($tpDestinationInsert);

            ////////////////////////////
            /// tp_rates
            ////////////////////////////
            $this->logger->debug('About to insert tp_rates');
            $tpRatesInsert = "REPLACE INTO tp_rates
                          (tag, rate, connect_fee, rate_increment, group_interval_start, tpDestinationRateId)
                        SELECT rates_tag, rate, connect_fee, rate_increment, group_interval_start, id
                          FROM tp_destination_rates
                          WHERE destinationRateId = (SELECT id FROM DestinationRates WHERE id = '$destinationRateId' LIMIT 1)";
            $this->em->getConnection()->executeQuery($tpRatesInsert);

            $this->em->getConnection()->commit();

            $destinationRateDto->setStatus('imported');
            $this
                ->entityPersister
                ->persistDto($destinationRateDto, $destinationRate, true);

            $this->redisClient->scheduleFullReload();
            $this->logger->debug('Importer finished successfuly');

        } catch (\Exception $exception) {

            $this->logger->error('Importer error. Rollback');
            $this->em->getConnection()->rollback();

            $destinationRateDto->setStatus('error');
            $this
                ->entityPersister
                ->persistDto($destinationRateDto, $destinationRate, true);

            $this->em->close();

            throw $exception;
        }

        return true;
    }
}
