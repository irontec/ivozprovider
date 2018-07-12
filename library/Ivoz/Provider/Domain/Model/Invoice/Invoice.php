<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
 * Invoice
 */
class Invoice extends InvoiceAbstract implements InvoiceInterface, FileContainerInterface
{
    const STATUS_WAITING = 'waiting';
    const STATUS_PROCESSING = 'processing';

    use InvoiceTrait;
    use TempFileContainnerTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
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
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isProcessing()
    {
        return $this->getStatus() === self::STATUS_PROCESSING;
    }

    /**
     * @inheritdoc
     */
    public function setStatus($status = null)
    {
        if (is_null($status)) {
            $status = self::STATUS_WAITING;
        }

        return parent::setStatus($status);
    }

    public function setNumber($number = null)
    {
        if ($number === '') {
            //Avoid unique key issues
            $number = null;
        }

        return parent::setNumber($number);
    }
}

