<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler;

use Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* FixedCostsRelInvoiceSchedulerInterface
*/
interface FixedCostsRelInvoiceSchedulerInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get quantity
     *
     * @return int | null
     */
    public function getQuantity(): ?int;

    /**
     * Get fixedCost
     *
     * @return FixedCostInterface
     */
    public function getFixedCost(): FixedCostInterface;

    /**
     * Set invoiceScheduler
     *
     * @param InvoiceSchedulerInterface | null
     *
     * @return static
     */
    public function setInvoiceScheduler(?InvoiceSchedulerInterface $invoiceScheduler = null): FixedCostsRelInvoiceSchedulerInterface;

    /**
     * Get invoiceScheduler
     *
     * @return InvoiceSchedulerInterface | null
     */
    public function getInvoiceScheduler(): ?InvoiceSchedulerInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
