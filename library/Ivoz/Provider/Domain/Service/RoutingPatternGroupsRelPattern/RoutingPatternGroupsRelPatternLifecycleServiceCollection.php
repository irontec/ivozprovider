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

    /**
     * @return void
     */
    protected function addService(RoutingPatternGroupsRelPatternLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
