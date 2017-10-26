<?php

namespace Ivoz\Provider\Domain\Model\ConferenceRoom;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * ConferenceRoomAbstract
 * @codeCoverageIgnore
 */
abstract class ConferenceRoomAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var boolean
     */
    protected $pinProtected = 0;

    /**
     * @var string
     */
    protected $pinCode;

    /**
     * @var integer
     */
    protected $maxMembers = 0;

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
    public function __construct($name, $pinProtected, $maxMembers)
    {
        $this->setName($name);
        $this->setPinProtected($pinProtected);
        $this->setMaxMembers($maxMembers);

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
    public function getChangeSet()
    {
        $changes = [];
        $currentValues = $this->__toArray();
        foreach ($currentValues as $key => $value) {

            if ($this->_initialValues[$key] == $currentValues[$key]) {
                continue;
            }
            $changes[$key] = $currentValues[$key];
        }

        return $changes;
    }

    /**
     * @return ConferenceRoomDTO
     */
    public static function createDTO()
    {
        return new ConferenceRoomDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ConferenceRoomDTO
         */
        Assertion::isInstanceOf($dto, ConferenceRoomDTO::class);

        $self = new static(
            $dto->getName(),
            $dto->getPinProtected(),
            $dto->getMaxMembers());

        return $self
            ->setPinCode($dto->getPinCode())
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
         * @var $dto ConferenceRoomDTO
         */
        Assertion::isInstanceOf($dto, ConferenceRoomDTO::class);

        $this
            ->setName($dto->getName())
            ->setPinProtected($dto->getPinProtected())
            ->setPinCode($dto->getPinCode())
            ->setMaxMembers($dto->getMaxMembers())
            ->setCompany($dto->getCompany());


        return $this;
    }

    /**
     * @return ConferenceRoomDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setName($this->getName())
            ->setPinProtected($this->getPinProtected())
            ->setPinCode($this->getPinCode())
            ->setMaxMembers($this->getMaxMembers())
            ->setCompanyId($this->getCompany() ? $this->getCompany()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'pinProtected' => self::getPinProtected(),
            'pinCode' => self::getPinCode(),
            'maxMembers' => self::getMaxMembers(),
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
     * Set pinProtected
     *
     * @param boolean $pinProtected
     *
     * @return self
     */
    public function setPinProtected($pinProtected)
    {
        Assertion::notNull($pinProtected);
        Assertion::between(intval($pinProtected), 0, 1);

        $this->pinProtected = $pinProtected;

        return $this;
    }

    /**
     * Get pinProtected
     *
     * @return boolean
     */
    public function getPinProtected()
    {
        return $this->pinProtected;
    }

    /**
     * Set pinCode
     *
     * @param string $pinCode
     *
     * @return self
     */
    public function setPinCode($pinCode = null)
    {
        if (!is_null($pinCode)) {
            Assertion::maxLength($pinCode, 6);
        }

        $this->pinCode = $pinCode;

        return $this;
    }

    /**
     * Get pinCode
     *
     * @return string
     */
    public function getPinCode()
    {
        return $this->pinCode;
    }

    /**
     * Set maxMembers
     *
     * @param integer $maxMembers
     *
     * @return self
     */
    public function setMaxMembers($maxMembers)
    {
        Assertion::notNull($maxMembers);
        Assertion::integerish($maxMembers);
        Assertion::greaterOrEqualThan($maxMembers, 0);

        $this->maxMembers = $maxMembers;

        return $this;
    }

    /**
     * Get maxMembers
     *
     * @return integer
     */
    public function getMaxMembers()
    {
        return $this->maxMembers;
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



    // @codeCoverageIgnoreEnd
}

