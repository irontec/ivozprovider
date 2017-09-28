<?php

namespace Ivoz\Provider\Domain\Service\MusicOnHold;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class MusicOnHoldLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(MusicOnHoldLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}