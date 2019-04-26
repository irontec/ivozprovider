<?php

namespace Ivoz\Provider\Domain\Service\ResidentialDevice;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ResidentialDeviceLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(string $event, ResidentialDeviceLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
