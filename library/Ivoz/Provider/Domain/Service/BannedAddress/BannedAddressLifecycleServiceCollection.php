<?php

namespace Ivoz\Provider\Domain\Service\BannedAddress;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class BannedAddressLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_remove" =>
        [
            \Ivoz\Provider\Domain\Service\BannedAddress\Unban::class => 100,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, BannedAddressLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
