<?php

namespace Ivoz\Provider\Domain\Service\BalanceNotification;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class BalanceNotificationLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "on_domain_event" =>
        [
            0 => \Ivoz\Provider\Domain\Service\BalanceNotification\NotifyBrokenThreshold::class,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, $service)
    {
        $this->services[$event][] = $service;
    }
}
