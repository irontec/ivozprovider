<?php

namespace Ivoz\Provider\Domain\Service\Friend;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class FriendLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(FriendLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}