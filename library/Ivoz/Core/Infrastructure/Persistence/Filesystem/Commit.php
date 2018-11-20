<?php

namespace Ivoz\Core\Infrastructure\Persistence\Filesystem;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\CommonLifecycleEventHandlerInterface;

class Commit implements CommonLifecycleEventHandlerInterface
{
    const ON_COMMIT_PRIORITY = 10;

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
        ];
    }

    public function handle(EntityInterface $entity)
    {
        if (!$entity instanceof FileContainerInterface) {
            return;
        }

        foreach ($entity->getTempFiles() as $tmpFile) {
            if (is_null($tmpFile->getTmpPath())) {
                $tmpFile->remove($entity);
            } else {
                $tmpFile->commit($entity);
            }

            $entity->removeTmpFile($tmpFile);
        }
    }
}
