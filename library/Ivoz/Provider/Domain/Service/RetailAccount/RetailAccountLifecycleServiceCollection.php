<?php

namespace Ivoz\Provider\Domain\Service\RetailAccount;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class RetailAccountLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(RetailAccountLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
