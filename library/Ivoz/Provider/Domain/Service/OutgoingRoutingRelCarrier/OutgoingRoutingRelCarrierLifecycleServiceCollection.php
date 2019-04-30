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

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\OutgoingRoutingRelCarrier\AvoidUpdates::class => 100,
        ],
        "post_persist" =>
        [
            \Ivoz\Cgr\Domain\Service\TpRatingProfile\CreatedByOutgoingRoutingRelCarrierBinding::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, OutgoingRoutingRelCarrierLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
