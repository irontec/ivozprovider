<?php

namespace Ivoz\Provider\Domain\Service\DestinationRate;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class DestinationRateLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(DestinationRateLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}