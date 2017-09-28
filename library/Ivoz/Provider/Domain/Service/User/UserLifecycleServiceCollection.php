<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class UserLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(UserLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}