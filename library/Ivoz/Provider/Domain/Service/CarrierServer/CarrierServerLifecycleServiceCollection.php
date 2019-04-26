<?php

namespace Ivoz\Provider\Domain\Service\CarrierServer;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class CarrierServerLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(string $event, CarrierServerLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
