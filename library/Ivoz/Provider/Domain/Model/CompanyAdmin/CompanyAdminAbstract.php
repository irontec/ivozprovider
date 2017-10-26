<?php

namespace Ivoz\Provider\Domain\Model\CompanyAdmin;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * CompanyAdminAbstract
 * @codeCoverageIgnore
 */
abstract class CompanyAdminAbstract
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @comment password
     * @var string
     */
    protected $pass;

    /**
     * @var string
     */
    protected $email = '';

    /**
     * @var boolean
     */
    protected $active = '1';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    protected $timezone;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($username, $pass, $email, $active)
    {
        $this->setUsername($username);
        $this->setPass($pass);
        $this->setEmail($email);
        $this->setActive($active);

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
     * @return CompanyAdminDTO
     */
    public static function createDTO()
    {
        return new CompanyAdminDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CompanyAdminDTO
         */
        Assertion::isInstanceOf($dto, CompanyAdminDTO::class);

        $self = new static(
            $dto->getUsername(),
            $dto->getPass(),
            $dto->getEmail(),
            $dto->getActive());

        return $self
            ->setName($dto->getName())
            ->setLastname($dto->getLastname())
            ->setCompany($dto->getCompany())
            ->setTimezone($dto->getTimezone())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CompanyAdminDTO
         */
        Assertion::isInstanceOf($dto, CompanyAdminDTO::class);

        $this
            ->setUsername($dto->getUsername())
            ->setPass($dto->getPass())
            ->setEmail($dto->getEmail())
            ->setActive($dto->getActive())
            ->setName($dto->getName())
            ->setLastname($dto->getLastname())
            ->setCompany($dto->getCompany())
            ->setTimezone($dto->getTimezone());


        return $this;
    }

    /**
     * @return CompanyAdminDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setUsername($this->getUsername())
            ->setPass($this->getPass())
            ->setEmail($this->getEmail())
            ->setActive($this->getActive())
            ->setName($this->getName())
            ->setLastname($this->getLastname())
            ->setCompanyId($this->getCompany() ? $this->getCompany()->getId() : null)
            ->setTimezoneId($this->getTimezone() ? $this->getTimezone()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'username' => self::getUsername(),
            'pass' => self::getPass(),
            'email' => self::getEmail(),
            'active' => self::getActive(),
            'name' => self::getName(),
            'lastname' => self::getLastname(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'timezoneId' => self::getTimezone() ? self::getTimezone()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set username
     *
     * @param string $username
     *
     * @return self
     */
    public function setUsername($username)
    {
        Assertion::notNull($username);
        Assertion::maxLength($username, 65);

        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set pass
     *
     * @param string $pass
     *
     * @return self
     */
    public function setPass($pass)
    {
        Assertion::notNull($pass);
        Assertion::maxLength($pass, 80);

        $this->pass = $pass;

        return $this;
    }

    /**
     * Get pass
     *
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        Assertion::notNull($email);
        Assertion::maxLength($email, 100);

        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return self
     */
    public function setActive($active)
    {
        Assertion::notNull($active);
        Assertion::between(intval($active), 0, 1);

        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name = null)
    {
        if (!is_null($name)) {
            Assertion::maxLength($name, 100);
        }

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
     * Set lastname
     *
     * @param string $lastname
     *
     * @return self
     */
    public function setLastname($lastname = null)
    {
        if (!is_null($lastname)) {
            Assertion::maxLength($lastname, 100);
        }

        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
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
     * Set timezone
     *
     * @param \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $timezone
     *
     * @return self
     */
    public function setTimezone(\Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $timezone = null)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getTimezone()
    {
        return $this->timezone;
    }



    // @codeCoverageIgnoreEnd
}

