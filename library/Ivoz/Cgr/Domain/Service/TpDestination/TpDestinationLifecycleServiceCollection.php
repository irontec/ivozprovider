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

    protected function addService(TpDestinationLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
