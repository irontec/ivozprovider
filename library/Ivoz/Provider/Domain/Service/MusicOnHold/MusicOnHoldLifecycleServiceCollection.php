<?php

namespace Ivoz\Provider\Domain\Service\MusicOnHold;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class MusicOnHoldLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(MusicOnHoldLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
