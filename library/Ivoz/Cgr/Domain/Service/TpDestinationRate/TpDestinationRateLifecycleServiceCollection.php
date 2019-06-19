<?php

namespace Ivoz\Cgr\Domain\Service\TpDestinationRate;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TpDestinationRateLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(TpDestinationRateLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
