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

    /**
     * @return void
     */
    protected function addService(RoutingPatternGroupLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
