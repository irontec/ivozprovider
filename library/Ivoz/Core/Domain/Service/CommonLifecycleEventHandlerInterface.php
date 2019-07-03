<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Model\EntityInterface;

interface CommonLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function handle(EntityInterface $entity);
}
