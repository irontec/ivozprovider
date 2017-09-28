<?php

namespace Ivoz\Kam\Domain\Service\PikeTrusted;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

class PikeTrustedLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(PikeTrustedLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}