<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
* InvoiceInterface
*/
interface InvoiceInterface extends LoggableEntityInterface, FileContainerInterface
{
    const STATUS_WAITING = 'waiting';

    const STATUS_PROCESSING = 'processing';

    const STATUS_CREATED = 'created';

    const STATUS_ERROR = 'error';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return array
     */
    public function getFileObjects(int $filter = null);

    /**
     * @return bool
     */
    public function isWaiting(): bool;

    public function setNumber(string $number = null): InvoiceInterface;

    public function mustRunInvoicer(): bool;

    public function mustCheckValidity(): bool;

    /**
     * Get number
     *
     * @return string | null
     */
    public function getNumber(): ?string;

    /**
     * Get inDate
     *
     * @return \DateTimeInterface | null
     */
    public function getInDate(): ?\DateTimeInterface;

    /**
     * Get outDate
     *
     * @return \DateTimeInterface | null
     */
    public function getOutDate(): ?\DateTimeInterface;

    /**
     * Get total
     *
     * @return float | null
     */
    public function getTotal(): ?float;

    /**
     * Get taxRate
     *
     * @return float | null
     */
    public function getTaxRate(): ?float;

    /**
     * Get totalWithTax
     *
     * @return float | null
     */
    public function getTotalWithTax(): ?float;

    /**
     * Get status
     *
     * @return string | null
     */
    public function getStatus(): ?string;

    /**
     * Get statusMsg
     *
     * @return string | null
     */
    public function getStatusMsg(): ?string;

    /**
     * Get pdf
     *
     * @return Pdf
     */
    public function getPdf(): Pdf;

    /**
     * Get invoiceTemplate
     *
     * @return InvoiceTemplateInterface | null
     */
    public function getInvoiceTemplate(): ?InvoiceTemplateInterface;

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * Get numberSequence
     *
     * @return InvoiceNumberSequenceInterface | null
     */
    public function getNumberSequence(): ?InvoiceNumberSequenceInterface;

    /**
     * Get scheduler
     *
     * @return InvoiceSchedulerInterface | null
     */
    public function getScheduler(): ?InvoiceSchedulerInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add relFixedCost
     *
     * @param FixedCostsRelInvoiceInterface $relFixedCost
     *
     * @return static
     */
    public function addRelFixedCost(FixedCostsRelInvoiceInterface $relFixedCost): InvoiceInterface;

    /**
     * Remove relFixedCost
     *
     * @param FixedCostsRelInvoiceInterface $relFixedCost
     *
     * @return static
     */
    public function removeRelFixedCost(FixedCostsRelInvoiceInterface $relFixedCost): InvoiceInterface;

    /**
     * Replace relFixedCosts
     *
     * @param ArrayCollection $relFixedCosts of FixedCostsRelInvoiceInterface
     *
     * @return static
     */
    public function replaceRelFixedCosts(ArrayCollection $relFixedCosts): InvoiceInterface;

    /**
     * Get relFixedCosts
     * @param Criteria | null $criteria
     * @return FixedCostsRelInvoiceInterface[]
     */
    public function getRelFixedCosts(?Criteria $criteria = null): array;

    /**
     * @return void
     */
    public function addTmpFile(string $fldName, TempFile $file);

    /**
     * @throws \Exception
     * @return void
     */
    public function removeTmpFile(TempFile $file);

    /**
     * @return \Ivoz\Core\Domain\Service\TempFile[]
     */
    public function getTempFiles();

    /**
     * @var string $fldName
     * @return null | \Ivoz\Core\Domain\Service\TempFile
     */
    public function getTempFileByFieldName($fldName);

}
