<?php

namespace Ivoz\Provider\Domain\Service\MediaRelaySetsRelBrand;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class MediaRelaySetsRelBrandLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
    public static $bindedBaseServices = [
        "pre_remove" =>
        [
            \Ivoz\Provider\Domain\Service\MediaRelaySetsRelBrand\AvoidDeleteAllByBrand::class => 200,
            \Ivoz\Provider\Domain\Service\MediaRelaySetsRelBrand\AvoidDeleteUsed::class => 200,
        ],
    ];

    protected function addService(string $event, LifecycleEventHandlerInterface|DomainEventSubscriberInterface $service): void
    {
        Assertion::isInstanceOf($service, MediaRelaySetsRelBrandHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
