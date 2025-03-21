<?php

namespace Ivoz\Provider\Domain\Service\ApplicationServerSet;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;
use Ivoz\Provider\Domain\Service\ApplicationServerSet\ApplicationServerSetLifecycleEventHandlerInterface;

/**
 * @codeCoverageIgnore
 */
class ApplicationServerSetLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\ApplicationServerSet\UpdateProtection::class => 200,
        ],
        "pre_remove" =>
        [
            \Ivoz\Provider\Domain\Service\ApplicationServerSet\DeleteProtection::class => 200,
        ],
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\ApplicationServerSet\SendTrunksDispatcherReloadRequest::class => 300,
            \Ivoz\Provider\Domain\Service\ApplicationServerSet\SendUsersDispatcherReloadRequest::class => 300,
        ],
    ];

    protected function addService(string $event, LifecycleEventHandlerInterface|DomainEventSubscriberInterface $service): void
    {
        Assertion::isInstanceOf($service, ApplicationServerSetLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
