<?php

namespace Ivoz\Provider\Domain\Service\Brand;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class BrandLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(BrandLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}