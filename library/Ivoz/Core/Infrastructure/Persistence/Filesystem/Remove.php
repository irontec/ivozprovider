<?php

namespace Ivoz\Core\Infrastructure\Persistence\Filesystem;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\CommonLifecycleEventHandlerInterface;
use Psr\Log\LoggerInterface;

class Remove implements CommonLifecycleEventHandlerInterface
{
    const EVENT_POST_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_REMOVE => self::EVENT_POST_REMOVE_PRIORITY
        ];
    }

    public function handle(EntityInterface $entity)
    {
        if (!$entity instanceof FileContainerInterface) {
            return;
        }

        foreach ($entity->getTempFiles() as $tmpFile) {
            $this->logger->debug(
                'About to remove a file from ' . get_class($entity)
            );
            $tmpFile->remove($entity);
        }
    }
}
