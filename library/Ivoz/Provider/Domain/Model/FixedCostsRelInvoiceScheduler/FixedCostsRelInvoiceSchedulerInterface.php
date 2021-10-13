<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;

/**
* FixedCostsRelInvoiceSchedulerInterface
*/
interface FixedCostsRelInvoiceSchedulerInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    public function getQuantity(): ?int;

    public function getFixedCost(): FixedCostInterface;

    public function setInvoiceScheduler(?InvoiceSchedulerInterface $invoiceScheduler = null): static;

    public function getInvoiceScheduler(): ?InvoiceSchedulerInterface;

    public function isInitialized(): bool;
}
