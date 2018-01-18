<?php

namespace Ivoz\Cgr\Domain\Service\Rate;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class RateLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(RateLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}