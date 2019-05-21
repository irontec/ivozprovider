<?php

namespace Ivoz\Kam\Domain\Service\TrunksAddress;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class TrunksAddressLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(TrunksAddressLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
