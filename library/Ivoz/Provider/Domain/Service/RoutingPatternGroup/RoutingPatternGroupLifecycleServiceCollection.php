<?php

namespace Ivoz\Provider\Domain\Service\RoutingPatternGroup;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class RoutingPatternGroupLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\RoutingPatternGroup\SendTrunksLcrReloadRequest::class => 200,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, RoutingPatternGroupLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
