<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Core\Domain\Model\EntityInterface;

interface InvoiceInterface extends EntityInterface
{
    /**
     * Set number
     *
     * @param string $number
     *
     * @return self
     */
    public function setNumber($number);

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber();

    /**
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
     * Set pdf
     *
     * @param Pdf $pdf
     *
     * @return self
     */
    public function setPdf(\Ivoz\Provider\Domain\Model\Invoice\Pdf $pdf);

    /**
     * Get pdf
     *
     * @return Pdf
     */
    public function getPdf();

}

