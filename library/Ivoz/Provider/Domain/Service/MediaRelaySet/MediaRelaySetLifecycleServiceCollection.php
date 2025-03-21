<?php

namespace Ivoz\Provider\Domain\Service\MediaRelaySet;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class MediaRelaySetLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
    public static $bindedBaseServices = [
        "pre_remove" =>
        [
            \Ivoz\Provider\Domain\Service\MediaRelaySet\DeleteProtection::class => 200,
        ],
        "on_commit" =>
        [
            \Ivoz\Provider\Domain\Service\MediaRelaySet\SendTrunksRtpengineReloadRequest::class => 300,
            \Ivoz\Provider\Domain\Service\MediaRelaySet\SendUsersRtpengineReloadRequest::class => 300,
        ],
    ];

    protected function addService(string $event, LifecycleEventHandlerInterface|DomainEventSubscriberInterface $service): void
    {
        Assertion::isInstanceOf($service, MediaRelaySetLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
