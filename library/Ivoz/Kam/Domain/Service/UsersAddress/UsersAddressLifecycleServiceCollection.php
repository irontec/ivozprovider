<?php

namespace Ivoz\Kam\Domain\Service\UsersAddress;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class UsersAddressLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "on_commit" =>
        [
            \Ivoz\Kam\Domain\Service\UsersAddress\SendUsersPermissionsReloadRequest::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, UsersAddressLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
