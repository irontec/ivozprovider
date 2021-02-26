<?php

namespace Ivoz\Provider\Domain\Service\FixedCostsRelInvoiceScheduler;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class FixedCostsRelInvoiceSchedulerLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\FixedCostsRelInvoiceScheduler\AvoidUpdates::class => 100,
        ],
    ];

    protected function addService(string $event, $service): void
    {
        Assertion::isInstanceOf($service, FixedCostsRelInvoiceSchedulerLifecycleEventHandlerInterface::class);
        $this->services[$event][] = $service;
    }
}
