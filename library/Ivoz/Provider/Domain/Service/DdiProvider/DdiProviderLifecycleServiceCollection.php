<?php

namespace Ivoz\Provider\Domain\Service\DdiProvider;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class DdiProviderLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\DdiProvider\SendTrunksAddressPermissionsReloadRequest::class => 200,
        ],
    ];


    protected function addService(string $event, DdiProviderLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
