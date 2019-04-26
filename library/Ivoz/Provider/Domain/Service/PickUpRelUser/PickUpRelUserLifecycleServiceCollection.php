<?php

namespace Ivoz\Provider\Domain\Service\PickUpRelUser;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class PickUpRelUserLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(string $event, PickUpRelUserLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
