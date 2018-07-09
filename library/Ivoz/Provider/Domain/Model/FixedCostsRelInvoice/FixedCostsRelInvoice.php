<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoice;

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
    public static function fromFixedCostsRelInvoiceScheduler(
        InvoiceInterface $invoice,
        FixedCostsRelInvoiceSchedulerInterface $fixedCostRelScheduler
    ) {
        $dto = new static();
        $dto
            ->setQuantity(
                $fixedCostRelScheduler->getQuantity()
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

