<?php

namespace Ivoz\Cgr\Domain\Service\TpTiming;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TpTimingLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(TpTimingLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}