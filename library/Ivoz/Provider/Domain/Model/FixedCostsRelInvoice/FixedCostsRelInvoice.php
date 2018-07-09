<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoice;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;

/**
 * FixedCostsRelInvoice
 */
class FixedCostsRelInvoice extends FixedCostsRelInvoiceAbstract implements FixedCostsRelInvoiceInterface
{
    use FixedCostsRelInvoiceTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param InvoiceInterface $invoice
     * @param FixedCostsRelInvoiceSchedulerInterface $fixedCostsRelInvoiceScheduler
     * @return static
     */
    public function fromFixedCostsRelInvoiceScheduler(
        InvoiceInterface $invoice,
        FixedCostsRelInvoiceSchedulerInterface $fixedCostRelScheduler
    ) {
        $dto = new static();
        $dto
            ->setQuantity(
                $fixedCostRelScheduler->getQuantity()
            )
            ->setBrand(
                $fixedCostRelScheduler->getBrand()
            )
            ->setFixedCost(
                $fixedCostRelScheduler->getFixedCost()
            )
            ->setInvoice(
                $invoice
            );

        return $dto;
    }
}

