<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\MusicOnHold;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\MusicOnHold\OriginalFile;
use Ivoz\Provider\Domain\Model\MusicOnHold\EncodedFile;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Company\Company;

/**
* MusicOnHoldAbstract
* @codeCoverageIgnore
*/
abstract class MusicOnHoldAbstract
{
    use ChangelogTrait;

    protected $name;

    /**
     * comment: enum:pending|encoding|ready|error
     */
    protected $status;

    /**
     * @var OriginalFile | null
     */
    protected $originalFile;

    /**
     * @var EncodedFile | null
     */
    protected $encodedFile;

    /**
     * @var BrandInterface | null
     * inversedBy musicsOnHold
     */
    protected $brand;

    /**
     * @var CompanyInterface | null
     * inversedBy musicsOnHold
     */
    protected $company;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        OriginalFile $originalFile,
        EncodedFile $encodedFile
    ) {
        $this->setName($name);
        $this->setOriginalFile($originalFile);
        $this->setEncodedFile($encodedFile);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "MusicOnHold",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): MusicOnHoldDto
    {
        return new MusicOnHoldDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|MusicOnHoldInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?MusicOnHoldDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, MusicOnHoldInterface::class);

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
     * @param MusicOnHoldDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, MusicOnHoldDto::class);

        $originalFile = new OriginalFile(
            $dto->getOriginalFileFileSize(),
            $dto->getOriginalFileMimeType(),
            $dto->getOriginalFileBaseName()
        );

        $encodedFile = new EncodedFile(
            $dto->getEncodedFileFileSize(),
            $dto->getEncodedFileMimeType(),
            $dto->getEncodedFileBaseName()
        );

        $self = new static(
            $dto->getName(),
            $originalFile,
            $encodedFile
        );

        $self
            ->setStatus($dto->getStatus())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param MusicOnHoldDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, MusicOnHoldDto::class);

        $originalFile = new OriginalFile(
            $dto->getOriginalFileFileSize(),
            $dto->getOriginalFileMimeType(),
            $dto->getOriginalFileBaseName()
        );

        $encodedFile = new EncodedFile(
            $dto->getEncodedFileFileSize(),
            $dto->getEncodedFileMimeType(),
            $dto->getEncodedFileBaseName()
        );

        $this
            ->setName($dto->getName())
            ->setStatus($dto->getStatus())
            ->setOriginalFile($originalFile)
            ->setEncodedFile($encodedFile)
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): MusicOnHoldDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setStatus(self::getStatus())
            ->setOriginalFileFileSize(self::getOriginalFile()->getFileSize())
            ->setOriginalFileMimeType(self::getOriginalFile()->getMimeType())
            ->setOriginalFileBaseName(self::getOriginalFile()->getBaseName())
            ->setEncodedFileFileSize(self::getEncodedFile()->getFileSize())
            ->setEncodedFileMimeType(self::getEncodedFile()->getMimeType())
            ->setEncodedFileBaseName(self::getEncodedFile()->getBaseName())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'status' => self::getStatus(),
            'originalFileFileSize' => self::getOriginalFile()->getFileSize(),
            'originalFileMimeType' => self::getOriginalFile()->getMimeType(),
            'originalFileBaseName' => self::getOriginalFile()->getBaseName(),
            'encodedFileFileSize' => self::getEncodedFile()->getFileSize(),
            'encodedFileMimeType' => self::getEncodedFile()->getMimeType(),
            'encodedFileBaseName' => self::getEncodedFile()->getBaseName(),
            'brandId' => self::getBrand()?->getId(),
            'companyId' => self::getCompany()?->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 50, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setStatus(?string $status = null): static
    {
        if (!is_null($status)) {
            Assertion::maxLength($status, 20, 'status value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $status,
                [
                    MusicOnHoldInterface::STATUS_PENDING,
                    MusicOnHoldInterface::STATUS_ENCODING,
                    MusicOnHoldInterface::STATUS_READY,
                    MusicOnHoldInterface::STATUS_ERROR,
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

    public function getOriginalFile(): OriginalFile
    {
        return $this->originalFile;
    }

    protected function setOriginalFile(OriginalFile $originalFile): static
    {
        $isEqual = $this->originalFile && $this->originalFile->equals($originalFile);
        if ($isEqual) {
            return $this;
        }

        $this->originalFile = $originalFile;
        return $this;
    }

    public function getEncodedFile(): EncodedFile
    {
        return $this->encodedFile;
    }

    protected function setEncodedFile(EncodedFile $encodedFile): static
    {
        $isEqual = $this->encodedFile && $this->encodedFile->equals($encodedFile);
        if ($isEqual) {
            return $this;
        }

        $this->encodedFile = $encodedFile;
        return $this;
    }

    public function setBrand(?BrandInterface $brand = null): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }

    public function setCompany(?CompanyInterface $company = null): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }
}
