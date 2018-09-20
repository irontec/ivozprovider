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

    protected function addService(CallForwardSettingLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
