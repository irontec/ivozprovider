<?php

namespace Ivoz\Kam\Domain\Service\TrunksAddress;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class TrunksAddressLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "on_commit" =>
        [
            \Ivoz\Kam\Domain\Service\TrunksAddress\SendTrunksPermissionsReloadRequest::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, TrunksAddressLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
