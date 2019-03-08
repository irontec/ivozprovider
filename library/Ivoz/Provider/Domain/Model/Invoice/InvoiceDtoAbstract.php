<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class InvoiceDtoAbstract implements DataTransferObjectInterface
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
     * @var float
     */
    private $total;

    /**
     * @var float
     */
    private $taxRate;

    /**
     * @var float
     */
    private $totalWithTax;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $statusMsg;

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
     * @var \Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateDto | null
     */
    private $invoiceTemplate;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceDto | null
     */
    private $numberSequence;

    /**
     * @var \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto | null
     */
    private $scheduler;

    /**
     * @var \Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceDto[] | null
     */
    private $relFixedCosts = null;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'number' => 'number',
            'inDate' => 'inDate',
            'outDate' => 'outDate',
            'total' => 'total',
            'taxRate' => 'taxRate',
            'totalWithTax' => 'totalWithTax',
            'status' => 'status',
            'statusMsg' => 'statusMsg',
            'id' => 'id',
            'pdf' => ['fileSize','mimeType','baseName'],
            'invoiceTemplateId' => 'invoiceTemplate',
            'brandId' => 'brand',
            'companyId' => 'company',
            'numberSequenceId' => 'numberSequence',
            'schedulerId' => 'scheduler'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'number' => $this->getNumber(),
            'inDate' => $this->getInDate(),
            'outDate' => $this->getOutDate(),
            'total' => $this->getTotal(),
            'taxRate' => $this->getTaxRate(),
            'totalWithTax' => $this->getTotalWithTax(),
            'status' => $this->getStatus(),
            'statusMsg' => $this->getStatusMsg(),
            'id' => $this->getId(),
            'pdf' => [
                'fileSize' => $this->getPdfFileSize(),
                'mimeType' => $this->getPdfMimeType(),
                'baseName' => $this->getPdfBaseName()
            ],
            'invoiceTemplate' => $this->getInvoiceTemplate(),
            'brand' => $this->getBrand(),
            'company' => $this->getCompany(),
            'numberSequence' => $this->getNumberSequence(),
            'scheduler' => $this->getScheduler(),
            'relFixedCosts' => $this->getRelFixedCosts()
        ];
    }

    /**
     * @param string $number
     *
     * @return static
     */
    public function setNumber($number = null)
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
     * @return static
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
     * @return static
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
     * @param float $total
     *
     * @return static
     */
    public function setTotal($total = null)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param float $taxRate
     *
     * @return static
     */
    public function setTaxRate($taxRate = null)
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    /**
     * @return float
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * @param float $totalWithTax
     *
     * @return static
     */
    public function setTotalWithTax($totalWithTax = null)
    {
        $this->totalWithTax = $totalWithTax;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalWithTax()
    {
        return $this->totalWithTax;
    }

    /**
     * @param string $status
     *
     * @return static
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
     * @param string $statusMsg
     *
     * @return static
     */
    public function setStatusMsg($statusMsg = null)
    {
        $this->statusMsg = $statusMsg;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatusMsg()
    {
        return $this->statusMsg;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
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
     * @return static
     */
    public function setPdfFileSize($pdfFileSize = null)
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
     * @return static
     */
    public function setPdfMimeType($pdfMimeType = null)
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
     * @return static
     */
    public function setPdfBaseName($pdfBaseName = null)
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
     * @param \Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateDto $invoiceTemplate
     *
     * @return static
     */
    public function setInvoiceTemplate(\Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateDto $invoiceTemplate = null)
    {
        $this->invoiceTemplate = $invoiceTemplate;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateDto
     */
    public function getInvoiceTemplate()
    {
        return $this->invoiceTemplate;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setInvoiceTemplateId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateDto($id)
            : null;

        return $this->setInvoiceTemplate($value);
    }

    /**
     * @return integer | null
     */
    public function getInvoiceTemplateId()
    {
        if ($dto = $this->getInvoiceTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandDto $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandDto $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandDto
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setBrandId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Brand\BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return integer | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCompanyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return integer | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceDto $numberSequence
     *
     * @return static
     */
    public function setNumberSequence(\Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceDto $numberSequence = null)
    {
        $this->numberSequence = $numberSequence;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceDto
     */
    public function getNumberSequence()
    {
        return $this->numberSequence;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setNumberSequenceId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceDto($id)
            : null;

        return $this->setNumberSequence($value);
    }

    /**
     * @return integer | null
     */
    public function getNumberSequenceId()
    {
        if ($dto = $this->getNumberSequence()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto $scheduler
     *
     * @return static
     */
    public function setScheduler(\Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto $scheduler = null)
    {
        $this->scheduler = $scheduler;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto
     */
    public function getScheduler()
    {
        return $this->scheduler;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setSchedulerId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto($id)
            : null;

        return $this->setScheduler($value);
    }

    /**
     * @return integer | null
     */
    public function getSchedulerId()
    {
        if ($dto = $this->getScheduler()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param array $relFixedCosts
     *
     * @return static
     */
    public function setRelFixedCosts($relFixedCosts = null)
    {
        $this->relFixedCosts = $relFixedCosts;

        return $this;
    }

    /**
     * @return array
     */
    public function getRelFixedCosts()
    {
        return $this->relFixedCosts;
    }
}
