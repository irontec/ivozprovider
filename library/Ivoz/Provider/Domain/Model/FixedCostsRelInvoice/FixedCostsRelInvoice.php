<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoice;

/**
 * FixedCostsRelInvoice
 */
class FixedCostsRelInvoice extends FixedCostsRelInvoiceAbstract implements FixedCostsRelInvoiceInterface
{
    use FixedCostsRelInvoiceTrait;
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

