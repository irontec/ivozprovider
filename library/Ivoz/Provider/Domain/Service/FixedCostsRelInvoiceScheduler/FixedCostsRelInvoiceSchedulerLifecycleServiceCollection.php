<?php

namespace Ivoz\Provider\Domain\Service\FixedCostsRelInvoiceScheduler;

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

    /**
     * @return void
     */
    protected function addService(string $event, FixedCostsRelInvoiceSchedulerLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
