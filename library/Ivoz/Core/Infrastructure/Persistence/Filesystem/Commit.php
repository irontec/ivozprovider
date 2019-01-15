<?php

namespace Ivoz\Core\Infrastructure\Persistence\Filesystem;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\CommonLifecycleEventHandlerInterface;
use Psr\Log\LoggerInterface;

class Commit implements CommonLifecycleEventHandlerInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function handle(EntityInterface $entity)
    {
        if (!$entity instanceof FileContainerInterface) {
            return;
        }

        foreach ($entity->getTempFiles() as $tmpFile) {
            if (!is_null($tmpFile->getTmpPath())) {
                $this->logger->debug(
                    'About to commit a file from ' . get_class($entity) . ' #' . $entity->getId()
                );
                $tmpFile->commit($entity);
            }

            $entity->removeTmpFile($tmpFile);
        }
    }
}
