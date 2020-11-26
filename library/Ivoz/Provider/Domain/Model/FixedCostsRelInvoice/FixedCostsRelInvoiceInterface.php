<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoice;

use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* FixedCostsRelInvoiceInterface
*/
interface FixedCostsRelInvoiceInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @param \Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface $invoice
     * @param \Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface $fixedCostRelScheduler
     * @return static
     */
    public static function fromFixedCostsRelInvoiceScheduler(InvoiceInterface $invoice, FixedCostsRelInvoiceSchedulerInterface $fixedCostRelScheduler);

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
     * Set invoice
     *
     * @param InvoiceInterface | null
     *
     * @return static
     */
    public function setInvoice(?InvoiceInterface $invoice = null): FixedCostsRelInvoiceInterface;

    /**
     * Get invoice
     *
     * @return InvoiceInterface | null
     */
    public function getInvoice(): ?InvoiceInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
