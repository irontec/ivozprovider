<?php

namespace Ivoz\Provider\Domain\Service\FeaturesRelBrand;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class FeaturesRelBrandLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /** @var array<array-key, array> $bindedBaseServices */
    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\FeaturesRelBrand\AvoidUpdates::class => 100,
        ],
        "pre_remove" =>
        [
            \Ivoz\Provider\Domain\Service\FeaturesRelBrand\AvoidBillingRemoval::class => 200,
        ],
    ];

    protected function addService(string $event, LifecycleEventHandlerInterface|DomainEventSubscriberInterface $service): void
    {
        Assertion::isInstanceOf($service, FeaturesRelBrandLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
