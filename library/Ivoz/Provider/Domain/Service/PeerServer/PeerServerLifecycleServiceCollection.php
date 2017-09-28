<?php

namespace Ivoz\Provider\Domain\Service\PeerServer;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class PeerServerLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(PeerServerLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}