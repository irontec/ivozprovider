<?php

namespace Ivoz\Provider\Domain\Service\Ivr;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class IvrLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(IvrLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}

