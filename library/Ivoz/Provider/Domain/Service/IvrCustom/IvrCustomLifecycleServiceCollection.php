<?php

namespace Ivoz\Provider\Domain\Service\IvrCustom;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class IvrCustomLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(IvrCustomLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}