<?php

namespace Ivoz\Provider\Domain\Service\DestinationRateGroup;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class DestinationRateGroupLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(DestinationRateGroupLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
