<?php

namespace Ivoz\Provider\Domain\Service\FaxesInOut;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class FaxesInOutLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(FaxesInOutLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}