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

    /**
     * @return void
     */
    protected function addService(string $event, OutgoingRoutingLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
