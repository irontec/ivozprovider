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

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\ConditionalRoutesConditionsRelMatchlist\AvoidUpdates::class => 100,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, ConditionalRoutesConditionsRelMatchlistLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
