<?php

namespace Ivoz\Provider\Domain\Service\HuntGroupsRelUser;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class HuntGroupsRelUserLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\HuntGroupsRelUser\AvoidUpdates::class => 100,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, HuntGroupsRelUserLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
