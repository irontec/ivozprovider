<?php

namespace Ivoz\Provider\Domain\Model\InvoiceScheduler;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateDto;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceDto;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceSchedulerDto;

/**
* InvoiceSchedulerDtoAbstract
* @codeCoverageIgnore
*/
abstract class InvoiceSchedulerDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $unit = 'month';

    /**
     * @var int
     */
    private $frequency;

    /**
     * @var string
     */
    private $email;

    /**
     * @var \DateTimeInterface | null
     */
    private $lastExecution;

    /**
     * @var string | null
     */
    private $lastExecutionError;

    /**
     * @var \DateTimeInterface | null
     */
    private $nextExecution;

    /**
     * @var float | null
     */
    private $taxRate;

    /**
     * @var int
     */
    private $id;

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
     * @var FixedCostsRelInvoiceSchedulerDto[] | null
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
            'name' => 'name',
            'unit' => 'unit',
            'frequency' => 'frequency',
            'email' => 'email',
            'lastExecution' => 'lastExecution',
            'lastExecutionError' => 'lastExecutionError',
            'nextExecution' => 'nextExecution',
            'taxRate' => 'taxRate',
            'id' => 'id',
            'invoiceTemplateId' => 'invoiceTemplate',
            'brandId' => 'brand',
            'companyId' => 'company',
            'numberSequenceId' => 'numberSequence'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'name' => $this->getName(),
            'unit' => $this->getUnit(),
            'frequency' => $this->getFrequency(),
            'email' => $this->getEmail(),
            'lastExecution' => $this->getLastExecution(),
            'lastExecutionError' => $this->getLastExecutionError(),
            'nextExecution' => $this->getNextExecution(),
            'taxRate' => $this->getTaxRate(),
            'id' => $this->getId(),
            'invoiceTemplate' => $this->getInvoiceTemplate(),
            'brand' => $this->getBrand(),
            'company' => $this->getCompany(),
            'numberSequence' => $this->getNumberSequence(),
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
     * @param string $name | null
     *
     * @return static
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $unit | null
     *
     * @return static
     */
    public function setUnit(?string $unit = null): self
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUnit(): ?string
    {
        return $this->unit;
    }

    /**
     * @param int $frequency | null
     *
     * @return static
     */
    public function setFrequency(?int $frequency = null): self
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getFrequency(): ?int
    {
        return $this->frequency;
    }

    /**
     * @param string $email | null
     *
     * @return static
     */
    public function setEmail(?string $email = null): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param \DateTimeInterface $lastExecution | null
     *
     * @return static
     */
    public function setLastExecution($lastExecution = null): self
    {
        $this->lastExecution = $lastExecution;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getLastExecution()
    {
        return $this->lastExecution;
    }

    /**
     * @param string $lastExecutionError | null
     *
     * @return static
     */
    public function setLastExecutionError(?string $lastExecutionError = null): self
    {
        $this->lastExecutionError = $lastExecutionError;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLastExecutionError(): ?string
    {
        return $this->lastExecutionError;
    }

    /**
     * @param \DateTimeInterface $nextExecution | null
     *
     * @return static
     */
    public function setNextExecution($nextExecution = null): self
    {
        $this->nextExecution = $nextExecution;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getNextExecution()
    {
        return $this->nextExecution;
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
     * @param FixedCostsRelInvoiceSchedulerDto[] | null
     *
     * @return static
     */
    public function setRelFixedCosts(?array $relFixedCosts = null): self
    {
        $this->relFixedCosts = $relFixedCosts;

        return $this;
    }

    /**
     * @return FixedCostsRelInvoiceSchedulerDto[] | null
     */
    public function getRelFixedCosts(): ?array
    {
        return $this->relFixedCosts;
    }

}
