<?php

namespace Ivoz\Kam\Domain\Service\Trusted;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TrustedLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(TrustedLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
