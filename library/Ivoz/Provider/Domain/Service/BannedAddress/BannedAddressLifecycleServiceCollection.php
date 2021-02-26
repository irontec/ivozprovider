<?php

namespace Ivoz\Provider\Domain\Service\BannedAddress;

use Ivoz\Core\Domain\Assert\Assertion;
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

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, BannedAddressLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
