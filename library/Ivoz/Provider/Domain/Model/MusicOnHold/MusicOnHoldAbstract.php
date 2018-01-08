<?php

namespace Ivoz\Provider\Domain\Model\MusicOnHold;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

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
     * @comment enum:pending|encoding|ready|error
     * @var string
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
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

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
        return sprintf("%s#%s",
            "MusicOnHold",
            $this->getId()
        );
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$dbFieldName] != $this->_initialValues[$dbFieldName];
    }

    public function getInitialValue($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }

        return $this->_initialValues[$dbFieldName];
    }

    /**
     * @return array
     */
    protected function getChangeSet()
    {
        $changes = [];
        $currentValues = $this->__toArray();
        foreach ($currentValues as $key => $value) {

            if ($this->_initialValues[$key] == $currentValues[$key]) {
                continue;
            }

            $value = $currentValues[$key];
            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }

            $changes[$key] = $value;
        }

        return $changes;
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @return MusicOnHoldDTO
     */
    public static function createDTO()
    {
        return new MusicOnHoldDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto MusicOnHoldDTO
         */
        Assertion::isInstanceOf($dto, MusicOnHoldDTO::class);

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
            ->setBrand($dto->getBrand())
            ->setCompany($dto->getCompany())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto MusicOnHoldDTO
         */
        Assertion::isInstanceOf($dto, MusicOnHoldDTO::class);

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
            ->setBrand($dto->getBrand())
            ->setCompany($dto->getCompany());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @return MusicOnHoldDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setName($this->getName())
            ->setStatus($this->getStatus())
            ->setOriginalFileFileSize($this->getOriginalFile()->getFileSize())
            ->setOriginalFileMimeType($this->getOriginalFile()->getMimeType())
            ->setOriginalFileBaseName($this->getOriginalFile()->getBaseName())
            ->setEncodedFileFileSize($this->getEncodedFile()->getFileSize())
            ->setEncodedFileMimeType($this->getEncodedFile()->getMimeType())
            ->setEncodedFileBaseName($this->getEncodedFile()->getBaseName())
            ->setBrandId($this->getBrand() ? $this->getBrand()->getId() : null)
            ->setCompanyId($this->getCompany() ? $this->getCompany()->getId() : null);
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
     * @return self
     */
    public function setName($name)
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
    public function setStatus($status = null)
    {
        if (!is_null($status)) {
            Assertion::maxLength($status, 20, 'status value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($status, array (
          0 => 'pending',
          1 => 'encoding',
          2 => 'ready',
          3 => 'error',
        ), 'statusvalue "%s" is not an element of the valid values: %s');
        }

        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
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
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand()
    {
        return $this->brand;
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
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
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
     * @return \Ivoz\Provider\Domain\Model\MusicOnHold\EncodedFile
     */
    public function getEncodedFile()
    {
        return $this->encodedFile;
    }

    // @codeCoverageIgnoreEnd
}

