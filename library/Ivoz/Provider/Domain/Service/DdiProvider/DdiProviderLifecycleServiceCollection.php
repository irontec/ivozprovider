<?php

namespace Ivoz\Provider\Domain\Service\DdiProvider;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class DdiProviderLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(DdiProviderLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
