<?php

namespace Ivoz\Provider\Domain\Service\ProxyTrunksRelBrand;

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

    /**
     * @return void
     */
    protected function addService(string $event, ProxyTrunksRelBrandLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
