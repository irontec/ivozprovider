<?php

namespace Ivoz\Provider\Domain\Service\ConditionalRoutesConditionsRelSchedule;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ConditionalRoutesConditionsRelScheduleLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\ConditionalRoutesConditionsRelSchedule\AvoidUpdates::class => 100,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, ConditionalRoutesConditionsRelScheduleLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
