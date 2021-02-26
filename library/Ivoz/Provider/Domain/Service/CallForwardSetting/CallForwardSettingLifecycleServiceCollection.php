<?php

namespace Ivoz\Provider\Domain\Service\CallForwardSetting;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class CallForwardSettingLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\CallForwardSetting\CheckUniqueness::class => 10,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, CallForwardSettingLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
