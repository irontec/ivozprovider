<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class InvoiceDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $number;

    /**
     * @var \DateTime
     */
    private $inDate;

    /**
     * @var \DateTime
     */
    private $outDate;

    /**
     * @var string
     */
    private $total;

    /**
     * @var string
     */
    private $taxRate;

    /**
     * @var string
     */
    private $totalWithTax;

    /**
     * @var string
     */
    private $status;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $pdfFileSize;

    /**
     * @var string
     */
    private $pdfMimeType;

    /**
     * @var string
     */
    private $pdfBaseName;

    /**
     * @var mixed
     */
    private $invoiceTemplateId;

    /**
     * @var mixed
     */
    private $brandId;

    /**
     * @var mixed
     */
    private $companyId;

    /**
     * @var mixed
     */
    private $invoiceTemplate;

    /**
     * @var mixed
     */
    private $brand;

    /**
     * @var mixed
     */
    private $company;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'number' => $this->getNumber(),
            'inDate' => $this->getInDate(),
            'outDate' => $this->getOutDate(),
            'total' => $this->getTotal(),
            'taxRate' => $this->getTaxRate(),
            'totalWithTax' => $this->getTotalWithTax(),
            'status' => $this->getStatus(),
            'id' => $this->getId(),
            'pdfFileSize' => $this->getPdfFileSize(),
            'pdfMimeType' => $this->getPdfMimeType(),
            'pdfBaseName' => $this->getPdfBaseName(),
            'invoiceTemplateId' => $this->getInvoiceTemplateId(),
            'brandId' => $this->getBrandId(),
            'companyId' => $this->getCompanyId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->invoiceTemplate = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\InvoiceTemplate\\InvoiceTemplate', $this->getInvoiceTemplateId());
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $number
     *
     * @return InvoiceDTO
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param \DateTime $inDate
     *
     * @return InvoiceDTO
     */
    public function setInDate($inDate = null)
    {
        $this->inDate = $inDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getInDate()
    {
        return $this->inDate;
    }

    /**
     * @param \DateTime $outDate
     *
     * @return InvoiceDTO
     */
    public function setOutDate($outDate = null)
    {
        $this->outDate = $outDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOutDate()
    {
        return $this->outDate;
    }

    /**
     * @param string $total
     *
     * @return InvoiceDTO
     */
    public function setTotal($total = null)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param string $taxRate
     *
     * @return InvoiceDTO
     */
    public function setTaxRate($taxRate = null)
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    /**
     * @return string
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * @param string $totalWithTax
     *
     * @return InvoiceDTO
     */
    public function setTotalWithTax($totalWithTax = null)
    {
        $this->totalWithTax = $totalWithTax;

        return $this;
    }

    /**
     * @return string
     */
    public function getTotalWithTax()
    {
        return $this->totalWithTax;
    }

    /**
     * @param string $status
     *
     * @return InvoiceDTO
     */
    public function setStatus($status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param integer $id
     *
     * @return InvoiceDTO
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $pdfFileSize
     *
     * @return InvoiceDTO
     */
    public function setPdfFileSize($pdfFileSize)
    {
        $this->pdfFileSize = $pdfFileSize;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPdfFileSize()
    {
        return $this->pdfFileSize;
    }

    /**
     * @param string $pdfMimeType
     *
     * @return InvoiceDTO
     */
    public function setPdfMimeType($pdfMimeType)
    {
        $this->pdfMimeType = $pdfMimeType;

        return $this;
    }

    /**
     * @return string
     */
    public function getPdfMimeType()
    {
        return $this->pdfMimeType;
    }

    /**
     * @param string $pdfBaseName
     *
     * @return InvoiceDTO
     */
    public function setPdfBaseName($pdfBaseName)
    {
        $this->pdfBaseName = $pdfBaseName;

        return $this;
    }

    /**
     * @return string
     */
    public function getPdfBaseName()
    {
        return $this->pdfBaseName;
    }

    /**
     * @param integer $invoiceTemplateId
     *
     * @return InvoiceDTO
     */
    public function setInvoiceTemplateId($invoiceTemplateId)
    {
        $this->invoiceTemplateId = $invoiceTemplateId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getInvoiceTemplateId()
    {
        return $this->invoiceTemplateId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplate
     */
    public function getInvoiceTemplate()
    {
        return $this->invoiceTemplate;
    }

    /**
     * @param integer $brandId
     *
     * @return InvoiceDTO
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param integer $companyId
     *
     * @return InvoiceDTO
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\Company
     */
    public function getCompany()
    {
        return $this->company;
    }
}

