<?php

namespace Ivoz\Provider\Domain\Model\CallCsvReport;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * CallCsvReportAbstract
 * @codeCoverageIgnore
 */
abstract class CallCsvReportAbstract
{
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
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface
     */
    protected $callCsvScheduler;


    use ChangelogTrait;

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
     * @param EntityInterface|null $entity
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto CallCsvReportDto
         */
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
            ->setCallCsvScheduler($fkTransformer->transform($dto->getCallCsvScheduler()))
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto CallCsvReportDto
         */
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



        $this->sanitizeValues();
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
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth))
            ->setCallCsvScheduler(\Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvScheduler::entityToDto(self::getCallCsvScheduler(), $depth));
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
    // @codeCoverageIgnoreStart

    /**
     * Set sentTo
     *
     * @param string $sentTo
     *
     * @return self
     */
    protected function setSentTo($sentTo)
    {
        Assertion::notNull($sentTo, 'sentTo value "%s" is null, but non null value was expected.');
        Assertion::maxLength($sentTo, 250, 'sentTo value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->sentTo = $sentTo;

        return $this;
    }

    /**
     * Get sentTo
     *
     * @return string
     */
    public function getSentTo()
    {
        return $this->sentTo;
    }

    /**
     * Set inDate
     *
     * @param \DateTime $inDate
     *
     * @return self
     */
    protected function setInDate($inDate)
    {
        Assertion::notNull($inDate, 'inDate value "%s" is null, but non null value was expected.');
        $inDate = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $inDate,
            null
        );

        $this->inDate = $inDate;

        return $this;
    }

    /**
     * Get inDate
     *
     * @return \DateTime
     */
    public function getInDate()
    {
        return clone $this->inDate;
    }

    /**
     * Set outDate
     *
     * @param \DateTime $outDate
     *
     * @return self
     */
    protected function setOutDate($outDate)
    {
        Assertion::notNull($outDate, 'outDate value "%s" is null, but non null value was expected.');
        $outDate = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $outDate,
            null
        );

        $this->outDate = $outDate;

        return $this;
    }

    /**
     * Get outDate
     *
     * @return \DateTime
     */
    public function getOutDate()
    {
        return clone $this->outDate;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return self
     */
    protected function setCreatedOn($createdOn)
    {
        Assertion::notNull($createdOn, 'createdOn value "%s" is null, but non null value was expected.');
        $createdOn = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $createdOn,
            null
        );

        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return clone $this->createdOn;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set callCsvScheduler
     *
     * @param \Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface $callCsvScheduler
     *
     * @return self
     */
    public function setCallCsvScheduler(\Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface $callCsvScheduler = null)
    {
        $this->callCsvScheduler = $callCsvScheduler;

        return $this;
    }

    /**
     * Get callCsvScheduler
     *
     * @return \Ivoz\Provider\Domain\Model\CallCsvScheduler\CallCsvSchedulerInterface | null
     */
    public function getCallCsvScheduler()
    {
        return $this->callCsvScheduler;
    }

    /**
     * Set csv
     *
     * @param \Ivoz\Provider\Domain\Model\CallCsvReport\Csv $csv
     *
     * @return self
     */
    public function setCsv(Csv $csv)
    {
        $this->csv = $csv;
        return $this;
    }

    /**
     * Get csv
     *
     * @return \Ivoz\Provider\Domain\Model\CallCsvReport\Csv
     */
    public function getCsv()
    {
        return $this->csv;
    }
    // @codeCoverageIgnoreEnd
}
