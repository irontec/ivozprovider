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
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $unit = 'month';

    /**
     * @var int|null
     */
    private $frequency = null;

    /**
     * @var string|null
     */
    private $email = null;

    /**
     * @var \DateTimeInterface|string|null
     */
    private $lastExecution = null;

    /**
     * @var string|null
     */
    private $lastExecutionError = null;

    /**
     * @var \DateTimeInterface|string|null
     */
    private $nextExecution = null;

    /**
     * @var float|null
     */
    private $taxRate = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var InvoiceTemplateDto | null
     */
    private $invoiceTemplate = null;

    /**
     * @var BrandDto | null
     */
    private $brand = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    /**
     * @var InvoiceNumberSequenceDto | null
     */
    private $numberSequence = null;

    /**
     * @var FixedCostsRelInvoiceSchedulerDto[] | null
     */
    private $relFixedCosts = null;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
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
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setUnit(string $unit): static
    {
        $this->unit = $unit;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setFrequency(int $frequency): static
    {
        $this->frequency = $frequency;

        return $this;
    }

    public function getFrequency(): ?int
    {
        return $this->frequency;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setLastExecution(null|\DateTimeInterface|string $lastExecution): static
    {
        $this->lastExecution = $lastExecution;

        return $this;
    }

    public function getLastExecution(): \DateTimeInterface|string|null
    {
        return $this->lastExecution;
    }

    public function setLastExecutionError(?string $lastExecutionError): static
    {
        $this->lastExecutionError = $lastExecutionError;

        return $this;
    }

    public function getLastExecutionError(): ?string
    {
        return $this->lastExecutionError;
    }

    public function setNextExecution(null|\DateTimeInterface|string $nextExecution): static
    {
        $this->nextExecution = $nextExecution;

        return $this;
    }

    public function getNextExecution(): \DateTimeInterface|string|null
    {
        return $this->nextExecution;
    }

    public function setTaxRate(?float $taxRate): static
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    public function getTaxRate(): ?float
    {
        return $this->taxRate;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setInvoiceTemplate(?InvoiceTemplateDto $invoiceTemplate): static
    {
        $this->invoiceTemplate = $invoiceTemplate;

        return $this;
    }

    public function getInvoiceTemplate(): ?InvoiceTemplateDto
    {
        return $this->invoiceTemplate;
    }

    public function setInvoiceTemplateId($id): static
    {
        $value = !is_null($id)
            ? new InvoiceTemplateDto($id)
            : null;

        return $this->setInvoiceTemplate($value);
    }

    public function getInvoiceTemplateId()
    {
        if ($dto = $this->getInvoiceTemplate()) {
            return $dto->getId();
        }

        return null;
    }

    public function setBrand(?BrandDto $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    public function setBrandId($id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId($id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    public function setNumberSequence(?InvoiceNumberSequenceDto $numberSequence): static
    {
        $this->numberSequence = $numberSequence;

        return $this;
    }

    public function getNumberSequence(): ?InvoiceNumberSequenceDto
    {
        return $this->numberSequence;
    }

    public function setNumberSequenceId($id): static
    {
        $value = !is_null($id)
            ? new InvoiceNumberSequenceDto($id)
            : null;

        return $this->setNumberSequence($value);
    }

    public function getNumberSequenceId()
    {
        if ($dto = $this->getNumberSequence()) {
            return $dto->getId();
        }

        return null;
    }

    public function setRelFixedCosts(?array $relFixedCosts): static
    {
        $this->relFixedCosts = $relFixedCosts;

        return $this;
    }

    public function getRelFixedCosts(): ?array
    {
        return $this->relFixedCosts;
    }
}
