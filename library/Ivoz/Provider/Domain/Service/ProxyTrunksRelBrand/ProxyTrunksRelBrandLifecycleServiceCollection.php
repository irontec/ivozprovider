<?php

namespace Ivoz\Provider\Domain\Service\ProxyTrunksRelBrand;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ProxyTrunksRelBrandLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "post_remove" =>
        [
            \Ivoz\Provider\Domain\Service\ProxyTrunksRelBrand\AvoidRemovingInUseAddresses::class => 200,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, ProxyTrunksRelBrandLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
