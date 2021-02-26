<?php

namespace Ivoz\Provider\Domain\Service\FeaturesRelBrand;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class FeaturesRelBrandLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\FeaturesRelBrand\AvoidUpdates::class => 100,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, FeaturesRelBrandLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
