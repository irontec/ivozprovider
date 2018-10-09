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

    protected function addService(FixedCostsRelInvoiceSchedulerLifecycleEventHandlerInterface $service)
    {
        $this->services[] = $service;
    }
}
