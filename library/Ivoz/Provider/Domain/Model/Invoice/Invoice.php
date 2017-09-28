<?php
namespace Ivoz\Provider\Domain\Model\Invoice;

/**
 * Invoice
 */
class Invoice extends InvoiceAbstract implements InvoiceInterface
{
    use InvoiceTrait;

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

