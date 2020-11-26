<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateDto;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceDto;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceSchedulerDto;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoiceDto;

/**
* InvoiceDtoAbstract
* @codeCoverageIgnore
*/
abstract class InvoiceDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string | null
     */
    private $number;

    /**
     * @var \DateTimeInterface | null
     */
    private $inDate;

    /**
     * @var \DateTimeInterface | null
     */
    private $outDate;

    /**
     * @var float | null
     */
    private $total;

    /**
     * @var float | null
     */
    private $taxRate;

    /**
     * @var float | null
     */
    private $totalWithTax;

    /**
     * @var string | null
     */
    private $status;

    /**
     * @var string | null
     */
    private $statusMsg;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int | null
     */
    private $pdfFileSize;

    /**
     * @var string | null
     */
    private $pdfMimeType;

    /**
     * @var string | null
     */
    private $pdfBaseName;

    /**
     * @var InvoiceTemplateDto | null
     */
    private $invoiceTemplate;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var InvoiceNumberSequenceDto | null
     */
    private $numberSequence;

    /**
     * @var InvoiceSchedulerDto | null
     */
    private $scheduler;

    /**
     * @var FixedCostsRelInvoiceDto[] | null
     */
    private $relFixedCosts;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
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
            'pdf' => [
                'fileSize',
                'mimeType',
                'baseName',
            ],
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
        $response = [
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
                'baseName' => $this->getPdfBaseName(),
            ],
            'invoiceTemplate' => $this->getInvoiceTemplate(),
            'brand' => $this->getBrand(),
            'company' => $this->getCompany(),
            'numberSequence' => $this->getNumberSequence(),
            'scheduler' => $this->getScheduler(),
            'relFixedCosts' => $this->getRelFixedCosts()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    /**
     * @param string $number | null
     *
     * @return static
     */
    public function setNumber(?string $number = null): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @param \DateTimeInterface $inDate | null
     *
     * @return static
     */
    public function setInDate($inDate = null): self
    {
        $this->inDate = $inDate;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getInDate()
    {
        return $this->inDate;
    }

    /**
     * @param \DateTimeInterface $outDate | null
     *
     * @return static
     */
    public function setOutDate($outDate = null): self
    {
        $this->outDate = $outDate;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getOutDate()
    {
        return $this->outDate;
    }

    /**
     * @param float $total | null
     *
     * @return static
     */
    public function setTotal(?float $total = null): self
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getTotal(): ?float
    {
        return $this->total;
    }

    /**
     * @param float $taxRate | null
     *
     * @return static
     */
    public function setTaxRate(?float $taxRate = null): self
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getTaxRate(): ?float
    {
        return $this->taxRate;
    }

    /**
     * @param float $totalWithTax | null
     *
     * @return static
     */
    public function setTotalWithTax(?float $totalWithTax = null): self
    {
        $this->totalWithTax = $totalWithTax;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getTotalWithTax(): ?float
    {
        return $this->totalWithTax;
    }

    /**
     * @param string $status | null
     *
     * @return static
     */
    public function setStatus(?string $status = null): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $statusMsg | null
     *
     * @return static
     */
    public function setStatusMsg(?string $statusMsg = null): self
    {
        $this->statusMsg = $statusMsg;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getStatusMsg(): ?string
    {
        return $this->statusMsg;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $pdfFileSize | null
     *
     * @return static
     */
    public function setPdfFileSize(?int $pdfFileSize = null): self
    {
        $this->pdfFileSize = $pdfFileSize;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPdfFileSize(): ?int
    {
        return $this->pdfFileSize;
    }

    /**
     * @param string $pdfMimeType | null
     *
     * @return static
     */
    public function setPdfMimeType(?string $pdfMimeType = null): self
    {
        $this->pdfMimeType = $pdfMimeType;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPdfMimeType(): ?string
    {
        return $this->pdfMimeType;
    }

    /**
     * @param string $pdfBaseName | null
     *
     * @return static
     */
    public function setPdfBaseName(?string $pdfBaseName = null): self
    {
        $this->pdfBaseName = $pdfBaseName;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPdfBaseName(): ?string
    {
        return $this->pdfBaseName;
    }

    /**
     * @param InvoiceTemplateDto | null
     *
     * @return static
     */
    public function setInvoiceTemplate(?InvoiceTemplateDto $invoiceTemplate = null): self
    {
        $this->invoiceTemplate = $invoiceTemplate;

        return $this;
    }

    /**
     * @return InvoiceTemplateDto | null
     */
    public function getInvoiceTemplate(): ?InvoiceTemplateDto
    {
        return $this->invoiceTemplate;
    }

    /**
     * @return static
     */
    public function setInvoiceTemplateId($id): self
    {
        $value = !is_null($id)
            ? new InvoiceTemplateDto($id)
            : null;

        return $this->setInvoiceTemplate($value);
    }

    /**
     * @return mixed | null
     */
    public function getInvoiceTemplateId()
    {
        if ($dto = $this->getInvoiceTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param BrandDto | null
     *
     * @return static
     */
    public function setBrand(?BrandDto $brand = null): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return BrandDto | null
     */
    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    /**
     * @return static
     */
    public function setBrandId($id): self
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return mixed | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CompanyDto | null
     *
     * @return static
     */
    public function setCompany(?CompanyDto $company = null): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return CompanyDto | null
     */
    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    /**
     * @return static
     */
    public function setCompanyId($id): self
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return mixed | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param InvoiceNumberSequenceDto | null
     *
     * @return static
     */
    public function setNumberSequence(?InvoiceNumberSequenceDto $numberSequence = null): self
    {
        $this->numberSequence = $numberSequence;

        return $this;
    }

    /**
     * @return InvoiceNumberSequenceDto | null
     */
    public function getNumberSequence(): ?InvoiceNumberSequenceDto
    {
        return $this->numberSequence;
    }

    /**
     * @return static
     */
    public function setNumberSequenceId($id): self
    {
        $value = !is_null($id)
            ? new InvoiceNumberSequenceDto($id)
            : null;

        return $this->setNumberSequence($value);
    }

    /**
     * @return mixed | null
     */
    public function getNumberSequenceId()
    {
        if ($dto = $this->getNumberSequence()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param InvoiceSchedulerDto | null
     *
     * @return static
     */
    public function setScheduler(?InvoiceSchedulerDto $scheduler = null): self
    {
        $this->scheduler = $scheduler;

        return $this;
    }

    /**
     * @return InvoiceSchedulerDto | null
     */
    public function getScheduler(): ?InvoiceSchedulerDto
    {
        return $this->scheduler;
    }

    /**
     * @return static
     */
    public function setSchedulerId($id): self
    {
        $value = !is_null($id)
            ? new InvoiceSchedulerDto($id)
            : null;

        return $this->setScheduler($value);
    }

    /**
     * @return mixed | null
     */
    public function getSchedulerId()
    {
        if ($dto = $this->getScheduler()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param FixedCostsRelInvoiceDto[] | null
     *
     * @return static
     */
    public function setRelFixedCosts(?array $relFixedCosts = null): self
    {
        $this->relFixedCosts = $relFixedCosts;

        return $this;
    }

    /**
     * @return FixedCostsRelInvoiceDto[] | null
     */
    public function getRelFixedCosts(): ?array
    {
        return $this->relFixedCosts;
    }

}
