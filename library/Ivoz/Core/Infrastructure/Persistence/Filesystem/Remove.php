<?php

namespace Ivoz\Core\Infrastructure\Persistence\Filesystem;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\CommonLifecycleEventHandlerInterface;

class Remove implements CommonLifecycleEventHandlerInterface
{
    public function handle(EntityInterface $entity, $isNew)
    {
        if (!$entity instanceof FileContainerInterface) {
            return;
        }

        foreach ($entity->getTempFiles() as $tmpFile) {
            $tmpFile->remove($entity);
        }
    }
}