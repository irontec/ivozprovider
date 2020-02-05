<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

interface InvoiceInterface extends FileContainerInterface, LoggableEntityInterface
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
    public function isWaiting();

    public function setNumber($number = null);

    public function mustRunInvoicer();

    public function mustCheckValidity();

    /**
     * Get number
     *
     * @return string | null
     */
    public function getNumber();

    /**
     * Get inDate
     *
     * @return \DateTime | null
     */
    public function getInDate();

    /**
     * Get outDate
     *
     * @return \DateTime | null
     */
    public function getOutDate();

    /**
     * Get total
     *
     * @return float | null
     */
    public function getTotal();

    /**
     * Get taxRate
     *
     * @return float | null
     */
    public function getTaxRate();

    /**
     * Get totalWithTax
     *
     * @return float | null
     */
    public function getTotalWithTax();

    /**
     * Get status
     *
     * @return string | null
     */
    public function getStatus();

    /**
     * Get statusMsg
     *
     * @return string | null
     */
    public function getStatusMsg();

    /**
     * Set invoiceTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface $invoiceTemplate | null
     *
     * @return static
     */
    public function setInvoiceTemplate(\Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface $invoiceTemplate = null);

    /**
     * Get invoiceTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface | null
     */
    public function getInvoiceTemplate();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set numberSequence
     *
     * @param \Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface $numberSequence | null
     *
     * @return static
     */
    public function setNumberSequence(\Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface $numberSequence = null);

    /**
     * Get numberSequence
     *
     * @return \Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface | null
     */
    public function getNumberSequence();

    /**
     * Set scheduler
     *
     * @param \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface $scheduler | null
     *
     * @return static
     */
    public function setScheduler(\Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface $scheduler = null);

    /**
     * Get scheduler
     *
     * @return \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface | null
     */
    public function getScheduler();

    /**
     * Set pdf
     *
     * @param \Ivoz\Provider\Domain\Model\Invoice\Pdf $pdf
     *
     * @return static
     */
    public function setPdf(\Ivoz\Provider\Domain\Model\Invoice\Pdf $pdf);

    /**
     * Get pdf
     *
     * @return \Ivoz\Provider\Domain\Model\Invoice\Pdf
     */
    public function getPdf();

    /**
     * Add relFixedCost
     *
     * @param \Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface $relFixedCost
     *
     * @return static
     */
    public function addRelFixedCost(\Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface $relFixedCost);

    /**
     * Remove relFixedCost
     *
     * @param \Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface $relFixedCost
     */
    public function removeRelFixedCost(\Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface $relFixedCost);

    /**
     * Replace relFixedCosts
     *
     * @param ArrayCollection $relFixedCosts of Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface
     * @return static
     */
    public function replaceRelFixedCosts(ArrayCollection $relFixedCosts);

    /**
     * Get relFixedCosts
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface[]
     */
    public function getRelFixedCosts(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * @param string $fldName
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     *
     * @return void
     */
    public function addTmpFile($fldName, \Ivoz\Core\Domain\Service\TempFile $file);

    /**
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     *
     * @throws \Exception
     *
     * @return void
     */
    public function removeTmpFile(\Ivoz\Core\Domain\Service\TempFile $file);

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
