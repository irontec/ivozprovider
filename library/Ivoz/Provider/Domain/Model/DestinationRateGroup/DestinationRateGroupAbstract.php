<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var ?string
     * comment: enum:waiting|inProgress|imported|error
     */
    protected $status = null;

    /**
     * @var ?string
     */
    protected $lastExecutionError = null;

    /**
     * @var bool
     */
    protected $deductibleConnectionFee = false;

    /**
     * @var Name
     */
    protected $name;

    /**
     * @var Description
     */
    protected $description;

    /**
     * @var File
     */
    protected $file;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var ?CurrencyInterface
     */
    protected $currency = null;

    /**
     * Constructor
     */
    protected function __construct(
        bool $deductibleConnectionFee,
        Name $name,
        Description $description,
        File $file
    ) {
        $this->setDeductibleConnectionFee($deductibleConnectionFee);
        $this->name = $name;
        $this->description = $description;
        $this->file = $file;
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "DestinationRateGroup",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): DestinationRateGroupDto
    {
        return new DestinationRateGroupDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|DestinationRateGroupInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?DestinationRateGroupDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DestinationRateGroupDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, DestinationRateGroupDto::class);
        Assertion::notNull($dto->getNameEn(), 'nameEn value is null, but non null value was expected.');
        Assertion::notNull($dto->getNameEs(), 'nameEs value is null, but non null value was expected.');
        Assertion::notNull($dto->getNameCa(), 'nameCa value is null, but non null value was expected.');
        Assertion::notNull($dto->getNameIt(), 'nameIt value is null, but non null value was expected.');
        Assertion::notNull($dto->getDescriptionEn(), 'descriptionEn value is null, but non null value was expected.');
        Assertion::notNull($dto->getDescriptionEs(), 'descriptionEs value is null, but non null value was expected.');
        Assertion::notNull($dto->getDescriptionCa(), 'descriptionCa value is null, but non null value was expected.');
        Assertion::notNull($dto->getDescriptionIt(), 'descriptionIt value is null, but non null value was expected.');
        $deductibleConnectionFee = $dto->getDeductibleConnectionFee();
        Assertion::notNull($deductibleConnectionFee, 'getDeductibleConnectionFee value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

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
            $deductibleConnectionFee,
            $name,
            $description,
            $file
        );

        $self
            ->setStatus($dto->getStatus())
            ->setLastExecutionError($dto->getLastExecutionError())
            ->setBrand($fkTransformer->transform($brand))
            ->setCurrency($fkTransformer->transform($dto->getCurrency()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DestinationRateGroupDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, DestinationRateGroupDto::class);

        Assertion::notNull($dto->getNameEn(), 'nameEn value is null, but non null value was expected.');
        Assertion::notNull($dto->getNameEs(), 'nameEs value is null, but non null value was expected.');
        Assertion::notNull($dto->getNameCa(), 'nameCa value is null, but non null value was expected.');
        Assertion::notNull($dto->getNameIt(), 'nameIt value is null, but non null value was expected.');
        Assertion::notNull($dto->getDescriptionEn(), 'descriptionEn value is null, but non null value was expected.');
        Assertion::notNull($dto->getDescriptionEs(), 'descriptionEs value is null, but non null value was expected.');
        Assertion::notNull($dto->getDescriptionCa(), 'descriptionCa value is null, but non null value was expected.');
        Assertion::notNull($dto->getDescriptionIt(), 'descriptionIt value is null, but non null value was expected.');
        $deductibleConnectionFee = $dto->getDeductibleConnectionFee();
        Assertion::notNull($deductibleConnectionFee, 'getDeductibleConnectionFee value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

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
            ->setDeductibleConnectionFee($deductibleConnectionFee)
            ->setName($name)
            ->setDescription($description)
            ->setFile($file)
            ->setBrand($fkTransformer->transform($brand))
            ->setCurrency($fkTransformer->transform($dto->getCurrency()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DestinationRateGroupDto
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
     * @return array<string, mixed>
     */
    protected function __toArray(): array
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
            'currencyId' => self::getCurrency()?->getId()
        ];
    }

    protected function setStatus(?string $status = null): static
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

    public function getStatus(): ?string
    {
        return $this->status;
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

    protected function setDeductibleConnectionFee(bool $deductibleConnectionFee): static
    {
        $this->deductibleConnectionFee = $deductibleConnectionFee;

        return $this;
    }

    public function getDeductibleConnectionFee(): bool
    {
        return $this->deductibleConnectionFee;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    protected function setName(Name $name): static
    {
        $isEqual = $this->name->equals($name);
        if ($isEqual) {
            return $this;
        }

        $this->name = $name;
        return $this;
    }

    public function getDescription(): Description
    {
        return $this->description;
    }

    protected function setDescription(Description $description): static
    {
        $isEqual = $this->description->equals($description);
        if ($isEqual) {
            return $this;
        }

        $this->description = $description;
        return $this;
    }

    public function getFile(): File
    {
        return $this->file;
    }

    protected function setFile(File $file): static
    {
        $isEqual = $this->file->equals($file);
        if ($isEqual) {
            return $this;
        }

        $this->file = $file;
        return $this;
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

    protected function setCurrency(?CurrencyInterface $currency = null): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCurrency(): ?CurrencyInterface
    {
        return $this->currency;
    }
}
