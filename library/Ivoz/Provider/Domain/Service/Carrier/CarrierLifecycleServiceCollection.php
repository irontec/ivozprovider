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

    /**
     * @return void
     */
    protected function addService(string $event, CarrierLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
