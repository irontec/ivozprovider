<?php

namespace Ivoz\Provider\Domain\Service\HolidayDate;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class HolidayDateLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\HolidayDate\CheckEventDateCollision::class => 200,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, HolidayDateLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
