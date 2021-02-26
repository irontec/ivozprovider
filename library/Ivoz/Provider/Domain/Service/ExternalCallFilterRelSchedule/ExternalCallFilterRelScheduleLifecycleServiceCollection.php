<?php

namespace Ivoz\Provider\Domain\Service\ExternalCallFilterRelSchedule;

use Ivoz\Core\Domain\Assert\Assertion;
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

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, ExternalCallFilterRelScheduleLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
