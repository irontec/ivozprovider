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

    /**
     * @return void
     */
    protected function addService(string $event, CallForwardSettingLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
