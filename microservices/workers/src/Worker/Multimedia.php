<?php

namespace Worker;

use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\Process\Process;
use Mmoreram\GearmanBundle\Driver\Gearman;
use GearmanJob;

/**
 * @Gearman\Work(
 *     name = "Multimedia",
 *     description = "Handle Multimedia files related async tasks",*
 *     service = "Worker\Multimedia",
 *     iterations = 1
 * )
 */
class Multimedia
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
     * Multimedia constructor.
     * @param EntityManagerInterface $em
     * @param EntityTools $entityTools
     * @param Logger $logger
     */
    public function __construct(
        EntityManagerInterface $em,
        EntityTools $entityTools,
        Logger $logger
    ) {
        $this->em = $em;
        $this->entityTools = $entityTools;
        $this->logger = $logger;
    }

    /**
     * Encode requested file to MP3
     *
     * @Gearman\Job(
     *     name = "encode",
     *     description = "Decode files to WAV"
     * )
     *
     * @param GearmanJob $serializedJob Serialized object with job parameters
     * @return boolean
     *
     * @throws \Exception
     */
    public function encode(GearmanJob $serializedJob)
    {
        // Thanks Gearmand, you've done your job
        $serializedJob->sendComplete("DONE");

        $job = igbinary_unserialize($serializedJob->workload());

        $entityId = $job->getId();
        $entityName = $job->getEntityName();
        $entityNameSegments = explode('\\', $entityName);
        $entityClass = end($entityNameSegments);

        $repository = $this->em->getRepository($entityName);
        if (!$repository) {
            $this->logger->error(sprintf("Unable to find repository for %s", $entityName));
            return false;
        }

        /** @var LocutionInterface $entity */
        $entity = $repository->find($entityId);
        if (!$entity) {
            $this->logger->error(sprintf("Unable to find %s with id %d", $entityName, $entityId));
            return false;
        }

        $this->logger->info(sprintf("Encode process started for %s", $entity));

        /** @var LocutionDto $entityDto */
        $entityDto = $this->entityTools->entityToDto($entity);
        $entityDto->setStatus('encoding');
        $this->entityTools->persistDto($entityDto, $entity);

        try {
            $originalFile = $entityDto->getOriginalFilePath();
            $originalFileNoExt = pathinfo($entityDto->getOriginalFileBaseName(), PATHINFO_FILENAME);

            // Convert original file to raw wav using avconv
            $dumpWavFile = sprintf("/tmp/%s%draw.wav", $entityClass, $entityId);
            $process = new Process([
                "avconv",
                "-i", $originalFile,
                "-b:a", "64k",
                "-ar", "8000",
                "-ac", "1",
                $dumpWavFile
            ]);
            $process->mustRun();
            $this->logger->info(sprintf(
                "Executed %s [exitCode: %d]",
                $process->getCommandLine(),
                $process->getExitCode()
            ));

            $encodedFile = sprintf("/tmp/%s%d.wav", $entityClass, $entityId);
            $process = new Process([
                "sox",
                $dumpWavFile,
                "-b", "16",
                "-c", "1",
                $encodedFile,
                "rate", "-ql", "8000"
            ]);
            $process->mustRun();
            $this->logger->info(sprintf(
                "Executed %s [exitCode: %d]",
                $process->getCommandLine(),
                $process->getExitCode()
            ));

            // Remove temp files
            unlink($dumpWavFile);

            $entityDto
                ->setEncodedFileBaseName($originalFileNoExt . '.wav')
                ->setEncodedFilePath($encodedFile)
                ->setStatus('ready');

            $this->entityTools->persistDto($entityDto, $entity);
            $this->logger->info(sprintf("Successfully encoded %s", $entity));
        } catch (\Exception $e) {
            $entityDto
                ->setEncodedFilePath(null)
                ->setStatus('error');

            $this->entityTools->persistDto($entityDto, $entity);
            $this->logger->error(sprintf("Failed to encode %s: %s ", $entity, $e->getMessage()));
            throw $e;
        }

        // Done!
        return true;
    }
}
