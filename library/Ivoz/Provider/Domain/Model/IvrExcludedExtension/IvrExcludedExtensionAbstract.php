<?php

namespace Ivoz\Provider\Domain\Model\IvrExcludedExtension;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * IvrExcludedExtensionAbstract
 * @codeCoverageIgnore
 */
abstract class IvrExcludedExtensionAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\Ivr\IvrInterface
     */
    protected $ivr;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    protected $extension;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    protected function __construct()
    {

    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "IvrExcludedExtension",
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
     * @return IvrExcludedExtensionDTO
     */
    public static function createDTO()
    {
        return new IvrExcludedExtensionDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto IvrExcludedExtensionDTO
         */
        Assertion::isInstanceOf($dto, IvrExcludedExtensionDTO::class);

        $self = new static();

        $self
            ->setIvr($dto->getIvr())
            ->setExtension($dto->getExtension())
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
         * @var $dto IvrExcludedExtensionDTO
         */
        Assertion::isInstanceOf($dto, IvrExcludedExtensionDTO::class);

        $this
            ->setIvr($dto->getIvr())
            ->setExtension($dto->getExtension());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @return IvrExcludedExtensionDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setIvrId($this->getIvr() ? $this->getIvr()->getId() : null)
            ->setExtensionId($this->getExtension() ? $this->getExtension()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'ivrId' => self::getIvr() ? self::getIvr()->getId() : null,
            'extensionId' => self::getExtension() ? self::getExtension()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set ivr
     *
     * @param \Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr
     *
     * @return self
     */
    public function setIvr(\Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr = null)
    {
        $this->ivr = $ivr;

        return $this;
    }

    /**
     * Get ivr
     *
     * @return \Ivoz\Provider\Domain\Model\Ivr\IvrInterface
     */
    public function getIvr()
    {
        return $this->ivr;
    }

    /**
     * Set extension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension
     *
     * @return self
     */
    public function setExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getExtension()
    {
        return $this->extension;
    }



    // @codeCoverageIgnoreEnd
}

