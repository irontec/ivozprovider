<?php

namespace Ivoz\Provider\Domain\Service\RoutingPatternGroup;

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

    /**
     * @return void
     */
    protected function addService(string $event, RoutingPatternGroupLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
