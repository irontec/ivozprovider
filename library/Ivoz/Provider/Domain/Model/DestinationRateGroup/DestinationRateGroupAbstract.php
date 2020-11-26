<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\Name;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\Description;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\File;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Currency\Currency;

/**
* DestinationRateGroupAbstract
* @codeCoverageIgnore
*/
abstract class DestinationRateGroupAbstract
{
    use ChangelogTrait;

    /**
     * comment: enum:waiting|inProgress|imported|error
     * @var string | null
     */
    protected $status;

    /**
     * @var string | null
     */
    protected $lastExecutionError;

    /**
     * @var bool
     */
    protected $deductibleConnectionFee = false;

    /**
     * @var Name | null
     */
    protected $name;

    /**
     * @var Description | null
     */
    protected $description;

    /**
     * @var File | null
     */
    protected $file;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var CurrencyInterface
     */
    protected $currency;

    /**
     * Constructor
     */
    protected function __construct(
        $deductibleConnectionFee,
        Name $name,
        Description $description,
        File $file
    ) {
        $this->setDeductibleConnectionFee($deductibleConnectionFee);
        $this->setName($name);
        $this->setDescription($description);
        $this->setFile($file);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "DestinationRateGroup",
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
     * @return DestinationRateGroupDto
     */
    public static function createDto($id = null)
    {
        return new DestinationRateGroupDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param DestinationRateGroupInterface|null $entity
     * @param int $depth
     * @return DestinationRateGroupDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, DestinationRateGroupInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var DestinationRateGroupDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DestinationRateGroupDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, DestinationRateGroupDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $description = new Description(
            $dto->getDescriptionEn(),
            $dto->getDescriptionEs(),
            $dto->getDescriptionCa(),
            $dto->getDescriptionIt()
        );

        $file = new File(
            $dto->getFileFileSize(),
            $dto->getFileMimeType(),
            $dto->getFileBaseName(),
            $dto->getFileImporterArguments()
        );

        $self = new static(
            $dto->getDeductibleConnectionFee(),
            $name,
            $description,
            $file
        );

        $self
            ->setStatus($dto->getStatus())
            ->setLastExecutionError($dto->getLastExecutionError())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCurrency($fkTransformer->transform($dto->getCurrency()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DestinationRateGroupDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, DestinationRateGroupDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $description = new Description(
            $dto->getDescriptionEn(),
            $dto->getDescriptionEs(),
            $dto->getDescriptionCa(),
            $dto->getDescriptionIt()
        );

        $file = new File(
            $dto->getFileFileSize(),
            $dto->getFileMimeType(),
            $dto->getFileBaseName(),
            $dto->getFileImporterArguments()
        );

        $this
            ->setStatus($dto->getStatus())
            ->setLastExecutionError($dto->getLastExecutionError())
            ->setDeductibleConnectionFee($dto->getDeductibleConnectionFee())
            ->setName($name)
            ->setDescription($description)
            ->setFile($file)
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCurrency($fkTransformer->transform($dto->getCurrency()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return DestinationRateGroupDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setStatus(self::getStatus())
            ->setLastExecutionError(self::getLastExecutionError())
            ->setDeductibleConnectionFee(self::getDeductibleConnectionFee())
            ->setNameEn(self::getName()->getEn())
            ->setNameEs(self::getName()->getEs())
            ->setNameCa(self::getName()->getCa())
            ->setNameIt(self::getName()->getIt())
            ->setDescriptionEn(self::getDescription()->getEn())
            ->setDescriptionEs(self::getDescription()->getEs())
            ->setDescriptionCa(self::getDescription()->getCa())
            ->setDescriptionIt(self::getDescription()->getIt())
            ->setFileFileSize(self::getFile()->getFileSize())
            ->setFileMimeType(self::getFile()->getMimeType())
            ->setFileBaseName(self::getFile()->getBaseName())
            ->setFileImporterArguments(self::getFile()->getImporterArguments())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCurrency(Currency::entityToDto(self::getCurrency(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'status' => self::getStatus(),
            'lastExecutionError' => self::getLastExecutionError(),
            'deductibleConnectionFee' => self::getDeductibleConnectionFee(),
            'nameEn' => self::getName()->getEn(),
            'nameEs' => self::getName()->getEs(),
            'nameCa' => self::getName()->getCa(),
            'nameIt' => self::getName()->getIt(),
            'descriptionEn' => self::getDescription()->getEn(),
            'descriptionEs' => self::getDescription()->getEs(),
            'descriptionCa' => self::getDescription()->getCa(),
            'descriptionIt' => self::getDescription()->getIt(),
            'fileFileSize' => self::getFile()->getFileSize(),
            'fileMimeType' => self::getFile()->getMimeType(),
            'fileBaseName' => self::getFile()->getBaseName(),
            'fileImporterArguments' => self::getFile()->getImporterArguments(),
            'brandId' => self::getBrand()->getId(),
            'currencyId' => self::getCurrency() ? self::getCurrency()->getId() : null
        ];
    }

    /**
     * Set status
     *
     * @param string $status | null
     *
     * @return static
     */
    protected function setStatus(?string $status = null): DestinationRateGroupInterface
    {
        if (!is_null($status)) {
            Assertion::maxLength($status, 20, 'status value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $status,
                [
                    DestinationRateGroupInterface::STATUS_WAITING,
                    DestinationRateGroupInterface::STATUS_INPROGRESS,
                    DestinationRateGroupInterface::STATUS_IMPORTED,
                    DestinationRateGroupInterface::STATUS_ERROR,
                ],
                'statusvalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string | null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Set lastExecutionError
     *
     * @param string $lastExecutionError | null
     *
     * @return static
     */
    protected function setLastExecutionError(?string $lastExecutionError = null): DestinationRateGroupInterface
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
     * Set deductibleConnectionFee
     *
     * @param bool $deductibleConnectionFee
     *
     * @return static
     */
    protected function setDeductibleConnectionFee(bool $deductibleConnectionFee): DestinationRateGroupInterface
    {
        Assertion::between(intval($deductibleConnectionFee), 0, 1, 'deductibleConnectionFee provided "%s" is not a valid boolean value.');
        $deductibleConnectionFee = (bool) $deductibleConnectionFee;

        $this->deductibleConnectionFee = $deductibleConnectionFee;

        return $this;
    }

    /**
     * Get deductibleConnectionFee
     *
     * @return bool
     */
    public function getDeductibleConnectionFee(): bool
    {
        return $this->deductibleConnectionFee;
    }

    /**
     * Get name
     *
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @return static
     */
    protected function setName(Name $name): DestinationRateGroupInterface
    {
        $isEqual = $this->name && $this->name->equals($name);
        if ($isEqual) {
            return $this;
        }

        $this->name = $name;
        return $this;
    }

    /**
     * Get description
     *
     * @return Description
     */
    public function getDescription(): Description
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @return static
     */
    protected function setDescription(Description $description): DestinationRateGroupInterface
    {
        $isEqual = $this->description && $this->description->equals($description);
        if ($isEqual) {
            return $this;
        }

        $this->description = $description;
        return $this;
    }

    /**
     * Get file
     *
     * @return File
     */
    public function getFile(): File
    {
        return $this->file;
    }

    /**
     * Set file
     *
     * @return static
     */
    protected function setFile(File $file): DestinationRateGroupInterface
    {
        $isEqual = $this->file && $this->file->equals($file);
        if ($isEqual) {
            return $this;
        }

        $this->file = $file;
        return $this;
    }

    /**
     * Set brand
     *
     * @param BrandInterface
     *
     * @return static
     */
    protected function setBrand(BrandInterface $brand): DestinationRateGroupInterface
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
     * Set currency
     *
     * @param CurrencyInterface | null
     *
     * @return static
     */
    protected function setCurrency(?CurrencyInterface $currency = null): DestinationRateGroupInterface
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return CurrencyInterface | null
     */
    public function getCurrency(): ?CurrencyInterface
    {
        return $this->currency;
    }

}
