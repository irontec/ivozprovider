<?php

namespace Ivoz\Provider\Domain\Service\RoutingTag;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class RoutingTagLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(RoutingTagLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
