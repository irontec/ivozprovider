<?php

namespace Ivoz\Provider\Domain\Service\ExternalCallFilterRelCalendar;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class ExternalCallFilterRelCalendarLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\ExternalCallFilterRelCalendar\AvoidUpdates::class => 100,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, ExternalCallFilterRelCalendarLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
