<?php

namespace Ivoz\Provider\Domain\Model\TerminalModel;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * TerminalModelAbstract
 * @codeCoverageIgnore
 */
abstract class TerminalModelAbstract
{
    /**
     * @var string
     */
    protected $iden;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var string
     */
    protected $genericTemplate;

    /**
     * @var string
     */
    protected $specificTemplate;

    /**
     * @var string
     */
    protected $genericUrlPattern;

    /**
     * @var string
     */
    protected $specificUrlPattern;

    /**
     * @var \Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerInterface
     */
    protected $terminalManufacturer;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    protected function __construct($iden, $name, $description)
    {
        $this->setIden($iden);
        $this->setName($name);
        $this->setDescription($description);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "TerminalModel",
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
     * @return TerminalModelDTO
     */
    public static function createDTO()
    {
        return new TerminalModelDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TerminalModelDTO
         */
        Assertion::isInstanceOf($dto, TerminalModelDTO::class);

        $self = new static(
            $dto->getIden(),
            $dto->getName(),
            $dto->getDescription());

        $self
            ->setGenericTemplate($dto->getGenericTemplate())
            ->setSpecificTemplate($dto->getSpecificTemplate())
            ->setGenericUrlPattern($dto->getGenericUrlPattern())
            ->setSpecificUrlPattern($dto->getSpecificUrlPattern())
            ->setTerminalManufacturer($dto->getTerminalManufacturer())
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
         * @var $dto TerminalModelDTO
         */
        Assertion::isInstanceOf($dto, TerminalModelDTO::class);

        $this
            ->setIden($dto->getIden())
            ->setName($dto->getName())
            ->setDescription($dto->getDescription())
            ->setGenericTemplate($dto->getGenericTemplate())
            ->setSpecificTemplate($dto->getSpecificTemplate())
            ->setGenericUrlPattern($dto->getGenericUrlPattern())
            ->setSpecificUrlPattern($dto->getSpecificUrlPattern())
            ->setTerminalManufacturer($dto->getTerminalManufacturer());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @return TerminalModelDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setIden($this->getIden())
            ->setName($this->getName())
            ->setDescription($this->getDescription())
            ->setGenericTemplate($this->getGenericTemplate())
            ->setSpecificTemplate($this->getSpecificTemplate())
            ->setGenericUrlPattern($this->getGenericUrlPattern())
            ->setSpecificUrlPattern($this->getSpecificUrlPattern())
            ->setTerminalManufacturerId($this->getTerminalManufacturer() ? $this->getTerminalManufacturer()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'iden' => self::getIden(),
            'name' => self::getName(),
            'description' => self::getDescription(),
            'genericTemplate' => self::getGenericTemplate(),
            'specificTemplate' => self::getSpecificTemplate(),
            'genericUrlPattern' => self::getGenericUrlPattern(),
            'specificUrlPattern' => self::getSpecificUrlPattern(),
            'terminalManufacturerId' => self::getTerminalManufacturer() ? self::getTerminalManufacturer()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set iden
     *
     * @param string $iden
     *
     * @return self
     */
    public function setIden($iden)
    {
        Assertion::notNull($iden, 'iden value "%s" is null, but non null value was expected.');
        Assertion::maxLength($iden, 100, 'iden value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->iden = $iden;

        return $this;
    }

    /**
     * Get iden
     *
     * @return string
     */
    public function getIden()
    {
        return $this->iden;
    }

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
        Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        Assertion::notNull($description, 'description value "%s" is null, but non null value was expected.');
        Assertion::maxLength($description, 500, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set genericTemplate
     *
     * @param string $genericTemplate
     *
     * @return self
     */
    public function setGenericTemplate($genericTemplate = null)
    {
        if (!is_null($genericTemplate)) {
            Assertion::maxLength($genericTemplate, 65535, 'genericTemplate value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->genericTemplate = $genericTemplate;

        return $this;
    }

    /**
     * Get genericTemplate
     *
     * @return string
     */
    public function getGenericTemplate()
    {
        return $this->genericTemplate;
    }

    /**
     * Set specificTemplate
     *
     * @param string $specificTemplate
     *
     * @return self
     */
    public function setSpecificTemplate($specificTemplate = null)
    {
        if (!is_null($specificTemplate)) {
            Assertion::maxLength($specificTemplate, 65535, 'specificTemplate value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->specificTemplate = $specificTemplate;

        return $this;
    }

    /**
     * Get specificTemplate
     *
     * @return string
     */
    public function getSpecificTemplate()
    {
        return $this->specificTemplate;
    }

    /**
     * Set genericUrlPattern
     *
     * @param string $genericUrlPattern
     *
     * @return self
     */
    public function setGenericUrlPattern($genericUrlPattern = null)
    {
        if (!is_null($genericUrlPattern)) {
            Assertion::maxLength($genericUrlPattern, 225, 'genericUrlPattern value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->genericUrlPattern = $genericUrlPattern;

        return $this;
    }

    /**
     * Get genericUrlPattern
     *
     * @return string
     */
    public function getGenericUrlPattern()
    {
        return $this->genericUrlPattern;
    }

    /**
     * Set specificUrlPattern
     *
     * @param string $specificUrlPattern
     *
     * @return self
     */
    public function setSpecificUrlPattern($specificUrlPattern = null)
    {
        if (!is_null($specificUrlPattern)) {
            Assertion::maxLength($specificUrlPattern, 225, 'specificUrlPattern value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->specificUrlPattern = $specificUrlPattern;

        return $this;
    }

    /**
     * Get specificUrlPattern
     *
     * @return string
     */
    public function getSpecificUrlPattern()
    {
        return $this->specificUrlPattern;
    }

    /**
     * Set terminalManufacturer
     *
     * @param \Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerInterface $terminalManufacturer
     *
     * @return self
     */
    public function setTerminalManufacturer(\Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerInterface $terminalManufacturer)
    {
        $this->terminalManufacturer = $terminalManufacturer;

        return $this;
    }

    /**
     * Get terminalManufacturer
     *
     * @return \Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerInterface
     */
    public function getTerminalManufacturer()
    {
        return $this->terminalManufacturer;
    }



    // @codeCoverageIgnoreEnd
}

