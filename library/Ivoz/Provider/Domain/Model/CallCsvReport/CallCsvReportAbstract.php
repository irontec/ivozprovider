<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\CallCsvReport;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\CallCsvReport\Csv;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvScheduler;

/**
* CallCsvReportAbstract
* @codeCoverageIgnore
*/
abstract class CallCsvReportAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $sentTo = '';

    /**
     * @var \DateTime
     */
    protected $inDate;

    /**
     * @var \DateTime
     */
    protected $outDate;

    /**
     * @var \DateTime
     */
    protected $createdOn;

    /**
     * @var Csv
     */
    protected $csv;

    /**
     * @var ?CompanyInterface
     */
    protected $company = null;

    /**
     * @var ?BrandInterface
     */
    protected $brand = null;

    /**
     * @var ?CallCsvSchedulerInterface
     */
    protected $callCsvScheduler = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $sentTo,
        \DateTimeInterface|string $inDate,
        \DateTimeInterface|string $outDate,
        \DateTimeInterface|string $createdOn,
        Csv $csv
    ) {
        $this->setSentTo($sentTo);
        $this->setInDate($inDate);
        $this->setOutDate($outDate);
        $this->setCreatedOn($createdOn);
        $this->csv = $csv;
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "CallCsvReport",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): CallCsvReportDto
    {
        return new CallCsvReportDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|CallCsvReportInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CallCsvReportDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CallCsvReportInterface::class);

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
     * @param CallCsvReportDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CallCsvReportDto::class);
        $sentTo = $dto->getSentTo();
        Assertion::notNull($sentTo, 'getSentTo value is null, but non null value was expected.');
        $inDate = $dto->getInDate();
        Assertion::notNull($inDate, 'getInDate value is null, but non null value was expected.');
        $outDate = $dto->getOutDate();
        Assertion::notNull($outDate, 'getOutDate value is null, but non null value was expected.');
        $createdOn = $dto->getCreatedOn();
        Assertion::notNull($createdOn, 'getCreatedOn value is null, but non null value was expected.');

        $csv = new Csv(
            $dto->getCsvFileSize(),
            $dto->getCsvMimeType(),
            $dto->getCsvBaseName()
        );

        $self = new static(
            $sentTo,
            $inDate,
            $outDate,
            $createdOn,
            $csv
        );

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCallCsvScheduler($fkTransformer->transform($dto->getCallCsvScheduler()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CallCsvReportDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CallCsvReportDto::class);

        $sentTo = $dto->getSentTo();
        Assertion::notNull($sentTo, 'getSentTo value is null, but non null value was expected.');
        $inDate = $dto->getInDate();
        Assertion::notNull($inDate, 'getInDate value is null, but non null value was expected.');
        $outDate = $dto->getOutDate();
        Assertion::notNull($outDate, 'getOutDate value is null, but non null value was expected.');
        $createdOn = $dto->getCreatedOn();
        Assertion::notNull($createdOn, 'getCreatedOn value is null, but non null value was expected.');

        $csv = new Csv(
            $dto->getCsvFileSize(),
            $dto->getCsvMimeType(),
            $dto->getCsvBaseName()
        );

        $this
            ->setSentTo($sentTo)
            ->setInDate($inDate)
            ->setOutDate($outDate)
            ->setCreatedOn($createdOn)
            ->setCsv($csv)
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCallCsvScheduler($fkTransformer->transform($dto->getCallCsvScheduler()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CallCsvReportDto
    {
        return self::createDto()
            ->setSentTo(self::getSentTo())
            ->setInDate(self::getInDate())
            ->setOutDate(self::getOutDate())
            ->setCreatedOn(self::getCreatedOn())
            ->setCsvFileSize(self::getCsv()->getFileSize())
            ->setCsvMimeType(self::getCsv()->getMimeType())
            ->setCsvBaseName(self::getCsv()->getBaseName())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCallCsvScheduler(CallCsvScheduler::entityToDto(self::getCallCsvScheduler(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'sentTo' => self::getSentTo(),
            'inDate' => self::getInDate(),
            'outDate' => self::getOutDate(),
            'createdOn' => self::getCreatedOn(),
            'csvFileSize' => self::getCsv()->getFileSize(),
            'csvMimeType' => self::getCsv()->getMimeType(),
            'csvBaseName' => self::getCsv()->getBaseName(),
            'companyId' => self::getCompany()?->getId(),
            'brandId' => self::getBrand()?->getId(),
            'callCsvSchedulerId' => self::getCallCsvScheduler()?->getId()
        ];
    }

    protected function setSentTo(string $sentTo): static
    {
        Assertion::maxLength($sentTo, 250, 'sentTo value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->sentTo = $sentTo;

        return $this;
    }

    public function getSentTo(): string
    {
        return $this->sentTo;
    }

    protected function setInDate(string|\DateTimeInterface $inDate): static
    {

        /** @var \Datetime */
        $inDate = DateTimeHelper::createOrFix(
            $inDate,
            null
        );

        if ($this->isInitialized() && $this->inDate == $inDate) {
            return $this;
        }

        $this->inDate = $inDate;

        return $this;
    }

    public function getInDate(): \DateTime
    {
        return clone $this->inDate;
    }

    protected function setOutDate(string|\DateTimeInterface $outDate): static
    {

        /** @var \Datetime */
        $outDate = DateTimeHelper::createOrFix(
            $outDate,
            null
        );

        if ($this->isInitialized() && $this->outDate == $outDate) {
            return $this;
        }

        $this->outDate = $outDate;

        return $this;
    }

    public function getOutDate(): \DateTime
    {
        return clone $this->outDate;
    }

    protected function setCreatedOn(string|\DateTimeInterface $createdOn): static
    {

        /** @var \Datetime */
        $createdOn = DateTimeHelper::createOrFix(
            $createdOn,
            null
        );

        if ($this->isInitialized() && $this->createdOn == $createdOn) {
            return $this;
        }

        $this->createdOn = $createdOn;

        return $this;
    }

    public function getCreatedOn(): \DateTime
    {
        return clone $this->createdOn;
    }

    public function getCsv(): Csv
    {
        return $this->csv;
    }

    protected function setCsv(Csv $csv): static
    {
        $isEqual = $this->csv->equals($csv);
        if ($isEqual) {
            return $this;
        }

        $this->csv = $csv;
        return $this;
    }

    protected function setCompany(?CompanyInterface $company = null): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    protected function setBrand(?BrandInterface $brand = null): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }

    protected function setCallCsvScheduler(?CallCsvSchedulerInterface $callCsvScheduler = null): static
    {
        $this->callCsvScheduler = $callCsvScheduler;

        return $this;
    }

    public function getCallCsvScheduler(): ?CallCsvSchedulerInterface
    {
        return $this->callCsvScheduler;
    }
}
