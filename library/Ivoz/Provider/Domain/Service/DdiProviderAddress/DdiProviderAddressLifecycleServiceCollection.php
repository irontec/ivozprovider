<?php

namespace Ivoz\Provider\Domain\Service\DdiProviderAddress;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class DdiProviderAddressLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Kam\Domain\Service\TrunksAddress\UpdateByDdiProviderAddress::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, DdiProviderAddressLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
