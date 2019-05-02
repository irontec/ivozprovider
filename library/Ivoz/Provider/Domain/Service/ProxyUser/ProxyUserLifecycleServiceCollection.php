<?php

namespace Ivoz\Provider\Domain\Service\ProxyUser;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ProxyUserLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(ProxyUserLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
