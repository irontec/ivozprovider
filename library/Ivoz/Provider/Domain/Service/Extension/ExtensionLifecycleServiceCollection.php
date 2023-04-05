<?php

namespace Ivoz\Provider\Domain\Service\Extension;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ExtensionLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Provider\Domain\Service\User\UpdateByExtension::class => 10,
            \Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByExtension::class => 20,
            \Ivoz\Provider\Domain\Service\Contact\UpdateByExtension::class => 200,
        ],
        "pre_remove" =>
        [
            \Ivoz\Provider\Domain\Service\Ivr\UpdateByExtension::class => 10,
        ],
    ];

    protected function addService(string $event, LifecycleEventHandlerInterface|DomainEventSubscriberInterface $service): void
    {
        Assertion::isInstanceOf($service, ExtensionLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
