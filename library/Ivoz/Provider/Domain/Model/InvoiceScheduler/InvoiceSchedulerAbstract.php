<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\InvoiceScheduler;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * comment: enum:week|month|year
     * @var string
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
     * @var \DateTimeInterface | null
     */
    protected $lastExecution;

    /**
     * @var string | null
     */
    protected $lastExecutionError;

    /**
     * @var \DateTimeInterface | null
     */
    protected $nextExecution;

    /**
     * @var float | null
     */
    protected $taxRate;

    /**
     * @var InvoiceTemplateInterface
     */
    protected $invoiceTemplate;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var InvoiceNumberSequenceInterface
     */
    protected $numberSequence;

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        $unit,
        $frequency,
        $email
    ) {
        $this->setName($name);
        $this->setUnit($unit);
        $this->setFrequency($frequency);
        $this->setEmail($email);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "InvoiceScheduler",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return InvoiceSchedulerDto
     */
    public static function createDto($id = null)
    {
        return new InvoiceSchedulerDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param InvoiceSchedulerInterface|null $entity
     * @param int $depth
     * @return InvoiceSchedulerDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var InvoiceSchedulerDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param InvoiceSchedulerDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, InvoiceSchedulerDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getUnit(),
            $dto->getFrequency(),
            $dto->getEmail()
        );

        $self
            ->setLastExecution($dto->getLastExecution())
            ->setLastExecutionError($dto->getLastExecutionError())
            ->setNextExecution($dto->getNextExecution())
            ->setTaxRate($dto->getTaxRate())
            ->setInvoiceTemplate($fkTransformer->transform($dto->getInvoiceTemplate()))
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setNumberSequence($fkTransformer->transform($dto->getNumberSequence()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param InvoiceSchedulerDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, InvoiceSchedulerDto::class);

        $this
            ->setName($dto->getName())
            ->setUnit($dto->getUnit())
            ->setFrequency($dto->getFrequency())
            ->setEmail($dto->getEmail())
            ->setLastExecution($dto->getLastExecution())
            ->setLastExecutionError($dto->getLastExecutionError())
            ->setNextExecution($dto->getNextExecution())
            ->setTaxRate($dto->getTaxRate())
            ->setInvoiceTemplate($fkTransformer->transform($dto->getInvoiceTemplate()))
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setNumberSequence($fkTransformer->transform($dto->getNumberSequence()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return InvoiceSchedulerDto
     */
    public function toDto($depth = 0)
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
     * @return array
     */
    protected function __toArray()
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
            'invoiceTemplateId' => self::getInvoiceTemplate() ? self::getInvoiceTemplate()->getId() : null,
            'brandId' => self::getBrand()->getId(),
            'companyId' => self::getCompany()->getId(),
            'numberSequenceId' => self::getNumberSequence() ? self::getNumberSequence()->getId() : null
        ];
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName(string $name): InvoiceSchedulerInterface
    {
        Assertion::maxLength($name, 40, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set unit
     *
     * @param string $unit
     *
     * @return static
     */
    protected function setUnit(string $unit): InvoiceSchedulerInterface
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

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * Set frequency
     *
     * @param int $frequency
     *
     * @return static
     */
    protected function setFrequency(int $frequency): InvoiceSchedulerInterface
    {
        Assertion::greaterOrEqualThan($frequency, 0, 'frequency provided "%s" is not greater or equal than "%s".');

        $this->frequency = $frequency;

        return $this;
    }

    /**
     * Get frequency
     *
     * @return int
     */
    public function getFrequency(): int
    {
        return $this->frequency;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return static
     */
    protected function setEmail(string $email): InvoiceSchedulerInterface
    {
        Assertion::maxLength($email, 140, 'email value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set lastExecution
     *
     * @param \DateTimeInterface $lastExecution | null
     *
     * @return static
     */
    protected function setLastExecution($lastExecution = null): InvoiceSchedulerInterface
    {
        if (!is_null($lastExecution)) {
            Assertion::notNull(
                $lastExecution,
                'lastExecution value "%s" is null, but non null value was expected.'
            );
            $lastExecution = DateTimeHelper::createOrFix(
                $lastExecution,
                null
            );

            if ($this->lastExecution == $lastExecution) {
                return $this;
            }
        }

        $this->lastExecution = $lastExecution;

        return $this;
    }

    /**
     * Get lastExecution
     *
     * @return \DateTimeInterface | null
     */
    public function getLastExecution(): ?\DateTimeInterface
    {
        return !is_null($this->lastExecution) ? clone $this->lastExecution : null;
    }

    /**
     * Set lastExecutionError
     *
     * @param string $lastExecutionError | null
     *
     * @return static
     */
    protected function setLastExecutionError(?string $lastExecutionError = null): InvoiceSchedulerInterface
    {
        if (!is_null($lastExecutionError)) {
            Assertion::maxLength($lastExecutionError, 300, 'lastExecutionError value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->lastExecutionError = $lastExecutionError;

        return $this;
    }

    /**
     * Get lastExecutionError
     *
     * @return string | null
     */
    public function getLastExecutionError(): ?string
    {
        return $this->lastExecutionError;
    }

    /**
     * Set nextExecution
     *
     * @param \DateTimeInterface $nextExecution | null
     *
     * @return static
     */
    protected function setNextExecution($nextExecution = null): InvoiceSchedulerInterface
    {
        if (!is_null($nextExecution)) {
            Assertion::notNull(
                $nextExecution,
                'nextExecution value "%s" is null, but non null value was expected.'
            );
            $nextExecution = DateTimeHelper::createOrFix(
                $nextExecution,
                null
            );

            if ($this->nextExecution == $nextExecution) {
                return $this;
            }
        }

        $this->nextExecution = $nextExecution;

        return $this;
    }

    /**
     * Get nextExecution
     *
     * @return \DateTimeInterface | null
     */
    public function getNextExecution(): ?\DateTimeInterface
    {
        return !is_null($this->nextExecution) ? clone $this->nextExecution : null;
    }

    /**
     * Set taxRate
     *
     * @param float $taxRate | null
     *
     * @return static
     */
    protected function setTaxRate(?float $taxRate = null): InvoiceSchedulerInterface
    {
        if (!is_null($taxRate)) {
            $taxRate = (float) $taxRate;
        }

        $this->taxRate = $taxRate;

        return $this;
    }

    /**
     * Get taxRate
     *
     * @return float | null
     */
    public function getTaxRate(): ?float
    {
        return $this->taxRate;
    }

    /**
     * Set invoiceTemplate
     *
     * @param InvoiceTemplateInterface | null
     *
     * @return static
     */
    protected function setInvoiceTemplate(?InvoiceTemplateInterface $invoiceTemplate = null): InvoiceSchedulerInterface
    {
        $this->invoiceTemplate = $invoiceTemplate;

        return $this;
    }

    /**
     * Get invoiceTemplate
     *
     * @return InvoiceTemplateInterface | null
     */
    public function getInvoiceTemplate(): ?InvoiceTemplateInterface
    {
        return $this->invoiceTemplate;
    }

    /**
     * Set brand
     *
     * @param BrandInterface
     *
     * @return static
     */
    protected function setBrand(BrandInterface $brand): InvoiceSchedulerInterface
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface
    {
        return $this->brand;
    }

    /**
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    protected function setCompany(CompanyInterface $company): InvoiceSchedulerInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

    /**
     * Set numberSequence
     *
     * @param InvoiceNumberSequenceInterface | null
     *
     * @return static
     */
    protected function setNumberSequence(?InvoiceNumberSequenceInterface $numberSequence = null): InvoiceSchedulerInterface
    {
        $this->numberSequence = $numberSequence;

        return $this;
    }

    /**
     * Get numberSequence
     *
     * @return InvoiceNumberSequenceInterface | null
     */
    public function getNumberSequence(): ?InvoiceNumberSequenceInterface
    {
        return $this->numberSequence;
    }

}
