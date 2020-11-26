<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\MusicOnHold;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\MusicOnHold\EncodedFile;
use Ivoz\Provider\Domain\Model\MusicOnHold\OriginalFile;
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

    /**
     * @var string
     */
    protected $name;

    /**
     * comment: enum:pending|encoding|ready|error
     * @var string | null
     */
    protected $status;

    /**
     * @var EncodedFile | null
     */
    protected $encodedFile;

    /**
     * @var OriginalFile | null
     */
    protected $originalFile;

    /**
     * @var BrandInterface
     * inversedBy musicsOnHold
     */
    protected $brand;

    /**
     * @var CompanyInterface
     * inversedBy musicsOnHold
     */
    protected $company;

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        EncodedFile $encodedFile,
        OriginalFile $originalFile
    ) {
        $this->setName($name);
        $this->setEncodedFile($encodedFile);
        $this->setOriginalFile($originalFile);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "MusicOnHold",
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
     * @return MusicOnHoldDto
     */
    public static function createDto($id = null)
    {
        return new MusicOnHoldDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param MusicOnHoldInterface|null $entity
     * @param int $depth
     * @return MusicOnHoldDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var MusicOnHoldDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param MusicOnHoldDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, MusicOnHoldDto::class);

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
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param MusicOnHoldDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, MusicOnHoldDto::class);

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
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return MusicOnHoldDto
     */
    public function toDto($depth = 0)
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
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
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
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null
        ];
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName(string $name): MusicOnHoldInterface
    {
        Assertion::maxLength($name, 50, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * Set status
     *
     * @param string $status | null
     *
     * @return static
     */
    protected function setStatus(?string $status = null): MusicOnHoldInterface
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
     * Get encodedFile
     *
     * @return EncodedFile
     */
    public function getEncodedFile(): EncodedFile
    {
        return $this->encodedFile;
    }

    /**
     * Set encodedFile
     *
     * @return static
     */
    protected function setEncodedFile(EncodedFile $encodedFile): MusicOnHoldInterface
    {
        $isEqual = $this->encodedFile && $this->encodedFile->equals($encodedFile);
        if ($isEqual) {
            return $this;
        }

        $this->encodedFile = $encodedFile;
        return $this;
    }

    /**
     * Get originalFile
     *
     * @return OriginalFile
     */
    public function getOriginalFile(): OriginalFile
    {
        return $this->originalFile;
    }

    /**
     * Set originalFile
     *
     * @return static
     */
    protected function setOriginalFile(OriginalFile $originalFile): MusicOnHoldInterface
    {
        $isEqual = $this->originalFile && $this->originalFile->equals($originalFile);
        if ($isEqual) {
            return $this;
        }

        $this->originalFile = $originalFile;
        return $this;
    }

    /**
     * Set brand
     *
     * @param BrandInterface | null
     *
     * @return static
     */
    public function setBrand(?BrandInterface $brand = null): MusicOnHoldInterface
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
     * Set company
     *
     * @param CompanyInterface | null
     *
     * @return static
     */
    public function setCompany(?CompanyInterface $company = null): MusicOnHoldInterface
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

}
