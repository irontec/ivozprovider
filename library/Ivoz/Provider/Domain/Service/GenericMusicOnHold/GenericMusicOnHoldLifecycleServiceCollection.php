<?php

namespace Ivoz\Provider\Domain\Service\GenericMusicOnHold;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class GenericMusicOnHoldLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(GenericMusicOnHoldLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}