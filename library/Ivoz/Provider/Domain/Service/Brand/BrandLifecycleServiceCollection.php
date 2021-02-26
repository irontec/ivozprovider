<?php

namespace Ivoz\Provider\Domain\Service\Brand;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class BrandLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "post_persist" =>
        [
            \Ivoz\Provider\Domain\Service\Domain\UpdateByBrand::class => 10,
            \Ivoz\Provider\Domain\Service\RoutingPattern\UpdateByBrand::class => 20,
            \Ivoz\Provider\Domain\Service\BrandService\UpdateByBrand::class => 30,
            \Ivoz\Cgr\Domain\Service\TpDerivedCharger\CreatedByBrand::class => 200,
        ],
        "post_remove" =>
        [
            \Ivoz\Provider\Domain\Service\Domain\DeleteByBrand::class => 10,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, BrandLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
