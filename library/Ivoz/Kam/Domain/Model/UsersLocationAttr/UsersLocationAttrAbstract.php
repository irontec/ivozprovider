<?php
declare(strict_types = 1);

namespace Ivoz\Kam\Domain\Model\UsersLocationAttr;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;

/**
* UsersLocationAttrAbstract
* @codeCoverageIgnore
*/
abstract class UsersLocationAttrAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $ruid = '';

    /**
     * @var string
     */
    protected $username = '';

    /**
     * @var string | null
     */
    protected $domain;

    /**
     * @var string
     */
    protected $aname = '';

    /**
     * @var int
     */
    protected $atype = 0;

    /**
     * @var string
     */
    protected $avalue = '';

    /**
     * column: last_modified
     * @var \DateTimeInterface
     */
    protected $lastModified = '1900-01-01 00:00:01';

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
        return sprintf(
            "%s#%s",
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
     * @internal use EntityTools instead
     * @param UsersLocationAttrInterface|null $entity
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

        /** @var UsersLocationAttrDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersLocationAttrDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, UsersLocationAttrDto::class);

        $self = new static(
            $dto->getRuid(),
            $dto->getUsername(),
            $dto->getAname(),
            $dto->getAtype(),
            $dto->getAvalue(),
            $dto->getLastModified()
        );

        $self
            ->setDomain($dto->getDomain());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param UsersLocationAttrDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, UsersLocationAttrDto::class);

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
     * @internal use EntityTools instead
     * @param int $depth
     * @return UsersLocationAttrDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setRuid(self::getRuid())
            ->setUsername(self::getUsername())
            ->setDomain(self::getDomain())
            ->setAname(self::getAname())
            ->setAtype(self::getAtype())
            ->setAvalue(self::getAvalue())
            ->setLastModified(self::getLastModified());
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

    /**
     * Set ruid
     *
     * @param string $ruid
     *
     * @return static
     */
    protected function setRuid(string $ruid): UsersLocationAttrInterface
    {
        Assertion::maxLength($ruid, 64, 'ruid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ruid = $ruid;

        return $this;
    }

    /**
     * Get ruid
     *
     * @return string
     */
    public function getRuid(): string
    {
        return $this->ruid;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return static
     */
    protected function setUsername(string $username): UsersLocationAttrInterface
    {
        Assertion::maxLength($username, 64, 'username value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set domain
     *
     * @param string $domain | null
     *
     * @return static
     */
    protected function setDomain(?string $domain = null): UsersLocationAttrInterface
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
     * @return string | null
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * Set aname
     *
     * @param string $aname
     *
     * @return static
     */
    protected function setAname(string $aname): UsersLocationAttrInterface
    {
        Assertion::maxLength($aname, 64, 'aname value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->aname = $aname;

        return $this;
    }

    /**
     * Get aname
     *
     * @return string
     */
    public function getAname(): string
    {
        return $this->aname;
    }

    /**
     * Set atype
     *
     * @param int $atype
     *
     * @return static
     */
    protected function setAtype(int $atype): UsersLocationAttrInterface
    {
        $this->atype = $atype;

        return $this;
    }

    /**
     * Get atype
     *
     * @return int
     */
    public function getAtype(): int
    {
        return $this->atype;
    }

    /**
     * Set avalue
     *
     * @param string $avalue
     *
     * @return static
     */
    protected function setAvalue(string $avalue): UsersLocationAttrInterface
    {
        Assertion::maxLength($avalue, 255, 'avalue value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->avalue = $avalue;

        return $this;
    }

    /**
     * Get avalue
     *
     * @return string
     */
    public function getAvalue(): string
    {
        return $this->avalue;
    }

    /**
     * Set lastModified
     *
     * @param \DateTimeInterface $lastModified
     *
     * @return static
     */
    protected function setLastModified($lastModified): UsersLocationAttrInterface
    {

        $lastModified = DateTimeHelper::createOrFix(
            $lastModified,
            '1900-01-01 00:00:01'
        );

        if ($this->lastModified == $lastModified) {
            return $this;
        }

        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * Get lastModified
     *
     * @return \DateTimeInterface
     */
    public function getLastModified(): \DateTimeInterface
    {
        return clone $this->lastModified;
    }

}
