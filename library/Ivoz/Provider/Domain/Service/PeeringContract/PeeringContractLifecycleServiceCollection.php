<?php

namespace Ivoz\Provider\Domain\Service\PeeringContract;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class PeeringContractLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(PeeringContractLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}