<?php

namespace Ivoz\Provider\Domain\Service\OutgoingRouting;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class OutgoingRoutingLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Cgr\Domain\Service\TpLcrRule\CreatedByOutgoingRouting::class => 200,
            \Ivoz\Kam\Domain\Service\TrunksLcrRule\UpdateByOutgoingRouting::class => 200,
            \Ivoz\Kam\Domain\Service\TrunksLcrRule\RemoveByOutgoingRouting::class => 210,
            \Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget\UpdateByOutgoingRouting::class => 210,
            \Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget\RemoveByOutgoingRouting::class => 220,
        ],
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\OutgoingRouting\SendTrunksLcrReloadRequest::class => 200,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, OutgoingRoutingLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
