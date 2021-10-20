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

    protected $sentTo = '';

    protected $inDate;

    protected $outDate;

    protected $createdOn;

    /**
     * @var Csv | null
     */
    protected $csv;

    /**
     * @var CompanyInterface | null
     */
    protected $company;

    /**
     * @var BrandInterface | null
     */
    protected $brand;

    /**
     * @var CallCsvSchedulerInterface | null
     */
    protected $callCsvScheduler;

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
        $this->setCsv($csv);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "CallCsvReport",
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
     * @param mixed $id
     */
    public static function createDto($id = null): CallCsvReportDto
    {
        return new CallCsvReportDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param CallCsvReportInterface|null $entity
     * @param int $depth
     * @return CallCsvReportDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var CallCsvReportDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CallCsvReportDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CallCsvReportDto::class);

        $csv = new Csv(
            $dto->getCsvFileSize(),
            $dto->getCsvMimeType(),
            $dto->getCsvBaseName()
        );

        $self = new static(
            $dto->getSentTo(),
            $dto->getInDate(),
            $dto->getOutDate(),
            $dto->getCreatedOn(),
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
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CallCsvReportDto::class);

        $csv = new Csv(
            $dto->getCsvFileSize(),
            $dto->getCsvMimeType(),
            $dto->getCsvBaseName()
        );

        $this
            ->setSentTo($dto->getSentTo())
            ->setInDate($dto->getInDate())
            ->setOutDate($dto->getOutDate())
            ->setCreatedOn($dto->getCreatedOn())
            ->setCsv($csv)
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCallCsvScheduler($fkTransformer->transform($dto->getCallCsvScheduler()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): CallCsvReportDto
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

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'sentTo' => self::getSentTo(),
            'inDate' => self::getInDate(),
            'outDate' => self::getOutDate(),
            'createdOn' => self::getCreatedOn(),
            'csvFileSize' => self::getCsv()->getFileSize(),
            'csvMimeType' => self::getCsv()->getMimeType(),
            'csvBaseName' => self::getCsv()->getBaseName(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'callCsvSchedulerId' => self::getCallCsvScheduler() ? self::getCallCsvScheduler()->getId() : null
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

    protected function setInDate($inDate): static
    {

        $inDate = DateTimeHelper::createOrFix(
            $inDate,
            null
        );

        if ($this->inDate == $inDate) {
            return $this;
        }

        $this->inDate = $inDate;

        return $this;
    }

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getInDate(): \DateTimeInterface
    {
        return clone $this->inDate;
    }

    protected function setOutDate($outDate): static
    {

        $outDate = DateTimeHelper::createOrFix(
            $outDate,
            null
        );

        if ($this->outDate == $outDate) {
            return $this;
        }

        $this->outDate = $outDate;

        return $this;
    }

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getOutDate(): \DateTimeInterface
    {
        return clone $this->outDate;
    }

    protected function setCreatedOn($createdOn): static
    {

        $createdOn = DateTimeHelper::createOrFix(
            $createdOn,
            null
        );

        if ($this->createdOn == $createdOn) {
            return $this;
        }

        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedOn(): \DateTimeInterface
    {
        return clone $this->createdOn;
    }

    public function getCsv(): Csv
    {
        return $this->csv;
    }

    protected function setCsv(Csv $csv): static
    {
        $isEqual = $this->csv && $this->csv->equals($csv);
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
