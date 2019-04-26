<?php

namespace Ivoz\Cgr\Domain\Service\TpDestination;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class TpDestinationLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(string $event, TpDestinationLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
