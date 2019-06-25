<?php

namespace Ivoz\Provider\Domain\Service\FixedCostsRelInvoice;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionTrait;

/**
 * @codeCoverageIgnore
 */
class FixedCostsRelInvoiceLifecycleServiceCollection implements LifecycleServiceCollectionInterface
{
    use LifecycleServiceCollectionTrait;

    public static $bindedBaseServices = [
        "pre_persist" =>
        [
            \Ivoz\Provider\Domain\Service\FixedCostsRelInvoice\AvoidUpdates::class => 100,
        ],
    ];

    /**
     * @return void
     */
    protected function addService(string $event, FixedCostsRelInvoiceLifecycleEventHandlerInterface $service)
    {
        $this->services[$event][] = $service;
    }
}
