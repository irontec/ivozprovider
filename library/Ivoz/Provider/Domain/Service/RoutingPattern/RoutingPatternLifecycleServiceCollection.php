<?php

namespace Ivoz\Provider\Domain\Service\RoutingPattern;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class RoutingPatternLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Kam\Domain\Service\TrunksLcrRule\UpdateByRoutingPattern::class => 200,
        ],
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\RoutingPattern\SendTrunksLcrReloadRequest::class => 200,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, RoutingPatternLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
