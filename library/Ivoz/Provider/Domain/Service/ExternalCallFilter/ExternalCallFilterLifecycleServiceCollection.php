<?php

namespace Ivoz\Provider\Domain\Service\ExternalCallFilter;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class ExternalCallFilterLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(ExternalCallFilterLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}