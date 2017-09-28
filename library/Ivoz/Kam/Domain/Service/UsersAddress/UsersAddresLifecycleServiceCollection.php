<?php

namespace Ivoz\Kam\Domain\Service\UsersAddress;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class UsersAddresLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(UsersAddresLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}