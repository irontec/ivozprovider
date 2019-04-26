<?php

namespace Ivoz\Provider\Domain\Service\DdiProviderAddress;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class DdiProviderAddressLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(string $event, DdiProviderAddressLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
