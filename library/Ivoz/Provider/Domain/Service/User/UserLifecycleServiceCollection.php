<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class UserLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Provider\Domain\Service\Extension\UpdateByUser::class => 20,
            \Ivoz\Provider\Domain\Service\User\UnsetBossAssistant::class => 30,
            \Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByUser::class => 40,
            \Ivoz\Provider\Domain\Service\Voicemail\UpdateByUser::class => 100,
        ],
        "post_remove" =>
        [
            \Ivoz\Provider\Domain\Service\Extension\UpdateByUser::class => 10,
        ],
        "error_handler" =>
        [
            \Ivoz\Provider\Domain\Service\User\PersistErrorHandler::class => 200,
        ],
    ];

    protected function addService(string $event, LifecycleEventHandlerInterface|DomainEventSubscriberInterface $service): void
    {
        Assertion::isInstanceOf($service, UserLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
