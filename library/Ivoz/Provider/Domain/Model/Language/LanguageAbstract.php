<?php

namespace Ivoz\Provider\Domain\Model\Language;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * LanguageAbstract
 * @codeCoverageIgnore
 */
abstract class LanguageAbstract
{
    /**
     * @var string
     */
    protected $iden;

    /**
     * @var Name
     */
    protected $name;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($iden, Name $name)
    {
        $this->setIden($iden);
        $this->setName($name);

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
     * @return LanguageDTO
     */
    public static function createDTO()
    {
        return new LanguageDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto LanguageDTO
         */
        Assertion::isInstanceOf($dto, LanguageDTO::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs()
        );

        $self = new static(
            $dto->getIden(),
            $name
        );

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto LanguageDTO
         */
        Assertion::isInstanceOf($dto, LanguageDTO::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs()
        );

        $this
            ->setIden($dto->getIden())
            ->setName($name);


        return $this;
    }

    /**
     * @return LanguageDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setIden($this->getIden())
            ->setNameEn($this->getName()->getEn())
            ->setNameEs($this->getName()->getEs());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'iden' => self::getIden(),
            'nameEn' => self::getName()->getEn(),
            'nameEs' => self::getName()->getEs()
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
     * @param \Ivoz\Provider\Domain\Model\Language\Name $name
     *
     * @return self
     */
    public function setName(Name $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\Language\Name
     */
    public function getName()
    {
        return $this->name;
    }

    // @codeCoverageIgnoreEnd
}

