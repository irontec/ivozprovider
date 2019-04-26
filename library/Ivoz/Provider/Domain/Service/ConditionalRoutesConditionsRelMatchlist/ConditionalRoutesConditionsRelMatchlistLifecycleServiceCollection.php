<?php

namespace Ivoz\Provider\Domain\Service\ConditionalRoutesConditionsRelMatchlist;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ConditionalRoutesConditionsRelMatchlistLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    /**
     * @return void
     */
    protected function addService(string $event, ConditionalRoutesConditionsRelMatchlistLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
