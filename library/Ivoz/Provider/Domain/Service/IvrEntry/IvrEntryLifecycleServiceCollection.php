<?php

namespace Ivoz\Provider\Domain\Service\IvrEntry;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class IvrEntryLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(IvrEntryLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}