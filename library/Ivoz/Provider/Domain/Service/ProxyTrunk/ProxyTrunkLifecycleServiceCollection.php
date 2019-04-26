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

    /**
     * @return void
     */
    protected function addService(string $event, ProxyTrunkLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
