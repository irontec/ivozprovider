<?php

declare(strict_types=1);

namespace Ivoz\Kam\Domain\Model\UsersLocationAttr;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var ?string
     */
    protected $domain = null;

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
     * @var \DateTime
     * column: last_modified
     */
    protected $lastModified;

    /**
     * Constructor
     */
    protected function __construct(
        string $ruid,
        string $username,
        string $aname,
        int $atype,
        string $avalue,
        \DateTimeInterface|string $lastModified
    ) {
        $this->setRuid($ruid);
        $this->setUsername($username);
        $this->setAname($aname);
        $this->setAtype($atype);
        $this->setAvalue($avalue);
        $this->setLastModified($lastModified);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "UsersLocationAttr",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): UsersLocationAttrDto
    {
        return new UsersLocationAttrDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|UsersLocationAttrInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UsersLocationAttrDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersLocationAttrDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, UsersLocationAttrDto::class);
        $ruid = $dto->getRuid();
        Assertion::notNull($ruid, 'getRuid value is null, but non null value was expected.');
        $username = $dto->getUsername();
        Assertion::notNull($username, 'getUsername value is null, but non null value was expected.');
        $aname = $dto->getAname();
        Assertion::notNull($aname, 'getAname value is null, but non null value was expected.');
        $atype = $dto->getAtype();
        Assertion::notNull($atype, 'getAtype value is null, but non null value was expected.');
        $avalue = $dto->getAvalue();
        Assertion::notNull($avalue, 'getAvalue value is null, but non null value was expected.');
        $lastModified = $dto->getLastModified();
        Assertion::notNull($lastModified, 'getLastModified value is null, but non null value was expected.');

        $self = new static(
            $ruid,
            $username,
            $aname,
            $atype,
            $avalue,
            $lastModified
        );

        $self
            ->setDomain($dto->getDomain());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param UsersLocationAttrDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, UsersLocationAttrDto::class);

        $ruid = $dto->getRuid();
        Assertion::notNull($ruid, 'getRuid value is null, but non null value was expected.');
        $username = $dto->getUsername();
        Assertion::notNull($username, 'getUsername value is null, but non null value was expected.');
        $aname = $dto->getAname();
        Assertion::notNull($aname, 'getAname value is null, but non null value was expected.');
        $atype = $dto->getAtype();
        Assertion::notNull($atype, 'getAtype value is null, but non null value was expected.');
        $avalue = $dto->getAvalue();
        Assertion::notNull($avalue, 'getAvalue value is null, but non null value was expected.');
        $lastModified = $dto->getLastModified();
        Assertion::notNull($lastModified, 'getLastModified value is null, but non null value was expected.');

        $this
            ->setRuid($ruid)
            ->setUsername($username)
            ->setDomain($dto->getDomain())
            ->setAname($aname)
            ->setAtype($atype)
            ->setAvalue($avalue)
            ->setLastModified($lastModified);

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersLocationAttrDto
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

    protected function __toArray(): array
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

    protected function setRuid(string $ruid): static
    {
        Assertion::maxLength($ruid, 64, 'ruid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ruid = $ruid;

        return $this;
    }

    public function getRuid(): string
    {
        return $this->ruid;
    }

    protected function setUsername(string $username): static
    {
        Assertion::maxLength($username, 64, 'username value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->username = $username;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    protected function setDomain(?string $domain = null): static
    {
        if (!is_null($domain)) {
            Assertion::maxLength($domain, 190, 'domain value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->domain = $domain;

        return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    protected function setAname(string $aname): static
    {
        Assertion::maxLength($aname, 64, 'aname value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->aname = $aname;

        return $this;
    }

    public function getAname(): string
    {
        return $this->aname;
    }

    protected function setAtype(int $atype): static
    {
        $this->atype = $atype;

        return $this;
    }

    public function getAtype(): int
    {
        return $this->atype;
    }

    protected function setAvalue(string $avalue): static
    {
        Assertion::maxLength($avalue, 512, 'avalue value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->avalue = $avalue;

        return $this;
    }

    public function getAvalue(): string
    {
        return $this->avalue;
    }

    protected function setLastModified(string|\DateTimeInterface $lastModified): static
    {

        /** @var \Datetime */
        $lastModified = DateTimeHelper::createOrFix(
            $lastModified,
            '1900-01-01 00:00:01'
        );

        if ($this->isInitialized() && $this->lastModified == $lastModified) {
            return $this;
        }

        $this->lastModified = $lastModified;

        return $this;
    }

    public function getLastModified(): \DateTime
    {
        return clone $this->lastModified;
    }
}
