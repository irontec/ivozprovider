<?php

namespace Ivoz\Kam\Domain\Service\AccCdr;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class AccCdrLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(AccCdrLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}