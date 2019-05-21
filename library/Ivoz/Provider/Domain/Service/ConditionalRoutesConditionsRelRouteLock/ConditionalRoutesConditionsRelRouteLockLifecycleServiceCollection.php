<?php

namespace Ivoz\Provider\Domain\Service\ConditionalRoutesConditionsRelRouteLock;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ConditionalRoutesConditionsRelRouteLockLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(ConditionalRoutesConditionsRelRouteLockLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
