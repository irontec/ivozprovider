<?php

namespace Worker;

use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Infrastructure\Persistence\Redis\RedisMasterFactory;
use Ivoz\Provider\Domain\Job\RecoderJobInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Application\RegisterCommandTrait;

class Multimedia
{
    use RegisterCommandTrait;

    public function __construct(
        DomainEventPublisher $eventPublisher,
        RequestId $requestId,
        private EntityManagerInterface $em,
        private EntityTools $entityTools,
        private RedisMasterFactory $redisMasterFactory,
        private int $redisDb,
        private int $redisTimeout,
        private Logger $logger
    ) {
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId;

        ini_set('default_socket_timeout', (string) $redisTimeout);
    }

    /**
     * @return Response|false
     */
    public function encode(): bool|Response
    {
        try {
            $this->registerCommand('Worker', 'multimedia');

            $job = $this->getJobPayload();

            $entityId = $job['id'];
            $entityName = $job['entityName'];
            $entityNameSegments = explode('\\', $entityName);
            $entityClass = end($entityNameSegments);
            $repository = $this->em->getRepository($entityName);

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

            // Convert original file to raw wav using ffmpeg
            $dumpWavFile = sprintf("/tmp/%s%draw.wav", $entityClass, $entityId);
            $process = new Process([
                "/usr/bin/ffmpeg",
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

            /** @phpstan-ignore-next-line  */
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
            $response = $redisMaster->blPop(
                [RecoderJobInterface::CHANNEL],
                $this->redisTimeout
            );

            $data = end($response);
            return \json_decode($data, true);
        } catch (\RedisException $e) {
            $this->logger->error('Invoicer timeout');
            exit(1);
        }
    }
}
