<?php

namespace Ivoz\Kam\Domain\Service\Trusted;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TrustedLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "on_commit" =>
        [
            \Ivoz\Kam\Domain\Service\Trusted\SendUsersPermissionsReloadRequest::class => 100,
            \Ivoz\Kam\Domain\Service\Trusted\SendTrunksPermissionsReloadRequest::class => 300,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, TrustedLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
