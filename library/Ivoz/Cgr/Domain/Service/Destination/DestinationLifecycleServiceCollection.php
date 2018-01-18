<?php

namespace Ivoz\Cgr\Domain\Service\Destination;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class DestinationLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    protected function addService(DestinationLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}