<?php

namespace Ivoz\Provider\Domain\Service\IvrCustomEntry;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class IvrCustomEntryLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(IvrCustomEntryLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}