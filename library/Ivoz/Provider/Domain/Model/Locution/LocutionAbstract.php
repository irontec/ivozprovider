<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Locution;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Locution\EncodedFile;
use Ivoz\Provider\Domain\Model\Locution\OriginalFile;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\Company;

/**
* LocutionAbstract
* @codeCoverageIgnore
*/
abstract class LocutionAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var ?string
     * comment: enum:pending|encoding|ready|error
     */
    protected $status = null;

    /**
     * @var EncodedFile
     */
    protected $encodedFile;

    /**
     * @var OriginalFile
     */
    protected $originalFile;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        EncodedFile $encodedFile,
        OriginalFile $originalFile
    ) {
        $this->setName($name);
        $this->encodedFile = $encodedFile;
        $this->originalFile = $originalFile;
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Locution",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): LocutionDto
    {
        return new LocutionDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|LocutionInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?LocutionDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, LocutionInterface::class);

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
     * @param LocutionDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, LocutionDto::class);

        $encodedFile = new EncodedFile(
            $dto->getEncodedFileFileSize(),
            $dto->getEncodedFileMimeType(),
            $dto->getEncodedFileBaseName()
        );

        $originalFile = new OriginalFile(
            $dto->getOriginalFileFileSize(),
            $dto->getOriginalFileMimeType(),
            $dto->getOriginalFileBaseName()
        );

        $self = new static(
            $dto->getName(),
            $encodedFile,
            $originalFile
        );

        $self
            ->setStatus($dto->getStatus())
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param LocutionDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, LocutionDto::class);

        $encodedFile = new EncodedFile(
            $dto->getEncodedFileFileSize(),
            $dto->getEncodedFileMimeType(),
            $dto->getEncodedFileBaseName()
        );

        $originalFile = new OriginalFile(
            $dto->getOriginalFileFileSize(),
            $dto->getOriginalFileMimeType(),
            $dto->getOriginalFileBaseName()
        );

        $this
            ->setName($dto->getName())
            ->setStatus($dto->getStatus())
            ->setEncodedFile($encodedFile)
            ->setOriginalFile($originalFile)
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): LocutionDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setStatus(self::getStatus())
            ->setEncodedFileFileSize(self::getEncodedFile()->getFileSize())
            ->setEncodedFileMimeType(self::getEncodedFile()->getMimeType())
            ->setEncodedFileBaseName(self::getEncodedFile()->getBaseName())
            ->setOriginalFileFileSize(self::getOriginalFile()->getFileSize())
            ->setOriginalFileMimeType(self::getOriginalFile()->getMimeType())
            ->setOriginalFileBaseName(self::getOriginalFile()->getBaseName())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'status' => self::getStatus(),
            'encodedFileFileSize' => self::getEncodedFile()->getFileSize(),
            'encodedFileMimeType' => self::getEncodedFile()->getMimeType(),
            'encodedFileBaseName' => self::getEncodedFile()->getBaseName(),
            'originalFileFileSize' => self::getOriginalFile()->getFileSize(),
            'originalFileMimeType' => self::getOriginalFile()->getMimeType(),
            'originalFileBaseName' => self::getOriginalFile()->getBaseName(),
            'companyId' => self::getCompany()->getId()
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
                    LocutionInterface::STATUS_PENDING,
                    LocutionInterface::STATUS_ENCODING,
                    LocutionInterface::STATUS_READY,
                    LocutionInterface::STATUS_ERROR,
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

    public function getEncodedFile(): EncodedFile
    {
        return $this->encodedFile;
    }

    protected function setEncodedFile(EncodedFile $encodedFile): static
    {
        $isEqual = $this->encodedFile->equals($encodedFile);
        if ($isEqual) {
            return $this;
        }

        $this->encodedFile = $encodedFile;
        return $this;
    }

    public function getOriginalFile(): OriginalFile
    {
        return $this->originalFile;
    }

    protected function setOriginalFile(OriginalFile $originalFile): static
    {
        $isEqual = $this->originalFile->equals($originalFile);
        if ($isEqual) {
            return $this;
        }

        $this->originalFile = $originalFile;
        return $this;
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
}
