<?php

namespace Ivoz\Provider\Domain\Service\ApplicationServerSetRelApplicationServer;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ApplicationServerSetRelApplicationServerLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Kam\Domain\Service\Dispatcher\UpdateByApplicationServerSetRelApplicationServer::class => 10,
        ],
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\ApplicationServerSetRelApplicationServer\SendTrunksDispatcherReloadRequest::class => 300,
            \Ivoz\Provider\Domain\Service\ApplicationServerSetRelApplicationServer\SendUsersDispatcherReloadRequest::class => 300,
        ],
    ];

    protected function addService(string $event, LifecycleEventHandlerInterface|DomainEventSubscriberInterface $service): void
    {
        Assertion::isInstanceOf($service, ApplicationServerSetRelApplicationServerLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
