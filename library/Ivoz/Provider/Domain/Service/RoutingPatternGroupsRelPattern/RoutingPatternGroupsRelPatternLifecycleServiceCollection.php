<?php

namespace Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class RoutingPatternGroupsRelPatternLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

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

    /**
     * @return void
     */
    protected function addService(string $event, RoutingPatternGroupsRelPatternLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
