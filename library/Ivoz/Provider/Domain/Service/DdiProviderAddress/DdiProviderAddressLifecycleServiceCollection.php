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

    protected function addService(DdiProviderAddressLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
