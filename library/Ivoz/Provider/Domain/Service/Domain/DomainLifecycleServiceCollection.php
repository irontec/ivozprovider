<?php

namespace Ivoz\Provider\Domain\Service\Domain;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;
use Ivoz\Provider\Domain\Service\Domain\DomainLifecycleEventHandlerInterface;

/**
 * @codeCoverageIgnore
 */
class DomainLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(DomainLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}