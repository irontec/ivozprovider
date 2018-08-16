<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface InvoiceInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return array
     */
    public function getFileObjects();

    /**
     * @return bool
     */
    public function isProcessing();

    public function setNumber($number = null);

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber();

    /**
     * @deprecated
     * Set inDate
     *
     * @param \DateTime $inDate
     *
     * @return self
     */
    public function setInDate($inDate = null);

    /**
     * Get inDate
     *
     * @return \DateTime
     */
    public function getInDate();

    /**
     * @deprecated
     * Set outDate
     *
     * @param \DateTime $outDate
     *
     * @return self
     */
    public function setOutDate($outDate = null);

    /**
     * Get outDate
     *
     * @return \DateTime
     */
    public function getOutDate();

    /**
     * @deprecated
     * Set total
     *
     * @param string $total
     *
     * @return self
     */
    public function setTotal($total = null);

    /**
     * Get total
     *
     * @return string
     */
    public function getTotal();

    /**
     * @deprecated
     * Set taxRate
     *
     * @param string $taxRate
     *
     * @return self
     */
    public function setTaxRate($taxRate = null);

    /**
     * Get taxRate
     *
     * @return string
     */
    public function getTaxRate();

    /**
     * @deprecated
     * Set totalWithTax
     *
     * @param string $totalWithTax
     *
     * @return self
     */
    public function setTotalWithTax($totalWithTax = null);

    /**
     * Get totalWithTax
     *
     * @return string
     */
    public function getTotalWithTax();

    /**
     * @deprecated
     * Set status
     *
     * @param string $status
     *
     * @return self
     */
    public function setStatus($status = null);

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus();

    /**
     * @deprecated
     * Set statusMsg
     *
     * @param string $statusMsg
     *
     * @return self
     */
    public function setStatusMsg($statusMsg = null);

    /**
     * Get statusMsg
     *
     * @return string
     */
    public function getStatusMsg();

    /**
     * Set invoiceTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface $invoiceTemplate
     *
     * @return self
     */
    public function setInvoiceTemplate(\Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface $invoiceTemplate = null);

    /**
     * Get invoiceTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface
     */
    public function getInvoiceTemplate();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
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
     * @return self
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
     * @param \Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface $numberSequence
     *
     * @return self
     */
    public function setNumberSequence(\Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface $numberSequence = null);

    /**
     * Get numberSequence
     *
     * @return \Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface
     */
    public function getNumberSequence();

    /**
     * Set scheduler
     *
     * @param \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface $scheduler
     *
     * @return self
     */
    public function setScheduler(\Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface $scheduler = null);

    /**
     * Get scheduler
     *
     * @return \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerInterface
     */
    public function getScheduler();

    /**
     * Set pdf
     *
     * @param \Ivoz\Provider\Domain\Model\Invoice\Pdf $pdf
     *
     * @return self
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
     * @return InvoiceTrait
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
     * @param \Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface[] $relFixedCosts
     * @return self
     */
    public function replaceRelFixedCosts(Collection $relFixedCosts);

    /**
     * Get relFixedCosts
     *
     * @return \Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceInterface[]
     */
    public function getRelFixedCosts(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * @param $fldName
     * @param TempFile $file
     */
    public function addTmpFile($fldName, \Ivoz\Core\Domain\Service\TempFile $file);

    /**
     * @param TempFile $file
     * @throws \Exception
     */
    public function removeTmpFile(\Ivoz\Core\Domain\Service\TempFile $file);

    /**
     * @return TempFile[]
     */
    public function getTempFiles();

    /**
     * @var string $fldName
     * @return null | TempFile
     */
    public function getTempFileByFieldName($fldName);

}

