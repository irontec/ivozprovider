<?php

namespace Ivoz\Provider\Domain\Service\Locution;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class LocutionLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(LocutionLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}