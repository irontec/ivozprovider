<?php

namespace Ivoz\Kam\Domain\Service\UsersAddress;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class UsersAddressLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(UsersAddressLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
