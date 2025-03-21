<?php

namespace Ivoz\Provider\Domain\Service\PickUpRelUser;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class PickUpRelUserLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\PickUpRelUser\AvoidUpdates::class => 100,
        ],
        "post_persist" =>
        [
            \Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByPickUpRelUser::class => 10,
        ],
        "post_remove" =>
        [
            \Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByPickUpRelUser::class => 10,
        ],
    ];

    protected function addService(string $event, LifecycleEventHandlerInterface|DomainEventSubscriberInterface $service): void
    {
        Assertion::isInstanceOf($service, PickUpRelUserLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
