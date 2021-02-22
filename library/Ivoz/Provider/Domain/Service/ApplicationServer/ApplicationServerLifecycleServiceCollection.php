<?php

namespace Ivoz\Provider\Domain\Service\ApplicationServer;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ApplicationServerLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Kam\Domain\Service\Dispatcher\UpdateByApplicationServer::class => 10,
        ],
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\ApplicationServer\SendUsersDispatcherReloadRequest::class => 100,
            \Ivoz\Provider\Domain\Service\ApplicationServer\SendTrunksDispatcherReloadRequest::class => 300,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, ApplicationServerLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
