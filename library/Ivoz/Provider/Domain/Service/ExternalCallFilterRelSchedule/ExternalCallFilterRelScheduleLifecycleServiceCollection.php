<?php

namespace Ivoz\Provider\Domain\Service\ExternalCallFilterRelSchedule;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ExternalCallFilterRelScheduleLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\ExternalCallFilterRelSchedule\AvoidUpdates::class => 100,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, ExternalCallFilterRelScheduleLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
