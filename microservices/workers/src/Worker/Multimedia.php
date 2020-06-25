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
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Application\RegisterCommandTrait;

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
    use RegisterCommandTrait;

    private $eventPublisher;
    private $requestId;
    private $em;
    private $entityTools;
    private $logger;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        EntityManagerInterface $em,
        EntityTools $entityTools,
        Logger $logger
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;
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
        try {
            // Thanks Gearmand, you've done your job
            $serializedJob->sendComplete("DONE");
            $this->registerCommand('Worker', 'multimedia');

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

            /** @var LocutionInterface | null $entity */
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
            if (!isset($entity)) {
                $this->logger->error($e->getMessage());
                exit(1);
            }

            if (!isset($entityDto)) {
                $this->logger->error($e->getMessage());
                exit(1);
            }

            $entityDto
                ->setEncodedFilePath(null)
                ->setStatus('error');

            $this->entityTools->persistDto($entityDto, $entity);
            $this->logger->error(sprintf("Failed to encode %s: %s ", $entity, $e->getMessage()));
        }

        // Done!
        return true;
    }
}
