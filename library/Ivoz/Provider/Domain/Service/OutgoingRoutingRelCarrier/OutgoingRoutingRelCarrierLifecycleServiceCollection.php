<?php

namespace Ivoz\Provider\Domain\Service\OutgoingRoutingRelCarrier;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class OutgoingRoutingRelCarrierLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(OutgoingRoutingRelCarrierLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
