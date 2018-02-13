<?php

namespace Worker;

use Doctrine\ORM\EntityManagerInterface;
use GearmanJob;
use Ivoz\Cgr\Domain\Model\Destination\Destination;
use Ivoz\Cgr\Domain\Model\Destination\DestinationDto;
use Ivoz\Cgr\Domain\Model\Destination\DestinationInterface;
use Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRate;
use Ivoz\Cgr\Domain\Model\DestinationRate\DestinationRateDto;
use Ivoz\Cgr\Domain\Model\Rate\Rate;
use Ivoz\Cgr\Domain\Model\Rate\RateDto;
use Ivoz\Cgr\Domain\Model\Rate\RateInterface;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestination;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationDto;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRate;
use Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateDto;
use Ivoz\Cgr\Domain\Model\TpRate\TpRate;
use Ivoz\Cgr\Domain\Model\TpRate\TpRateDto;
use Ivoz\Core\Application\Service\Assembler\EntityAssembler;
use Ivoz\Core\Application\Service\CreateEntityFromDTO;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Mmoreram\GearmanBundle\Driver\Gearman;
use PhpMimeMailParser\Exception;
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
     * @param EntityPersisterInterface $entityPersister
     * @param Logger $logger
     */
    public function __construct(
        EntityManagerInterface $em,
        EntityPersisterInterface $entityPersister,
        CreateEntityFromDTO $createEntityFromDTO,
        Logger $logger
    ) {
        $this->em = $em;
        $this->entityPersister = $entityPersister;
        $this->logger = $logger;
        $this->createEntityFromDTO = $createEntityFromDTO;
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

        $rates = [];
        $destinations = [];

        $brandRepository = $this->em->getRepository(Brand::class);
        $brand = $brandRepository->find($brandId);
        $brandDto = $brand->toDto();

//        $destinationRateDto = new DestinationRateDto();
//        $destinationRateDto
//            ->setBrand($brandDto)
//            ->setNameEn("Imported from CSV")
//            ->setNameEs("Imported from CSV")
//            ->setDescriptionEn("Imported from CSV")
//            ->setDescriptionEs("Imported from CSV");
//
//        $destinationRate = DestinationRate::fromDto($destinationRateDto);

        foreach ($csvLines as $line) {
//            $dstKey = $line['Prefix'];
//            $rateKey = sprintf("%s-%s-%s",
//                $line["Per minute charge"],
//                $line["Connection charge"],
//                $line["Charge period"]
//            );
//
//            if (array_key_exists($dstKey, $destinations)) {
//                $tpDesinationDto = $destinations[$dstKey];
//            } else {
                $destinationDto = new DestinationDto();
                $destinationDto
                    ->setBrandId($brand->getId())
                    ->setNameEn($line['Target Pattern Name'])
                    ->setNameEs($line['Target Pattern Name'])
                    ->setDescriptionEn($line['Target Pattern Description'])
                    ->setDescriptionEs($line['Target Pattern Description']);

                /** @var DestinationInterface $destination */
                $destination = $this->createEntityFromDTO->execute(Destination::class, $destinationDto);
                $this->entityPersister->queue($destination);

                $tpDestination = new TpDestination('ivozprovider', $line['Prefix'], new \Datetime());
                $this->entityPersister->queue($tpDestination);

                $destination->addTpDestination($tpDestination);

//                $destinations[$dstKey] = $tpDesinationDto;
//            }

//            if (array_key_exists($rateKey, $rates)) {
//                $rateDto = $rates[$rateKey];
//            } else {
//                $rateDto = new RateDto();
//                $rateDto
//                    ->setBrand($brandDto)
//                    ->setName($rateKey);
//
//                $rate = Rate::fromDto($rateDto);
//
//                $tpRateDto = new TpRateDto();
//                $tpRateDto
//                    ->setConnectFee($line["Connection charge"])
//                    ->setRateCost($line["Per minute charge"])
//                    ->setRateIncrement($line["Charge period"]);
//
//                $rate->addTpRate(TpRate::fromDto($tpRateDto));;
//
//                $rates[$rateKey] = $rateDto;
//            }
//
//            $tpDestinationRateDto = new TpDestinationRateDto();
//            $tpDestinationRateDto
//                ->setDestinationRate($destinationRateDto)
//                ->setDestination($destinationDto)
//                ->setRate($rateDto);
//
//            $destinationRate->addTpDestinationRate(TpDestinationRate::fromDto($tpDestinationRateDto));
        }

        $this->entityPersister->persist($destination);
        return true;

    }
}
