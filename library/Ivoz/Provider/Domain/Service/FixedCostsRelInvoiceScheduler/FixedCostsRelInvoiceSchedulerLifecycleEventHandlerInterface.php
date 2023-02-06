<?php

namespace Ivoz\Provider\Domain\Service\FixedCostsRelInvoiceScheduler;

use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface;

interface FixedCostsRelInvoiceSchedulerLifecycleEventHandlerInterface extends LifecycleEventHandlerInterface
{
    public function execute(FixedCostsRelInvoiceSchedulerInterface $relInvoiceScheduler);
}
