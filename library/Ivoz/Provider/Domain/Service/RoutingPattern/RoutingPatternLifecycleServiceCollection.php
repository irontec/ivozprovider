<?php

namespace Ivoz\Provider\Domain\Service\RoutingPattern;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class RoutingPatternLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(RoutingPatternLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}