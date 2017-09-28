<?php

namespace Ivoz\Provider\Domain\Service\RoutingPatternGroup;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class RoutingPatternGroupLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(RoutingPatternGroupLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}