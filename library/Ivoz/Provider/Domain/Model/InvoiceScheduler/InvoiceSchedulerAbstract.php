<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\InvoiceScheduler;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplateInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequenceInterface;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplate;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequence;

/**
* InvoiceSchedulerAbstract
* @codeCoverageIgnore
*/
abstract class InvoiceSchedulerAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     * comment: enum:week|month|year
     */
    protected $unit = 'month';

    /**
     * @var int
     */
    protected $frequency;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var ?\DateTime
     */
    protected $lastExecution = null;

    /**
     * @var ?string
     */
    protected $lastExecutionError = null;

    /**
     * @var ?\DateTime
     */
    protected $nextExecution = null;

    /**
     * @var ?float
     */
    protected $taxRate = null;

    /**
     * @var ?InvoiceTemplateInterface
     */
    protected $invoiceTemplate = null;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var ?InvoiceNumberSequenceInterface
     */
    protected $numberSequence = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        string $unit,
        int $frequency,
        string $email
    ) {
        $this->setName($name);
        $this->setUnit($unit);
        $this->setFrequency($frequency);
        $this->setEmail($email);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "InvoiceScheduler",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): InvoiceSchedulerDto
    {
        return new InvoiceSchedulerDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|InvoiceSchedulerInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?InvoiceSchedulerDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, InvoiceSchedulerInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param InvoiceSchedulerDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, InvoiceSchedulerDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $unit = $dto->getUnit();
        Assertion::notNull($unit, 'getUnit value is null, but non null value was expected.');
        $frequency = $dto->getFrequency();
        Assertion::notNull($frequency, 'getFrequency value is null, but non null value was expected.');
        $email = $dto->getEmail();
        Assertion::notNull($email, 'getEmail value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $self = new static(
            $name,
            $unit,
            $frequency,
            $email
        );

        $self
            ->setLastExecution($dto->getLastExecution())
            ->setLastExecutionError($dto->getLastExecutionError())
            ->setNextExecution($dto->getNextExecution())
            ->setTaxRate($dto->getTaxRate())
            ->setInvoiceTemplate($fkTransformer->transform($dto->getInvoiceTemplate()))
            ->setBrand($fkTransformer->transform($brand))
            ->setCompany($fkTransformer->transform($company))
            ->setNumberSequence($fkTransformer->transform($dto->getNumberSequence()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param InvoiceSchedulerDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, InvoiceSchedulerDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $unit = $dto->getUnit();
        Assertion::notNull($unit, 'getUnit value is null, but non null value was expected.');
        $frequency = $dto->getFrequency();
        Assertion::notNull($frequency, 'getFrequency value is null, but non null value was expected.');
        $email = $dto->getEmail();
        Assertion::notNull($email, 'getEmail value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setUnit($unit)
            ->setFrequency($frequency)
            ->setEmail($email)
            ->setLastExecution($dto->getLastExecution())
            ->setLastExecutionError($dto->getLastExecutionError())
            ->setNextExecution($dto->getNextExecution())
            ->setTaxRate($dto->getTaxRate())
            ->setInvoiceTemplate($fkTransformer->transform($dto->getInvoiceTemplate()))
            ->setBrand($fkTransformer->transform($brand))
            ->setCompany($fkTransformer->transform($company))
            ->setNumberSequence($fkTransformer->transform($dto->getNumberSequence()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): InvoiceSchedulerDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setUnit(self::getUnit())
            ->setFrequency(self::getFrequency())
            ->setEmail(self::getEmail())
            ->setLastExecution(self::getLastExecution())
            ->setLastExecutionError(self::getLastExecutionError())
            ->setNextExecution(self::getNextExecution())
            ->setTaxRate(self::getTaxRate())
            ->setInvoiceTemplate(InvoiceTemplate::entityToDto(self::getInvoiceTemplate(), $depth))
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setNumberSequence(InvoiceNumberSequence::entityToDto(self::getNumberSequence(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'unit' => self::getUnit(),
            'frequency' => self::getFrequency(),
            'email' => self::getEmail(),
            'lastExecution' => self::getLastExecution(),
            'lastExecutionError' => self::getLastExecutionError(),
            'nextExecution' => self::getNextExecution(),
            'taxRate' => self::getTaxRate(),
            'invoiceTemplateId' => self::getInvoiceTemplate()?->getId(),
            'brandId' => self::getBrand()->getId(),
            'companyId' => self::getCompany()->getId(),
            'numberSequenceId' => self::getNumberSequence()?->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 40, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setUnit(string $unit): static
    {
        Assertion::maxLength($unit, 30, 'unit value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $unit,
            [
                InvoiceSchedulerInterface::UNIT_WEEK,
                InvoiceSchedulerInterface::UNIT_MONTH,
                InvoiceSchedulerInterface::UNIT_YEAR,
            ],
            'unitvalue "%s" is not an element of the valid values: %s'
        );

        $this->unit = $unit;

        return $this;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    protected function setFrequency(int $frequency): static
    {
        Assertion::greaterOrEqualThan($frequency, 0, 'frequency provided "%s" is not greater or equal than "%s".');

        $this->frequency = $frequency;

        return $this;
    }

    public function getFrequency(): int
    {
        return $this->frequency;
    }

    protected function setEmail(string $email): static
    {
        Assertion::maxLength($email, 140, 'email value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->email = $email;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    protected function setLastExecution(string|\DateTimeInterface|null $lastExecution = null): static
    {
        if (!is_null($lastExecution)) {

            /** @var ?\DateTime */
            $lastExecution = DateTimeHelper::createOrFix(
                $lastExecution,
                null
            );

            if ($this->isInitialized() && $this->lastExecution == $lastExecution) {
                return $this;
            }
        }

        $this->lastExecution = $lastExecution;

        return $this;
    }

    public function getLastExecution(): ?\DateTime
    {
        return !is_null($this->lastExecution) ? clone $this->lastExecution : null;
    }

    protected function setLastExecutionError(?string $lastExecutionError = null): static
    {
        if (!is_null($lastExecutionError)) {
            Assertion::maxLength($lastExecutionError, 300, 'lastExecutionError value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->lastExecutionError = $lastExecutionError;

        return $this;
    }

    public function getLastExecutionError(): ?string
    {
        return $this->lastExecutionError;
    }

    protected function setNextExecution(string|\DateTimeInterface|null $nextExecution = null): static
    {
        if (!is_null($nextExecution)) {

            /** @var ?\DateTime */
            $nextExecution = DateTimeHelper::createOrFix(
                $nextExecution,
                null
            );

            if ($this->isInitialized() && $this->nextExecution == $nextExecution) {
                return $this;
            }
        }

        $this->nextExecution = $nextExecution;

        return $this;
    }

    public function getNextExecution(): ?\DateTime
    {
        return !is_null($this->nextExecution) ? clone $this->nextExecution : null;
    }

    protected function setTaxRate(?float $taxRate = null): static
    {
        if (!is_null($taxRate)) {
            $taxRate = (float) $taxRate;
        }

        $this->taxRate = $taxRate;

        return $this;
    }

    public function getTaxRate(): ?float
    {
        return $this->taxRate;
    }

    protected function setInvoiceTemplate(?InvoiceTemplateInterface $invoiceTemplate = null): static
    {
        $this->invoiceTemplate = $invoiceTemplate;

        return $this;
    }

    public function getInvoiceTemplate(): ?InvoiceTemplateInterface
    {
        return $this->invoiceTemplate;
    }

    protected function setBrand(BrandInterface $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): BrandInterface
    {
        return $this->brand;
    }

    protected function setCompany(CompanyInterface $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

    protected function setNumberSequence(?InvoiceNumberSequenceInterface $numberSequence = null): static
    {
        $this->numberSequence = $numberSequence;

        return $this;
    }

    public function getNumberSequence(): ?InvoiceNumberSequenceInterface
    {
        return $this->numberSequence;
    }
}
