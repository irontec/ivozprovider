<?php

namespace Ivoz\Provider\Domain\Model\Invoice;
use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
 * Invoice
 */
class Invoice extends InvoiceAbstract implements InvoiceInterface, FileContainerInterface
{
    use InvoiceTrait;
    use TempFileContainnerTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * @return array
     */
    public function getFileObjects()
    {
        return [
            'Pdf'
        ];
    }

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

