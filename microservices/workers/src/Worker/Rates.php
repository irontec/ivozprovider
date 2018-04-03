<?php

namespace Worker;

use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use GearmanJob;
use Ivoz\Core\Application\Service\CreateEntityFromDTO;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
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
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var CreateEntityFromDTO
     */
    protected $createEntityFromDTO;

    /**
     * Rates constructor.
     *
     * @param EntityManagerInterface $em
     * @param Logger $logger
     */
    public function __construct(
        EntityManagerInterface $em,
        Logger $logger
    ) {
        $this->em = $em;
        $this->logger = $logger;
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
        $brandId = $params['forcedValues']['brandId'];

        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
        $csvLines = $serializer->decode(file_get_contents($params['filePath']), 'csv');
        unlink($params['filePath']);

        // TODO Maybe this is already created if we store import file inside ??
        $destinationRateName = sprintf("Imported on %s", date("Y-m-d H:i:s"));

        $destinations = [];
        $destinationsCache = [];
        $tpDestinations = [];
        $rates = [];
        $ratesCache = [];
        $tpRates = [];
        $tpDestinationRates = [];


        // Preload Caches
        $existingDestinations = [];
        $existingDestinationsRows = $this->em->getConnection()->fetchAll("SELECT name_en FROM Destinations");
        foreach ($existingDestinationsRows as $existingDestinationsRow) {
            $existingDestinations[$existingDestinationsRow['name_en']] = true;
        }

        $existingRates = [];
        $existingRatesRows = $this->em->getConnection()->fetchAll("SELECT name FROM Rates");
        foreach ($existingRatesRows as $existingRatesRow) {
            $existingRates[$existingRatesRow['name']] = true;
        }

        // Parse every CSV line
        foreach ($csvLines as $line) {

            $line["Per minute charge"]  = sprintf("%.4f", $line["Per minute charge"]);
            $line["Connection charge"]  = sprintf("%.4f", $line["Connection charge"]);

            $rateName = sprintf("%s €/min", $line["Per minute charge"]);

            if ($line["Connection charge"] > 0) {
                $rateName .= sprintf(" (+ %s€)", $line["Connection charge"]);
            }

            if ($line["Charge period"] != 1) {
                $rateName .= sprintf("(per %ss)", $line["Charge period"]);
            }

            $destinationName = $line['Destination Name'];

            if (!array_key_exists($destinationName, $destinationsCache)) {
                if (!array_key_exists($destinationName, $existingDestinations)) {
                    $destinations[] = sprintf('("%s", "%s", "%s", "%s", %d)',
                        $destinationName,
                        $destinationName,
                        $line['Destination Description'],
                        $line['Destination Description'],
                        $brandId
                    );
                }

                $destinationsCache[$destinationName] = true;

                $tpDestinationRates[] =
                    sprintf("(%s, %s, %s, %s, %s, %s)",
                        sprintf('(SELECT tag FROM Destinations WHERE name_en = "%s" LIMIT 1)', $destinationName),
                        sprintf('(SELECT id FROM Destinations WHERE name_en = "%s" LIMIT 1)', $destinationName),
                        sprintf('(SELECT tag FROM Rates WHERE name = "%s" LIMIT 1)', $rateName),
                        sprintf('(SELECT id FROM Rates WHERE name = "%s" LIMIT 1)', $rateName),
                        sprintf('(SELECT tag FROM DestinationRates WHERE name_en = "%s" LIMIT 1)', $destinationRateName),
                        sprintf('(SELECT id FROM DestinationRates WHERE name_en = "%s" LIMIT 1)', $destinationRateName)
                    );
            }

            $tpDestinations[] = sprintf('("%s", %s, %s)',
                $line['Prefix'],
                sprintf('(SELECT tag FROM Destinations WHERE name_en = "%s" LIMIT 1)', $destinationName),
                sprintf('(SELECT id FROM Destinations WHERE name_en = "%s" LIMIT 1)', $destinationName)
            );

            if (!array_key_exists($rateName, $ratesCache)) {
                if (!array_key_exists($rateName, $existingRates)) {
                    $rates[] = sprintf('("%s", %d)',
                        $rateName,
                        $brandId
                    );

                    $tpRates[] = sprintf('("%s", "%s", "%ss", %s, %s)',
                        $line["Connection charge"],
                        $line["Per minute charge"],
                        $line["Charge period"],
                        sprintf('(SELECT tag FROM Rates WHERE name = "%s" LIMIT 1)', $rateName),
                        sprintf('(SELECT id FROM Rates WHERE name = "%s" LIMIT 1)', $rateName)
                    );

                    $ratesCache[$rateName] = true;
                }
            }

        }

        try {
            $this->em->getConnection()->beginTransaction();

            if (!empty($destinations)) {
                $this->em->getConnection()->executeQuery(
                    'INSERT IGNORE INTO Destinations (name_en, name_es, description_en, description_es, brandId) VALUES ' . implode(",", $destinations)
                );

                $this->em->getConnection()->executeQuery(
                    'UPDATE Destinations SET tag = CONCAT("b", brandId, "dst", id)'
                );
            }

            if (!empty($tpDestinations)) {
                $this->em->getConnection()->executeQuery(
                    'INSERT IGNORE INTO tp_destinations (prefix, tag, destinationId) VALUES ' . implode(",", $tpDestinations)
                );
            }

            if (!empty($rates)) {
                $this->em->getConnection()->executeQuery(
                    'INSERT IGNORE INTO Rates (name, brandId) VALUES ' . implode(",", $rates)
                );


                $this->em->getConnection()->executeQuery(
                    'UPDATE IGNORE Rates SET tag = CONCAT("b", brandId, "rt", id)'
                );
            }

            if (!empty($tpRates)) {
                $this->em->getConnection()->executeQuery(
                    'INSERT IGNORE INTO tp_rates (connect_fee, rate, rate_increment, tag, rateId ) VALUES ' . implode(",", $tpRates)
                );
            }

            $this->em->getConnection()->executeQuery(
                "INSERT INTO DestinationRates (name_en, name_es, description_es, description_en, brandId) VALUES ('$destinationRateName', '$destinationRateName', 'Imported From CSV', 'Imported From CSV', $brandId)"
            );

            $this->em->getConnection()->executeQuery(
                'UPDATE DestinationRates SET tag = CONCAT("b", brandId, "dr", id)'
            );

            $this->em->getConnection()->executeQuery(
                'INSERT INTO tp_destination_rates (destinations_tag, destinationId, rates_tag, rateId, tag, destinationRateId) VALUES ' . implode(",", $tpDestinationRates)
            );


            $this->em->getConnection()->commit();
        } catch (DBALException $exception) {

            $this->em->close();
            $this->em->getConnection()->rollback();

            echo $exception->getMessage();
        }

        return true;

    }
}
