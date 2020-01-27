<?php

namespace Ivoz\Provider\Domain\Model\MusicOnHold;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * MusicOnHoldAbstract
 * @codeCoverageIgnore
 */
abstract class MusicOnHoldAbstract
{
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
     * @var OriginalFile
     */
    protected $originalFile;

    /**
     * @var EncodedFile
     */
    protected $encodedFile;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    protected $company;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        OriginalFile $originalFile,
        EncodedFile $encodedFile
    ) {
        $this->setName($name);
        $this->setOriginalFile($originalFile);
        $this->setEncodedFile($encodedFile);
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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setCompany($fkTransformer->transform($dto->getCompany()))
        ;

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @param int $depth
     * @return MusicOnHoldDto
     */
    public function toDto($depth = 0)
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
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
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
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName($name)
    {
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 50, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
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
    protected function setStatus($status = null)
    {
        if (!is_null($status)) {
            Assertion::maxLength($status, 20, 'status value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($status, [
                MusicOnHoldInterface::STATUS_PENDING,
                MusicOnHoldInterface::STATUS_ENCODING,
                MusicOnHoldInterface::STATUS_READY,
                MusicOnHoldInterface::STATUS_ERROR
            ], 'statusvalue "%s" is not an element of the valid values: %s');
        }

        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string | null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand | null
     *
     * @return static
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
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company | null
     *
     * @return static
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
     * Set originalFile
     *
     * @param \Ivoz\Provider\Domain\Model\MusicOnHold\OriginalFile $originalFile
     *
     * @return static
     */
    public function setOriginalFile(OriginalFile $originalFile)
    {
        $isEqual = $this->originalFile && $this->originalFile->equals($originalFile);
        if ($isEqual) {
            return $this;
        }

        $this->originalFile = $originalFile;
        return $this;
    }

    /**
     * Get originalFile
     *
     * @return \Ivoz\Provider\Domain\Model\MusicOnHold\OriginalFile
     */
    public function getOriginalFile()
    {
        return $this->originalFile;
    }

    /**
     * Set encodedFile
     *
     * @param \Ivoz\Provider\Domain\Model\MusicOnHold\EncodedFile $encodedFile
     *
     * @return static
     */
    public function setEncodedFile(EncodedFile $encodedFile)
    {
        $isEqual = $this->encodedFile && $this->encodedFile->equals($encodedFile);
        if ($isEqual) {
            return $this;
        }

        $this->encodedFile = $encodedFile;
        return $this;
    }

    /**
     * Get encodedFile
     *
     * @return \Ivoz\Provider\Domain\Model\MusicOnHold\EncodedFile
     */
    public function getEncodedFile()
    {
        return $this->encodedFile;
    }
    // @codeCoverageIgnoreEnd
}
