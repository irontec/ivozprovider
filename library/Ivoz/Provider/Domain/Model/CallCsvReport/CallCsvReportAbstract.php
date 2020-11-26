<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\CallCsvReport;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var \DateTimeInterface
     */
    protected $inDate;

    /**
     * @var \DateTimeInterface
     */
    protected $outDate;

    /**
     * @var \DateTimeInterface
     */
    protected $createdOn;

    /**
     * @var Csv | null
     */
    protected $csv;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var CallCsvSchedulerInterface
     */
    protected $callCsvScheduler;

    /**
     * Constructor
     */
    protected function __construct(
        $sentTo,
        $inDate,
        $outDate,
        $createdOn,
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
     * @param null $id
     * @return CallCsvReportDto
     */
    public static function createDto($id = null)
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
        $dto = $entity->toDto($depth-1);

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
     * @return CallCsvReportDto
     */
    public function toDto($depth = 0)
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

    /**
     * Set sentTo
     *
     * @param string $sentTo
     *
     * @return static
     */
    protected function setSentTo(string $sentTo): CallCsvReportInterface
    {
        Assertion::maxLength($sentTo, 250, 'sentTo value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->sentTo = $sentTo;

        return $this;
    }

    /**
     * Get sentTo
     *
     * @return string
     */
    public function getSentTo(): string
    {
        return $this->sentTo;
    }

    /**
     * Set inDate
     *
     * @param \DateTimeInterface $inDate
     *
     * @return static
     */
    protected function setInDate($inDate): CallCsvReportInterface
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
     * Get inDate
     *
     * @return \DateTimeInterface
     */
    public function getInDate(): \DateTimeInterface
    {
        return clone $this->inDate;
    }

    /**
     * Set outDate
     *
     * @param \DateTimeInterface $outDate
     *
     * @return static
     */
    protected function setOutDate($outDate): CallCsvReportInterface
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
     * Get outDate
     *
     * @return \DateTimeInterface
     */
    public function getOutDate(): \DateTimeInterface
    {
        return clone $this->outDate;
    }

    /**
     * Set createdOn
     *
     * @param \DateTimeInterface $createdOn
     *
     * @return static
     */
    protected function setCreatedOn($createdOn): CallCsvReportInterface
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
     * Get createdOn
     *
     * @return \DateTimeInterface
     */
    public function getCreatedOn(): \DateTimeInterface
    {
        return clone $this->createdOn;
    }

    /**
     * Get csv
     *
     * @return Csv
     */
    public function getCsv(): Csv
    {
        return $this->csv;
    }

    /**
     * Set csv
     *
     * @return static
     */
    protected function setCsv(Csv $csv): CallCsvReportInterface
    {
        $isEqual = $this->csv && $this->csv->equals($csv);
        if ($isEqual) {
            return $this;
        }

        $this->csv = $csv;
        return $this;
    }

    /**
     * Set company
     *
     * @param CompanyInterface | null
     *
     * @return static
     */
    protected function setCompany(?CompanyInterface $company = null): CallCsvReportInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    /**
     * Set brand
     *
     * @param BrandInterface | null
     *
     * @return static
     */
    protected function setBrand(?BrandInterface $brand = null): CallCsvReportInterface
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }

    /**
     * Set callCsvScheduler
     *
     * @param CallCsvSchedulerInterface | null
     *
     * @return static
     */
    protected function setCallCsvScheduler(?CallCsvSchedulerInterface $callCsvScheduler = null): CallCsvReportInterface
    {
        $this->callCsvScheduler = $callCsvScheduler;

        return $this;
    }

    /**
     * Get callCsvScheduler
     *
     * @return CallCsvSchedulerInterface | null
     */
    public function getCallCsvScheduler(): ?CallCsvSchedulerInterface
    {
        return $this->callCsvScheduler;
    }

}
