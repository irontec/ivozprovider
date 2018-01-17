<?php

namespace Ivoz\Kam\Domain\Model\UsersLocationAttr;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

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
     * column: last_modified
     * @var \DateTime
     */
    protected $lastModified;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
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
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "UsersLocationAttr",
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
     * @return UsersLocationAttrDto
     */
    public static function createDto($id = null)
    {
        return new UsersLocationAttrDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return UsersLocationAttrDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, UsersLocationAttrInterface::class);

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
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UsersLocationAttrDto
         */
        Assertion::isInstanceOf($dto, UsersLocationAttrDto::class);

        $self = new static(
            $dto->getRuid(),
            $dto->getUsername(),
            $dto->getAname(),
            $dto->getAtype(),
            $dto->getAvalue(),
            $dto->getLastModified());

        $self
            ->setDomain($dto->getDomain())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UsersLocationAttrDto
         */
        Assertion::isInstanceOf($dto, UsersLocationAttrDto::class);

        $this
            ->setRuid($dto->getRuid())
            ->setUsername($dto->getUsername())
            ->setDomain($dto->getDomain())
            ->setAname($dto->getAname())
            ->setAtype($dto->getAtype())
            ->setAvalue($dto->getAvalue())
            ->setLastModified($dto->getLastModified());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return UsersLocationAttrDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
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
        Assertion::notNull($ruid, 'ruid value "%s" is null, but non null value was expected.');
        Assertion::maxLength($ruid, 64, 'ruid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
        Assertion::notNull($username, 'username value "%s" is null, but non null value was expected.');
        Assertion::maxLength($username, 64, 'username value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
            Assertion::maxLength($domain, 190, 'domain value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
        Assertion::notNull($aname, 'aname value "%s" is null, but non null value was expected.');
        Assertion::maxLength($aname, 64, 'aname value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
        Assertion::notNull($atype, 'atype value "%s" is null, but non null value was expected.');
        Assertion::integerish($atype, 'atype value "%s" is not an integer or a number castable to integer.');

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
        Assertion::notNull($avalue, 'avalue value "%s" is null, but non null value was expected.');
        Assertion::maxLength($avalue, 255, 'avalue value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
        Assertion::notNull($lastModified, 'lastModified value "%s" is null, but non null value was expected.');
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

