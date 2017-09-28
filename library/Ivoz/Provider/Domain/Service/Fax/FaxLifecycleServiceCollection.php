<?php

namespace Ivoz\Provider\Domain\Service\Fax;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class FaxLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(FaxLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}