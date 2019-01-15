<?php

namespace Ivoz\Provider\Domain\Service\ProxyTrunk;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ProxyTrunkLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(ProxyTrunkLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
