<?php

namespace Ivoz\Provider\Domain\Service\Recording;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class RecordingLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Provider\Domain\Service\BillableCall\UpdateByRecording::class => 200,
            \Ivoz\Provider\Domain\Service\UsersCdr\UpdateByRecording::class => 200,
        ],
        "post_remove" =>
        [
            \Ivoz\Provider\Domain\Service\BillableCall\UpdateByRecording::class => 200,
            \Ivoz\Provider\Domain\Service\UsersCdr\UpdateByRecording::class => 200,
        ],
    ];

    protected function addService(string $event, LifecycleEventHandlerInterface|DomainEventSubscriberInterface $service): void
    {
        Assertion::isInstanceOf($service, RecordingLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
