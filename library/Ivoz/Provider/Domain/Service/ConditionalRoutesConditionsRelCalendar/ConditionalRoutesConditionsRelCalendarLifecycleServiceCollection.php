<?php

namespace Ivoz\Provider\Domain\Service\ConditionalRoutesConditionsRelCalendar;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ConditionalRoutesConditionsRelCalendarLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\ConditionalRoutesConditionsRelCalendar\AvoidUpdates::class => 100,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, ConditionalRoutesConditionsRelCalendarLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
