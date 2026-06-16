<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

use DateTimeInterface;
use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
 * Invoice
 */
class Invoice extends InvoiceAbstract implements FileContainerInterface, InvoiceInterface
{
    use InvoiceTrait;
    use TempFileContainnerTrait;

    protected function sanitizeValues(): void
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

        $numberSequence = $this->getNumberSequence();
        $number = $this->getNumber();
        if (!$numberSequence && !$number) {
            throw new \DomainException('Number or number sequence required');
        }
    }

    private function reset(): void
    {
        $this
            ->setTotal(null)
            ->setTotalWithTax(null)
            ->setStatus(null)
            ->setStatusMsg(null)
            ->setPdf(new Pdf(null, null, null));
    }

    protected function setTaxRate(?float $taxRate = null): static
    {
        if (is_null($taxRate)) {
            throw new \DomainException('Tax Rate, cannot be null');
        }

        return parent::setTaxRate($taxRate);
    }

    private function sanitizeOutDate(): void
    {
        $tz = $this
            ->getCompany()
            ->getDefaultTimezone()
            ->getTz();
        $invoiceTz = new \DateTimeZone($tz);

        $outDate = $this->getOutDate();

        $outDate = $outDate
            ->setTimezone($invoiceTz)
            ->modify('next day')
            ->setTime(0, 0, 0)
            ->modify('- 1 second');

        $this->setOutDate($outDate);
    }

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * @return array
     */
    public function getFileObjects(int $filter = null): array
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
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isWaiting(): bool
    {
        return $this->getStatus() === self::STATUS_WAITING;
    }

    public function setNumber(?string $number = null): static
    {
        if ($number === '') {
            //Avoid unique key issues
            $number = null;
        }

        return parent::setNumber($number);
    }

    protected function setInDate(DateTimeInterface|string|null $inDate = null): static
    {
        if (! $inDate) {
            throw new \DomainException('In date cannot be empty');
        }

        return parent::setInDate($inDate);
    }
    protected function setOutDate(DateTimeInterface|string|null $outDate = null): static
    {
        if (! $outDate) {
            throw new \DomainException('Out date cannot be empty');
        }

        return parent::setOutDate($outDate);
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

    protected function setStatusMsg(?string $statusMsg = null): static
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
