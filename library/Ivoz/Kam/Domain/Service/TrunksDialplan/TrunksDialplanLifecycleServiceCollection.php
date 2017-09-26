<?php

namespace Ivoz\Kam\Domain\Service\TrunksDialplan;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class TrunksDialplanLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(TrunksDialplanLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}