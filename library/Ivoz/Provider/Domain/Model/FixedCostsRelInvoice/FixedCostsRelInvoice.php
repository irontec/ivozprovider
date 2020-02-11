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
     * @param \Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface $invoice
     * @param \Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerInterface $fixedCostRelScheduler
     * @return static
     */
    public static function fromFixedCostsRelInvoiceScheduler(
        InvoiceInterface $invoice,
        FixedCostsRelInvoiceSchedulerInterface $fixedCostRelScheduler
    ) {
        $entity = new static();
        $entity
            ->setQuantity(
                $fixedCostRelScheduler->getQuantity()
            )
            ->setFixedCost(
                $fixedCostRelScheduler->getFixedCost()
            )
            ->setInvoice(
                $invoice
            );

        $entity->sanitizeValues();
        $entity->initChangelog();

        return $entity;
    }
}
