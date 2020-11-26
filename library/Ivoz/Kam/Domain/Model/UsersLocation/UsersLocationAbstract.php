<?php
declare(strict_types = 1);

namespace Ivoz\Kam\Domain\Model\UsersLocation;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var string | null
     */
    protected $domain;

    /**
     * @var string
     */
    protected $contact = '';

    /**
     * @var string | null
     */
    protected $received;

    /**
     * @var string | null
     */
    protected $path;

    /**
     * @var \DateTimeInterface
     */
    protected $expires = '2030-05-28 21:32:15';

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
     * column: last_modified
     * @var \DateTimeInterface
     */
    protected $lastModified = '1900-01-01 00:00:01';

    /**
     * @var int
     */
    protected $flags = 0;

    /**
     * @var int
     */
    protected $cflags = 0;

    /**
     * column: user_agent
     * @var string
     */
    protected $userAgent = '';

    /**
     * @var string | null
     */
    protected $socket;

    /**
     * @var int | null
     */
    protected $methods;

    /**
     * @var string | null
     */
    protected $instance;

    /**
     * column: reg_id
     * @var int
     */
    protected $regId = 0;

    /**
     * column: server_id
     * @var int
     */
    protected $serverId = 0;

    /**
     * column: connection_id
     * @var int
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

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "UsersLocation",
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
     * @return UsersLocationDto
     */
    public static function createDto($id = null)
    {
        return new UsersLocationDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param UsersLocationInterface|null $entity
     * @param int $depth
     * @return UsersLocationDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var UsersLocationDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersLocationDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, UsersLocationDto::class);

        $self = new static(
            $dto->getRuid(),
            $dto->getUsername(),
            $dto->getContact(),
            $dto->getExpires(),
            $dto->getQ(),
            $dto->getCallid(),
            $dto->getCseq(),
            $dto->getLastModified(),
            $dto->getFlags(),
            $dto->getCflags(),
            $dto->getUserAgent(),
            $dto->getRegId(),
            $dto->getServerId(),
            $dto->getConnectionId(),
            $dto->getKeepalive(),
            $dto->getPartition()
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
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, UsersLocationDto::class);

        $this
            ->setRuid($dto->getRuid())
            ->setUsername($dto->getUsername())
            ->setDomain($dto->getDomain())
            ->setContact($dto->getContact())
            ->setReceived($dto->getReceived())
            ->setPath($dto->getPath())
            ->setExpires($dto->getExpires())
            ->setQ($dto->getQ())
            ->setCallid($dto->getCallid())
            ->setCseq($dto->getCseq())
            ->setLastModified($dto->getLastModified())
            ->setFlags($dto->getFlags())
            ->setCflags($dto->getCflags())
            ->setUserAgent($dto->getUserAgent())
            ->setSocket($dto->getSocket())
            ->setMethods($dto->getMethods())
            ->setInstance($dto->getInstance())
            ->setRegId($dto->getRegId())
            ->setServerId($dto->getServerId())
            ->setConnectionId($dto->getConnectionId())
            ->setKeepalive($dto->getKeepalive())
            ->setPartition($dto->getPartition());

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return UsersLocationDto
     */
    public function toDto($depth = 0)
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

    /**
     * @return array
     */
    protected function __toArray()
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

    /**
     * Set ruid
     *
     * @param string $ruid
     *
     * @return static
     */
    protected function setRuid(string $ruid): UsersLocationInterface
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
    protected function setUsername(string $username): UsersLocationInterface
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
    protected function setDomain(?string $domain = null): UsersLocationInterface
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
     * Set contact
     *
     * @param string $contact
     *
     * @return static
     */
    protected function setContact(string $contact): UsersLocationInterface
    {
        Assertion::maxLength($contact, 512, 'contact value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact(): string
    {
        return $this->contact;
    }

    /**
     * Set received
     *
     * @param string $received | null
     *
     * @return static
     */
    protected function setReceived(?string $received = null): UsersLocationInterface
    {
        if (!is_null($received)) {
            Assertion::maxLength($received, 128, 'received value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->received = $received;

        return $this;
    }

    /**
     * Get received
     *
     * @return string | null
     */
    public function getReceived(): ?string
    {
        return $this->received;
    }

    /**
     * Set path
     *
     * @param string $path | null
     *
     * @return static
     */
    protected function setPath(?string $path = null): UsersLocationInterface
    {
        if (!is_null($path)) {
            Assertion::maxLength($path, 512, 'path value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string | null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * Set expires
     *
     * @param \DateTimeInterface $expires
     *
     * @return static
     */
    protected function setExpires($expires): UsersLocationInterface
    {

        $expires = DateTimeHelper::createOrFix(
            $expires,
            '2030-05-28 21:32:15'
        );

        if ($this->expires == $expires) {
            return $this;
        }

        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return \DateTimeInterface
     */
    public function getExpires(): \DateTimeInterface
    {
        return clone $this->expires;
    }

    /**
     * Set q
     *
     * @param float $q
     *
     * @return static
     */
    protected function setQ(float $q): UsersLocationInterface
    {
        $this->q = $q;

        return $this;
    }

    /**
     * Get q
     *
     * @return float
     */
    public function getQ(): float
    {
        return $this->q;
    }

    /**
     * Set callid
     *
     * @param string $callid
     *
     * @return static
     */
    protected function setCallid(string $callid): UsersLocationInterface
    {
        Assertion::maxLength($callid, 255, 'callid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->callid = $callid;

        return $this;
    }

    /**
     * Get callid
     *
     * @return string
     */
    public function getCallid(): string
    {
        return $this->callid;
    }

    /**
     * Set cseq
     *
     * @param int $cseq
     *
     * @return static
     */
    protected function setCseq(int $cseq): UsersLocationInterface
    {
        $this->cseq = $cseq;

        return $this;
    }

    /**
     * Get cseq
     *
     * @return int
     */
    public function getCseq(): int
    {
        return $this->cseq;
    }

    /**
     * Set lastModified
     *
     * @param \DateTimeInterface $lastModified
     *
     * @return static
     */
    protected function setLastModified($lastModified): UsersLocationInterface
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

    /**
     * Set flags
     *
     * @param int $flags
     *
     * @return static
     */
    protected function setFlags(int $flags): UsersLocationInterface
    {
        $this->flags = $flags;

        return $this;
    }

    /**
     * Get flags
     *
     * @return int
     */
    public function getFlags(): int
    {
        return $this->flags;
    }

    /**
     * Set cflags
     *
     * @param int $cflags
     *
     * @return static
     */
    protected function setCflags(int $cflags): UsersLocationInterface
    {
        $this->cflags = $cflags;

        return $this;
    }

    /**
     * Get cflags
     *
     * @return int
     */
    public function getCflags(): int
    {
        return $this->cflags;
    }

    /**
     * Set userAgent
     *
     * @param string $userAgent
     *
     * @return static
     */
    protected function setUserAgent(string $userAgent): UsersLocationInterface
    {
        Assertion::maxLength($userAgent, 255, 'userAgent value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * Set socket
     *
     * @param string $socket | null
     *
     * @return static
     */
    protected function setSocket(?string $socket = null): UsersLocationInterface
    {
        if (!is_null($socket)) {
            Assertion::maxLength($socket, 64, 'socket value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->socket = $socket;

        return $this;
    }

    /**
     * Get socket
     *
     * @return string | null
     */
    public function getSocket(): ?string
    {
        return $this->socket;
    }

    /**
     * Set methods
     *
     * @param int $methods | null
     *
     * @return static
     */
    protected function setMethods(?int $methods = null): UsersLocationInterface
    {
        $this->methods = $methods;

        return $this;
    }

    /**
     * Get methods
     *
     * @return int | null
     */
    public function getMethods(): ?int
    {
        return $this->methods;
    }

    /**
     * Set instance
     *
     * @param string $instance | null
     *
     * @return static
     */
    protected function setInstance(?string $instance = null): UsersLocationInterface
    {
        if (!is_null($instance)) {
            Assertion::maxLength($instance, 255, 'instance value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->instance = $instance;

        return $this;
    }

    /**
     * Get instance
     *
     * @return string | null
     */
    public function getInstance(): ?string
    {
        return $this->instance;
    }

    /**
     * Set regId
     *
     * @param int $regId
     *
     * @return static
     */
    protected function setRegId(int $regId): UsersLocationInterface
    {
        $this->regId = $regId;

        return $this;
    }

    /**
     * Get regId
     *
     * @return int
     */
    public function getRegId(): int
    {
        return $this->regId;
    }

    /**
     * Set serverId
     *
     * @param int $serverId
     *
     * @return static
     */
    protected function setServerId(int $serverId): UsersLocationInterface
    {
        $this->serverId = $serverId;

        return $this;
    }

    /**
     * Get serverId
     *
     * @return int
     */
    public function getServerId(): int
    {
        return $this->serverId;
    }

    /**
     * Set connectionId
     *
     * @param int $connectionId
     *
     * @return static
     */
    protected function setConnectionId(int $connectionId): UsersLocationInterface
    {
        $this->connectionId = $connectionId;

        return $this;
    }

    /**
     * Get connectionId
     *
     * @return int
     */
    public function getConnectionId(): int
    {
        return $this->connectionId;
    }

    /**
     * Set keepalive
     *
     * @param int $keepalive
     *
     * @return static
     */
    protected function setKeepalive(int $keepalive): UsersLocationInterface
    {
        $this->keepalive = $keepalive;

        return $this;
    }

    /**
     * Get keepalive
     *
     * @return int
     */
    public function getKeepalive(): int
    {
        return $this->keepalive;
    }

    /**
     * Set partition
     *
     * @param int $partition
     *
     * @return static
     */
    protected function setPartition(int $partition): UsersLocationInterface
    {
        $this->partition = $partition;

        return $this;
    }

    /**
     * Get partition
     *
     * @return int
     */
    public function getPartition(): int
    {
        return $this->partition;
    }

}
