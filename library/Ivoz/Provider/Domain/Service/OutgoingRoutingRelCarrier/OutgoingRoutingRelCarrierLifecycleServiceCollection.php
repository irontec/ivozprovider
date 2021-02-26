<?php

namespace Ivoz\Provider\Domain\Service\OutgoingRoutingRelCarrier;

use Ivoz\Core\Domain\Assert\Assertion;
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

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, OutgoingRoutingRelCarrierLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
