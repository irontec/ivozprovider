<?php

namespace Ivoz\Provider\Domain\Service\CallForwardSetting;

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

    /**
     * @return void
     */
    protected function addService(string $event, CallForwardSettingLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
