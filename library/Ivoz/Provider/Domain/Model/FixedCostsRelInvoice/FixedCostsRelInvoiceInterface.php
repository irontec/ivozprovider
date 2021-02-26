<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoice;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\FixedCost\FixedCostInterface;

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

    public function getQuantity(): ?int;

    public function getFixedCost(): FixedCostInterface;

    public function setInvoice(?InvoiceInterface $invoice = null): static;

    public function getInvoice(): ?InvoiceInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
