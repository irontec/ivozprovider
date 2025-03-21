<?php

namespace Ivoz\Provider\Domain\Service\DdiProviderRegistration;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class DdiProviderRegistrationLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Kam\Domain\Service\TrunksUacreg\CreatedByDdiProviderRegistration::class => 200,
        ],
        "error_handler" =>
        [
            \Ivoz\Provider\Domain\Service\DdiProviderRegistration\PersistErrorHandler::class => 200,
        ],
    ];

    protected function addService(string $event, LifecycleEventHandlerInterface|DomainEventSubscriberInterface $service): void
    {
        Assertion::isInstanceOf($service, DdiProviderRegistrationLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
