<?php

namespace Ivoz\Provider\Domain\Service\OutgoingRouting;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class OutgoingRoutingLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(OutgoingRoutingLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
