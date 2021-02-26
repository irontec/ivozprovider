<?php

namespace Ivoz\Provider\Domain\Service\ProxyTrunk;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ProxyTrunkLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_remove" =>
        [
            \Ivoz\Provider\Domain\Service\ProxyTrunk\DeleteProtection::class => 200,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, ProxyTrunkLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
