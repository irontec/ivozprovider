<?php

namespace Ivoz\Provider\Domain\Service\CallCsvScheduler;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class CallCsvSchedulerLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\CallCsvScheduler\CheckUniqueness::class => 200,
            \Ivoz\Provider\Domain\Service\CallCsvScheduler\NextExecutionResolver::class => 200,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, CallCsvSchedulerLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
