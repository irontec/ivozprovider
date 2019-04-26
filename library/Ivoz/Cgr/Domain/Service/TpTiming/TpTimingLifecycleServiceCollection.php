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

    /**
     * @return void
     */
    protected function addService(string $event, TpTimingLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
