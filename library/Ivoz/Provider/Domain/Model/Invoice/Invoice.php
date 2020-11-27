<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
 * Invoice
 */
class Invoice extends InvoiceAbstract implements FileContainerInterface, InvoiceInterface
{
    use InvoiceTrait;
    use TempFileContainnerTrait;

    protected function sanitizeValues()
    {
        if (empty($this->_initialValues)) {
            $this->initChangelog();
        }

        if ($this->hasChanged('outDate')) {
            $this->sanitizeOutDate();
        }

        $ignoredFields = [
            'total',
            'totalWithTax',
            'status',
            'setStatusMsg',
            'pdfFileSize',
            'pdfMimeType',
            'pdfBaseName',
        ];

        $changedFields = array_diff(
            $this->getChangedFields(),
            $ignoredFields
        );

        $isNew = $this->isNew();
        $onGoing = in_array(
            $this->getInitialValue('status'),
            [
                InvoiceInterface::STATUS_WAITING,
                InvoiceInterface::STATUS_PROCESSING,
            ]
        );

        if (!$isNew && !$onGoing && count($changedFields) > 0) {
            $this->reset();
        }
    }

    private function reset()
    {
        $this
            ->setTotal(null)
            ->setTotalWithTax(null)
            ->setStatus(null)
            ->setStatusMsg(null)
            ->setPdf(new Pdf(null, null, null));
    }

    private function sanitizeOutDate()
    {
        $tz = $this
            ->getCompany()
            ->getDefaultTimezone()
            ->getTz();
        $invoiceTz = new \DateTimeZone($tz);

        $outDate = $this->getOutDate();

        $outDate
            ->setTimezone($invoiceTz);
        $outDate
            ->modify('next day')
            ->setTime(0, 0, 0)
            ->modify('- 1 second');

        $this->setOutDate($outDate);
    }

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
    public function getFileObjects(int $filter = null)
    {
        $fileObjects = [
            'Pdf' => [
                FileContainerInterface::DOWNLOADABLE_FILE
            ]
        ];

        return $this->filterFileObjects(
            $fileObjects,
            $filter
        );
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
    public function isWaiting():bool
    {
        return $this->getStatus() === self::STATUS_WAITING;
    }

    public function setNumber(?string $number = null): self
    {
        if ($number === '') {
            //Avoid unique key issues
            $number = null;
        }

        return parent::setNumber($number);
    }

    public function mustRunInvoicer(): bool
    {
        $pendingStatus = $this->getStatus() === self::STATUS_WAITING;
        $statusHasChanged = $this->hasChanged('status');

        return $pendingStatus && $statusHasChanged;
    }

    public function mustCheckValidity(): bool
    {
        $scheduledInvoice = $this->getScheduler();
        $mustRunInvoicer = $this->mustRunInvoicer();

        $newScheduledInvoice = $scheduledInvoice && $mustRunInvoicer;
        $modifiedInvoice = is_null($this->getStatus());

        return $newScheduledInvoice || $modifiedInvoice;
    }

    protected function setStatusMsg(?string $statusMsg = null): self
    {
        if (!is_null($statusMsg)) {
            $statusMsg = substr(
                $statusMsg,
                0,
                140
            );
        }

        return parent::setStatusMsg($statusMsg);
    }
}
