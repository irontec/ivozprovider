<?php

declare(strict_types=1);

namespace Ivoz\Kam\Domain\Model\UsersLocation;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;

/**
* UsersLocationAbstract
* @codeCoverageIgnore
*/
abstract class UsersLocationAbstract
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
    protected $contact = '';

    /**
     * @var ?string
     */
    protected $received = null;

    /**
     * @var ?string
     */
    protected $path = null;

    /**
     * @var \DateTime
     */
    protected $expires;

    /**
     * @var float
     */
    protected $q = 1;

    /**
     * @var string
     */
    protected $callid = 'Default-Call-ID';

    /**
     * @var int
     */
    protected $cseq = 1;

    /**
     * @var \DateTime
     * column: last_modified
     */
    protected $lastModified;

    /**
     * @var int
     */
    protected $flags = 0;

    /**
     * @var int
     */
    protected $cflags = 0;

    /**
     * @var string
     * column: user_agent
     */
    protected $userAgent = '';

    /**
     * @var ?string
     */
    protected $socket = null;

    /**
     * @var ?int
     */
    protected $methods = null;

    /**
     * @var ?string
     */
    protected $instance = null;

    /**
     * @var int
     * column: reg_id
     */
    protected $regId = 0;

    /**
     * @var int
     * column: server_id
     */
    protected $serverId = 0;

    /**
     * @var int
     * column: connection_id
     */
    protected $connectionId = 0;

    /**
     * @var int
     */
    protected $keepalive = 0;

    /**
     * @var int
     */
    protected $partition = 0;

    /**
     * Constructor
     */
    protected function __construct(
        string $ruid,
        string $username,
        string $contact,
        \DateTimeInterface|string $expires,
        float $q,
        string $callid,
        int $cseq,
        \DateTimeInterface|string $lastModified,
        int $flags,
        int $cflags,
        string $userAgent,
        int $regId,
        int $serverId,
        int $connectionId,
        int $keepalive,
        int $partition
    ) {
        $this->setRuid($ruid);
        $this->setUsername($username);
        $this->setContact($contact);
        $this->setExpires($expires);
        $this->setQ($q);
        $this->setCallid($callid);
        $this->setCseq($cseq);
        $this->setLastModified($lastModified);
        $this->setFlags($flags);
        $this->setCflags($cflags);
        $this->setUserAgent($userAgent);
        $this->setRegId($regId);
        $this->setServerId($serverId);
        $this->setConnectionId($connectionId);
        $this->setKeepalive($keepalive);
        $this->setPartition($partition);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "UsersLocation",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): UsersLocationDto
    {
        return new UsersLocationDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|UsersLocationInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UsersLocationDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, UsersLocationInterface::class);

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
     * @param UsersLocationDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, UsersLocationDto::class);
        $ruid = $dto->getRuid();
        Assertion::notNull($ruid, 'getRuid value is null, but non null value was expected.');
        $username = $dto->getUsername();
        Assertion::notNull($username, 'getUsername value is null, but non null value was expected.');
        $contact = $dto->getContact();
        Assertion::notNull($contact, 'getContact value is null, but non null value was expected.');
        $expires = $dto->getExpires();
        Assertion::notNull($expires, 'getExpires value is null, but non null value was expected.');
        $q = $dto->getQ();
        Assertion::notNull($q, 'getQ value is null, but non null value was expected.');
        $callid = $dto->getCallid();
        Assertion::notNull($callid, 'getCallid value is null, but non null value was expected.');
        $cseq = $dto->getCseq();
        Assertion::notNull($cseq, 'getCseq value is null, but non null value was expected.');
        $lastModified = $dto->getLastModified();
        Assertion::notNull($lastModified, 'getLastModified value is null, but non null value was expected.');
        $flags = $dto->getFlags();
        Assertion::notNull($flags, 'getFlags value is null, but non null value was expected.');
        $cflags = $dto->getCflags();
        Assertion::notNull($cflags, 'getCflags value is null, but non null value was expected.');
        $userAgent = $dto->getUserAgent();
        Assertion::notNull($userAgent, 'getUserAgent value is null, but non null value was expected.');
        $regId = $dto->getRegId();
        Assertion::notNull($regId, 'getRegId value is null, but non null value was expected.');
        $serverId = $dto->getServerId();
        Assertion::notNull($serverId, 'getServerId value is null, but non null value was expected.');
        $connectionId = $dto->getConnectionId();
        Assertion::notNull($connectionId, 'getConnectionId value is null, but non null value was expected.');
        $keepalive = $dto->getKeepalive();
        Assertion::notNull($keepalive, 'getKeepalive value is null, but non null value was expected.');
        $partition = $dto->getPartition();
        Assertion::notNull($partition, 'getPartition value is null, but non null value was expected.');

        $self = new static(
            $ruid,
            $username,
            $contact,
            $expires,
            $q,
            $callid,
            $cseq,
            $lastModified,
            $flags,
            $cflags,
            $userAgent,
            $regId,
            $serverId,
            $connectionId,
            $keepalive,
            $partition
        );

        $self
            ->setDomain($dto->getDomain())
            ->setReceived($dto->getReceived())
            ->setPath($dto->getPath())
            ->setSocket($dto->getSocket())
            ->setMethods($dto->getMethods())
            ->setInstance($dto->getInstance());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param UsersLocationDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, UsersLocationDto::class);

        $ruid = $dto->getRuid();
        Assertion::notNull($ruid, 'getRuid value is null, but non null value was expected.');
        $username = $dto->getUsername();
        Assertion::notNull($username, 'getUsername value is null, but non null value was expected.');
        $contact = $dto->getContact();
        Assertion::notNull($contact, 'getContact value is null, but non null value was expected.');
        $expires = $dto->getExpires();
        Assertion::notNull($expires, 'getExpires value is null, but non null value was expected.');
        $q = $dto->getQ();
        Assertion::notNull($q, 'getQ value is null, but non null value was expected.');
        $callid = $dto->getCallid();
        Assertion::notNull($callid, 'getCallid value is null, but non null value was expected.');
        $cseq = $dto->getCseq();
        Assertion::notNull($cseq, 'getCseq value is null, but non null value was expected.');
        $lastModified = $dto->getLastModified();
        Assertion::notNull($lastModified, 'getLastModified value is null, but non null value was expected.');
        $flags = $dto->getFlags();
        Assertion::notNull($flags, 'getFlags value is null, but non null value was expected.');
        $cflags = $dto->getCflags();
        Assertion::notNull($cflags, 'getCflags value is null, but non null value was expected.');
        $userAgent = $dto->getUserAgent();
        Assertion::notNull($userAgent, 'getUserAgent value is null, but non null value was expected.');
        $regId = $dto->getRegId();
        Assertion::notNull($regId, 'getRegId value is null, but non null value was expected.');
        $serverId = $dto->getServerId();
        Assertion::notNull($serverId, 'getServerId value is null, but non null value was expected.');
        $connectionId = $dto->getConnectionId();
        Assertion::notNull($connectionId, 'getConnectionId value is null, but non null value was expected.');
        $keepalive = $dto->getKeepalive();
        Assertion::notNull($keepalive, 'getKeepalive value is null, but non null value was expected.');
        $partition = $dto->getPartition();
        Assertion::notNull($partition, 'getPartition value is null, but non null value was expected.');

        $this
            ->setRuid($ruid)
            ->setUsername($username)
            ->setDomain($dto->getDomain())
            ->setContact($contact)
            ->setReceived($dto->getReceived())
            ->setPath($dto->getPath())
            ->setExpires($expires)
            ->setQ($q)
            ->setCallid($callid)
            ->setCseq($cseq)
            ->setLastModified($lastModified)
            ->setFlags($flags)
            ->setCflags($cflags)
            ->setUserAgent($userAgent)
            ->setSocket($dto->getSocket())
            ->setMethods($dto->getMethods())
            ->setInstance($dto->getInstance())
            ->setRegId($regId)
            ->setServerId($serverId)
            ->setConnectionId($connectionId)
            ->setKeepalive($keepalive)
            ->setPartition($partition);

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersLocationDto
    {
        return self::createDto()
            ->setRuid(self::getRuid())
            ->setUsername(self::getUsername())
            ->setDomain(self::getDomain())
            ->setContact(self::getContact())
            ->setReceived(self::getReceived())
            ->setPath(self::getPath())
            ->setExpires(self::getExpires())
            ->setQ(self::getQ())
            ->setCallid(self::getCallid())
            ->setCseq(self::getCseq())
            ->setLastModified(self::getLastModified())
            ->setFlags(self::getFlags())
            ->setCflags(self::getCflags())
            ->setUserAgent(self::getUserAgent())
            ->setSocket(self::getSocket())
            ->setMethods(self::getMethods())
            ->setInstance(self::getInstance())
            ->setRegId(self::getRegId())
            ->setServerId(self::getServerId())
            ->setConnectionId(self::getConnectionId())
            ->setKeepalive(self::getKeepalive())
            ->setPartition(self::getPartition());
    }

    protected function __toArray(): array
    {
        return [
            'ruid' => self::getRuid(),
            'username' => self::getUsername(),
            'domain' => self::getDomain(),
            'contact' => self::getContact(),
            'received' => self::getReceived(),
            'path' => self::getPath(),
            'expires' => self::getExpires(),
            'q' => self::getQ(),
            'callid' => self::getCallid(),
            'cseq' => self::getCseq(),
            'last_modified' => self::getLastModified(),
            'flags' => self::getFlags(),
            'cflags' => self::getCflags(),
            'user_agent' => self::getUserAgent(),
            'socket' => self::getSocket(),
            'methods' => self::getMethods(),
            'instance' => self::getInstance(),
            'reg_id' => self::getRegId(),
            'server_id' => self::getServerId(),
            'connection_id' => self::getConnectionId(),
            'keepalive' => self::getKeepalive(),
            'partition' => self::getPartition()
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

    protected function setContact(string $contact): static
    {
        Assertion::maxLength($contact, 512, 'contact value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->contact = $contact;

        return $this;
    }

    public function getContact(): string
    {
        return $this->contact;
    }

    protected function setReceived(?string $received = null): static
    {
        if (!is_null($received)) {
            Assertion::maxLength($received, 128, 'received value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->received = $received;

        return $this;
    }

    public function getReceived(): ?string
    {
        return $this->received;
    }

    protected function setPath(?string $path = null): static
    {
        if (!is_null($path)) {
            Assertion::maxLength($path, 512, 'path value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->path = $path;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    protected function setExpires(string|\DateTimeInterface $expires): static
    {

        /** @var \Datetime */
        $expires = DateTimeHelper::createOrFix(
            $expires,
            '2030-05-28 21:32:15'
        );

        if ($this->isInitialized() && $this->expires == $expires) {
            return $this;
        }

        $this->expires = $expires;

        return $this;
    }

    public function getExpires(): \DateTime
    {
        return clone $this->expires;
    }

    protected function setQ(float $q): static
    {
        $this->q = $q;

        return $this;
    }

    public function getQ(): float
    {
        return $this->q;
    }

    protected function setCallid(string $callid): static
    {
        Assertion::maxLength($callid, 255, 'callid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->callid = $callid;

        return $this;
    }

    public function getCallid(): string
    {
        return $this->callid;
    }

    protected function setCseq(int $cseq): static
    {
        $this->cseq = $cseq;

        return $this;
    }

    public function getCseq(): int
    {
        return $this->cseq;
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

    protected function setFlags(int $flags): static
    {
        $this->flags = $flags;

        return $this;
    }

    public function getFlags(): int
    {
        return $this->flags;
    }

    protected function setCflags(int $cflags): static
    {
        $this->cflags = $cflags;

        return $this;
    }

    public function getCflags(): int
    {
        return $this->cflags;
    }

    protected function setUserAgent(string $userAgent): static
    {
        Assertion::maxLength($userAgent, 255, 'userAgent value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->userAgent = $userAgent;

        return $this;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    protected function setSocket(?string $socket = null): static
    {
        if (!is_null($socket)) {
            Assertion::maxLength($socket, 64, 'socket value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->socket = $socket;

        return $this;
    }

    public function getSocket(): ?string
    {
        return $this->socket;
    }

    protected function setMethods(?int $methods = null): static
    {
        $this->methods = $methods;

        return $this;
    }

    public function getMethods(): ?int
    {
        return $this->methods;
    }

    protected function setInstance(?string $instance = null): static
    {
        if (!is_null($instance)) {
            Assertion::maxLength($instance, 255, 'instance value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->instance = $instance;

        return $this;
    }

    public function getInstance(): ?string
    {
        return $this->instance;
    }

    protected function setRegId(int $regId): static
    {
        $this->regId = $regId;

        return $this;
    }

    public function getRegId(): int
    {
        return $this->regId;
    }

    protected function setServerId(int $serverId): static
    {
        $this->serverId = $serverId;

        return $this;
    }

    public function getServerId(): int
    {
        return $this->serverId;
    }

    protected function setConnectionId(int $connectionId): static
    {
        $this->connectionId = $connectionId;

        return $this;
    }

    public function getConnectionId(): int
    {
        return $this->connectionId;
    }

    protected function setKeepalive(int $keepalive): static
    {
        $this->keepalive = $keepalive;

        return $this;
    }

    public function getKeepalive(): int
    {
        return $this->keepalive;
    }

    protected function setPartition(int $partition): static
    {
        $this->partition = $partition;

        return $this;
    }

    public function getPartition(): int
    {
        return $this->partition;
    }
}
