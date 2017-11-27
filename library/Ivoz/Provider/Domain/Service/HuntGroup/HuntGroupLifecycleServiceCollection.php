<?php

namespace Ivoz\Provider\Domain\Service\HuntGroup;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class HuntGroupLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(HuntGroupLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}