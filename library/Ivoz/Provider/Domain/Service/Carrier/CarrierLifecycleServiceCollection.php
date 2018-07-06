<?php

namespace Ivoz\Provider\Domain\Service\Carrier;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class CarrierLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(CarrierLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}