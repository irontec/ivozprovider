<?php

namespace Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class RoutingPatternGroupsRelPatternLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern\AvoidUpdates::class => 100,
        ],
        "post_persist" =>
        [
            \Ivoz\Kam\Domain\Service\TrunksLcrRule\UpdateByRoutingPatternGroupsRelPattern::class => 200,
            \Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget\UpdateByRoutingPatternGroupsRelPattern::class => 210,
        ],
    ];

    protected function addService(string $event, LifecycleEventHandlerInterface|DomainEventSubscriberInterface $service): void
    {
        Assertion::isInstanceOf($service, RoutingPatternGroupsRelPatternLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
