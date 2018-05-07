<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Model\EntityInterface;

interface CommonLifecycleEventHandlerInterface
{
    public function handle(EntityInterface $entity, $isNew);
}