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
    public function __construct(
        $name,
        OriginalFile $originalFile,
        EncodedFile $encodedFile
    ) {
        $this->setName($name);
        $this->setOriginalFile($originalFile);
        $this->setEncodedFile($encodedFile);

        $this->initChangelog();
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
    public function hasChanged($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$fieldName] != $this->_initialValues[$fieldName];
    }

    public function getInitialValue($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }

        return $this->_initialValues[$fieldName];
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

        return $self
            ->setStatus($dto->getStatus())
            ->setCompany($dto->getCompany())
        ;
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
            ->setCompany($dto->getCompany());


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
            'fileSize' => $this->getOriginalFile()->getFileSize(),
            'mimeType' => $this->getOriginalFile()->getMimeType(),
            'baseName' => $this->getOriginalFile()->getBaseName(),
            'fileSize' => $this->getEncodedFile()->getFileSize(),
            'mimeType' => $this->getEncodedFile()->getMimeType(),
            'baseName' => $this->getEncodedFile()->getBaseName(),
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
        Assertion::notNull($name);
        Assertion::maxLength($name, 50);

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
            Assertion::maxLength($status, 20);
        Assertion::choice($status, array (
          0 => 'pending',
          1 => 'encoding',
          2 => 'ready',
          3 => 'error',
        ));
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
     * @param OriginalFile $originalFile
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
     * @return OriginalFile
     */
    public function getOriginalFile()
    {
        return $this->originalFile;
    }

    /**
     * Set encodedFile
     *
     * @param EncodedFile $encodedFile
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
     * @return EncodedFile
     */
    public function getEncodedFile()
    {
        return $this->encodedFile;
    }

    // @codeCoverageIgnoreEnd
}

