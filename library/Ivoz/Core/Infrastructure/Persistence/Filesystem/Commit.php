<?php

namespace Ivoz\Core\Infrastructure\Persistence\Filesystem;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\CommonLifecycleEventHandlerInterface;

class Commit implements CommonLifecycleEventHandlerInterface
{
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 10
        ];
    }

    public function handle(EntityInterface $entity, $isNew)
    {
        if (!$entity instanceof FileContainerInterface) {
            return;
        }

        foreach ($entity->getTempFiles() as $tmpFile) {
            if (is_null($tmpFile->getTmpPath())) {
                $tmpFile->remove($entity);
                return;
            }
            $tmpFile->commit($entity);
        }
    }
}