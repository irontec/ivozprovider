<?php

namespace Ivoz\Provider\Domain\Model\Locution;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * LocutionAbstract
 * @codeCoverageIgnore
 */
abstract class LocutionAbstract
{
    const STATUS_PENDING = 'pending';
    const STATUS_ENCODING = 'encoding';
    const STATUS_READY = 'ready';
    const STATUS_ERROR = 'error';

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
     * @var EncodedFile
     */
    protected $encodedFile;

    /**
     * @var OriginalFile
     */
    protected $originalFile;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;


    use ChangelogTrait;

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
            "Locution",
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
     * @return LocutionDto
     */
    public static function createDto($id = null)
    {
        return new LocutionDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return LocutionDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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
         * @var $dto LocutionDto
         */
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
            ->setCompany($fkTransformer->transform($dto->getCompany()))
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
         * @var $dto LocutionDto
         */
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



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return LocutionDto
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
            'encodedFileFileSize' => self::getEncodedFile()->getFileSize(),
            'encodedFileMimeType' => self::getEncodedFile()->getMimeType(),
            'encodedFileBaseName' => self::getEncodedFile()->getBaseName(),
            'originalFileFileSize' => self::getOriginalFile()->getFileSize(),
            'originalFileMimeType' => self::getOriginalFile()->getMimeType(),
            'originalFileBaseName' => self::getOriginalFile()->getBaseName(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
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
     * @param string $status
     *
     * @return self
     */
    protected function setStatus($status = null)
    {
        if (!is_null($status)) {
            Assertion::maxLength($status, 20, 'status value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($status, [
                self::STATUS_PENDING,
                self::STATUS_ENCODING,
                self::STATUS_READY,
                self::STATUS_ERROR
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
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set encodedFile
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\EncodedFile $encodedFile
     *
     * @return self
     */
    public function setEncodedFile(EncodedFile $encodedFile)
    {
        $this->encodedFile = $encodedFile;
        return $this;
    }

    /**
     * Get encodedFile
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\EncodedFile
     */
    public function getEncodedFile()
    {
        return $this->encodedFile;
    }

    /**
     * Set originalFile
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\OriginalFile $originalFile
     *
     * @return self
     */
    public function setOriginalFile(OriginalFile $originalFile)
    {
        $this->originalFile = $originalFile;
        return $this;
    }

    /**
     * Get originalFile
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\OriginalFile
     */
    public function getOriginalFile()
    {
        return $this->originalFile;
    }
    // @codeCoverageIgnoreEnd
}
