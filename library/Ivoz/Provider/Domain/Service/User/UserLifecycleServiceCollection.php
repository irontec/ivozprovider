<?php

namespace Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class UserLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(UserLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
