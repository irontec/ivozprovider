<?php

namespace Ivoz\Kam\Domain\Model\UsersLocationAttr;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * UsersLocationAttrAbstract
 * @codeCoverageIgnore
 */
abstract class UsersLocationAttrAbstract
{
    /**
     * @var string
     */
    protected $ruid = '';

    /**
     * @var string
     */
    protected $username = '';

    /**
     * @var string
     */
    protected $domain;

    /**
     * @var string
     */
    protected $aname = '';

    /**
     * @var integer
     */
    protected $atype = '0';

    /**
     * @var string
     */
    protected $avalue = '';

    /**
     * @column last_modified
     * @var \DateTime
     */
    protected $lastModified;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct(
        $ruid,
        $username,
        $aname,
        $atype,
        $avalue,
        $lastModified
    ) {
        $this->setRuid($ruid);
        $this->setUsername($username);
        $this->setAname($aname);
        $this->setAtype($atype);
        $this->setAvalue($avalue);
        $this->setLastModified($lastModified);

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
     * @return UsersLocationAttrDTO
     */
    public static function createDTO()
    {
        return new UsersLocationAttrDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UsersLocationAttrDTO
         */
        Assertion::isInstanceOf($dto, UsersLocationAttrDTO::class);

        $self = new static(
            $dto->getRuid(),
            $dto->getUsername(),
            $dto->getAname(),
            $dto->getAtype(),
            $dto->getAvalue(),
            $dto->getLastModified());

        return $self
            ->setDomain($dto->getDomain())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UsersLocationAttrDTO
         */
        Assertion::isInstanceOf($dto, UsersLocationAttrDTO::class);

        $this
            ->setRuid($dto->getRuid())
            ->setUsername($dto->getUsername())
            ->setDomain($dto->getDomain())
            ->setAname($dto->getAname())
            ->setAtype($dto->getAtype())
            ->setAvalue($dto->getAvalue())
            ->setLastModified($dto->getLastModified());


        return $this;
    }

    /**
     * @return UsersLocationAttrDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setRuid($this->getRuid())
            ->setUsername($this->getUsername())
            ->setDomain($this->getDomain())
            ->setAname($this->getAname())
            ->setAtype($this->getAtype())
            ->setAvalue($this->getAvalue())
            ->setLastModified($this->getLastModified());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'ruid' => self::getRuid(),
            'username' => self::getUsername(),
            'domain' => self::getDomain(),
            'aname' => self::getAname(),
            'atype' => self::getAtype(),
            'avalue' => self::getAvalue(),
            'last_modified' => self::getLastModified()
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set ruid
     *
     * @param string $ruid
     *
     * @return self
     */
    public function setRuid($ruid)
    {
        Assertion::notNull($ruid);
        Assertion::maxLength($ruid, 64);

        $this->ruid = $ruid;

        return $this;
    }

    /**
     * Get ruid
     *
     * @return string
     */
    public function getRuid()
    {
        return $this->ruid;
    }

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
        Assertion::maxLength($username, 64);

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
     * Set domain
     *
     * @param string $domain
     *
     * @return self
     */
    public function setDomain($domain = null)
    {
        if (!is_null($domain)) {
            Assertion::maxLength($domain, 190);
        }

        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set aname
     *
     * @param string $aname
     *
     * @return self
     */
    public function setAname($aname)
    {
        Assertion::notNull($aname);
        Assertion::maxLength($aname, 64);

        $this->aname = $aname;

        return $this;
    }

    /**
     * Get aname
     *
     * @return string
     */
    public function getAname()
    {
        return $this->aname;
    }

    /**
     * Set atype
     *
     * @param integer $atype
     *
     * @return self
     */
    public function setAtype($atype)
    {
        Assertion::notNull($atype);
        Assertion::integerish($atype);

        $this->atype = $atype;

        return $this;
    }

    /**
     * Get atype
     *
     * @return integer
     */
    public function getAtype()
    {
        return $this->atype;
    }

    /**
     * Set avalue
     *
     * @param string $avalue
     *
     * @return self
     */
    public function setAvalue($avalue)
    {
        Assertion::notNull($avalue);
        Assertion::maxLength($avalue, 255);

        $this->avalue = $avalue;

        return $this;
    }

    /**
     * Get avalue
     *
     * @return string
     */
    public function getAvalue()
    {
        return $this->avalue;
    }

    /**
     * Set lastModified
     *
     * @param \DateTime $lastModified
     *
     * @return self
     */
    public function setLastModified($lastModified)
    {
        Assertion::notNull($lastModified);
        $lastModified = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $lastModified,
            '1900-01-01 00:00:01'
        );

        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * Get lastModified
     *
     * @return \DateTime
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }



    // @codeCoverageIgnoreEnd
}

