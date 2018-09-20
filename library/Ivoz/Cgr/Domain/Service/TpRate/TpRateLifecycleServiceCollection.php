<?php

namespace Ivoz\Cgr\Domain\Service\TpRate;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TpRateLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(TpRateLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
