<?php

namespace Ivoz\Kam\Domain\Model\UsersLocation;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
* UsersLocationDtoAbstract
* @codeCoverageIgnore
*/
abstract class UsersLocationDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $ruid = '';

    /**
     * @var string
     */
    private $username = '';

    /**
     * @var string|null
     */
    private $domain;

    /**
     * @var string
     */
    private $contact = '';

    /**
     * @var string|null
     */
    private $received;

    /**
     * @var string|null
     */
    private $path;

    /**
     * @var \DateTimeInterface|string
     */
    private $expires = '2030-05-28 21:32:15';

    /**
     * @var float
     */
    private $q = 1;

    /**
     * @var string
     */
    private $callid = 'Default-Call-ID';

    /**
     * @var int
     */
    private $cseq = 1;

    /**
     * @var \DateTimeInterface|string
     */
    private $lastModified = '1900-01-01 00:00:01';

    /**
     * @var int
     */
    private $flags = 0;

    /**
     * @var int
     */
    private $cflags = 0;

    /**
     * @var string
     */
    private $userAgent = '';

    /**
     * @var string|null
     */
    private $socket;

    /**
     * @var int|null
     */
    private $methods;

    /**
     * @var string|null
     */
    private $instance;

    /**
     * @var int
     */
    private $regId = 0;

    /**
     * @var int
     */
    private $serverId = 0;

    /**
     * @var int
     */
    private $connectionId = 0;

    /**
     * @var int
     */
    private $keepalive = 0;

    /**
     * @var int
     */
    private $partition = 0;

    /**
     * @var int
     */
    private $id;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'ruid' => 'ruid',
            'username' => 'username',
            'domain' => 'domain',
            'contact' => 'contact',
            'received' => 'received',
            'path' => 'path',
            'expires' => 'expires',
            'q' => 'q',
            'callid' => 'callid',
            'cseq' => 'cseq',
            'lastModified' => 'lastModified',
            'flags' => 'flags',
            'cflags' => 'cflags',
            'userAgent' => 'userAgent',
            'socket' => 'socket',
            'methods' => 'methods',
            'instance' => 'instance',
            'regId' => 'regId',
            'serverId' => 'serverId',
            'connectionId' => 'connectionId',
            'keepalive' => 'keepalive',
            'partition' => 'partition',
            'id' => 'id'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'ruid' => $this->getRuid(),
            'username' => $this->getUsername(),
            'domain' => $this->getDomain(),
            'contact' => $this->getContact(),
            'received' => $this->getReceived(),
            'path' => $this->getPath(),
            'expires' => $this->getExpires(),
            'q' => $this->getQ(),
            'callid' => $this->getCallid(),
            'cseq' => $this->getCseq(),
            'lastModified' => $this->getLastModified(),
            'flags' => $this->getFlags(),
            'cflags' => $this->getCflags(),
            'userAgent' => $this->getUserAgent(),
            'socket' => $this->getSocket(),
            'methods' => $this->getMethods(),
            'instance' => $this->getInstance(),
            'regId' => $this->getRegId(),
            'serverId' => $this->getServerId(),
            'connectionId' => $this->getConnectionId(),
            'keepalive' => $this->getKeepalive(),
            'partition' => $this->getPartition(),
            'id' => $this->getId()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    public function setRuid(string $ruid): static
    {
        $this->ruid = $ruid;

        return $this;
    }

    public function getRuid(): ?string
    {
        return $this->ruid;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setDomain(?string $domain): static
    {
        $this->domain = $domain;

        return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setContact(string $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setReceived(?string $received): static
    {
        $this->received = $received;

        return $this;
    }

    public function getReceived(): ?string
    {
        return $this->received;
    }

    public function setPath(?string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setExpires(\DateTimeInterface|string $expires): static
    {
        $this->expires = $expires;

        return $this;
    }

    public function getExpires(): \DateTimeInterface|string|null
    {
        return $this->expires;
    }

    public function setQ(float $q): static
    {
        $this->q = $q;

        return $this;
    }

    public function getQ(): ?float
    {
        return $this->q;
    }

    public function setCallid(string $callid): static
    {
        $this->callid = $callid;

        return $this;
    }

    public function getCallid(): ?string
    {
        return $this->callid;
    }

    public function setCseq(int $cseq): static
    {
        $this->cseq = $cseq;

        return $this;
    }

    public function getCseq(): ?int
    {
        return $this->cseq;
    }

    public function setLastModified(\DateTimeInterface|string $lastModified): static
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    public function getLastModified(): \DateTimeInterface|string|null
    {
        return $this->lastModified;
    }

    public function setFlags(int $flags): static
    {
        $this->flags = $flags;

        return $this;
    }

    public function getFlags(): ?int
    {
        return $this->flags;
    }

    public function setCflags(int $cflags): static
    {
        $this->cflags = $cflags;

        return $this;
    }

    public function getCflags(): ?int
    {
        return $this->cflags;
    }

    public function setUserAgent(string $userAgent): static
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    public function setSocket(?string $socket): static
    {
        $this->socket = $socket;

        return $this;
    }

    public function getSocket(): ?string
    {
        return $this->socket;
    }

    public function setMethods(?int $methods): static
    {
        $this->methods = $methods;

        return $this;
    }

    public function getMethods(): ?int
    {
        return $this->methods;
    }

    public function setInstance(?string $instance): static
    {
        $this->instance = $instance;

        return $this;
    }

    public function getInstance(): ?string
    {
        return $this->instance;
    }

    public function setRegId(int $regId): static
    {
        $this->regId = $regId;

        return $this;
    }

    public function getRegId(): ?int
    {
        return $this->regId;
    }

    public function setServerId(int $serverId): static
    {
        $this->serverId = $serverId;

        return $this;
    }

    public function getServerId(): ?int
    {
        return $this->serverId;
    }

    public function setConnectionId(int $connectionId): static
    {
        $this->connectionId = $connectionId;

        return $this;
    }

    public function getConnectionId(): ?int
    {
        return $this->connectionId;
    }

    public function setKeepalive(int $keepalive): static
    {
        $this->keepalive = $keepalive;

        return $this;
    }

    public function getKeepalive(): ?int
    {
        return $this->keepalive;
    }

    public function setPartition(int $partition): static
    {
        $this->partition = $partition;

        return $this;
    }

    public function getPartition(): ?int
    {
        return $this->partition;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }
}
