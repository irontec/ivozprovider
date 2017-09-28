<?php

namespace Ivoz\Provider\Domain\Service\TerminalModel;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class TerminalModelLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(TerminalModelLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}