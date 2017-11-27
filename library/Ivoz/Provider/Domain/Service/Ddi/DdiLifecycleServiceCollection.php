<?php

namespace Ivoz\Provider\Domain\Service\Ddi;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class DdiLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(DdiLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}