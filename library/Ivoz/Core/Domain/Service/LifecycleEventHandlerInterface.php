<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Model\EntityInterface;

interface LifecycleEventHandlerInterface
{
    public function handle(EntityInterface $entity, $isNew);
}