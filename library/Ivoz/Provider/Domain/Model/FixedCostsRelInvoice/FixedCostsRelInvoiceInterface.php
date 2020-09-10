<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoice;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public static function fromFixedCostsRelInvoiceScheduler(\Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface $invoice, \Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface $fixedCostRelScheduler);

    /**
     * Get quantity
     *
     * @return integer | null
     */
    public function getQuantity();

    /**
     * Get fixedCost
     *
     * @return \Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface
     */
    public function getFixedCost();

    /**
     * Set invoice
     *
     * @param \Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface $invoice | null
     *
     * @return static
     */
    public function setInvoice(\Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface $invoice = null);

    /**
     * Get invoice
     *
     * @return \Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface | null
     */
    public function getInvoice();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
