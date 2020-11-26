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
     * @var string | null
     */
    private $domain;

    /**
     * @var string
     */
    private $contact = '';

    /**
     * @var string | null
     */
    private $received;

    /**
     * @var string | null
     */
    private $path;

    /**
     * @var \DateTimeInterface
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
     * @var \DateTimeInterface
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
     * @var string | null
     */
    private $socket;

    /**
     * @var int | null
     */
    private $methods;

    /**
     * @var string | null
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
    public static function getPropertyMap(string $context = '', string $role = null)
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
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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

    /**
     * @param string $ruid | null
     *
     * @return static
     */
    public function setRuid(?string $ruid = null): self
    {
        $this->ruid = $ruid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRuid(): ?string
    {
        return $this->ruid;
    }

    /**
     * @param string $username | null
     *
     * @return static
     */
    public function setUsername(?string $username = null): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $domain | null
     *
     * @return static
     */
    public function setDomain(?string $domain = null): self
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @param string $contact | null
     *
     * @return static
     */
    public function setContact(?string $contact = null): self
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getContact(): ?string
    {
        return $this->contact;
    }

    /**
     * @param string $received | null
     *
     * @return static
     */
    public function setReceived(?string $received = null): self
    {
        $this->received = $received;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getReceived(): ?string
    {
        return $this->received;
    }

    /**
     * @param string $path | null
     *
     * @return static
     */
    public function setPath(?string $path = null): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param \DateTimeInterface $expires | null
     *
     * @return static
     */
    public function setExpires($expires = null): self
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * @param float $q | null
     *
     * @return static
     */
    public function setQ(?float $q = null): self
    {
        $this->q = $q;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getQ(): ?float
    {
        return $this->q;
    }

    /**
     * @param string $callid | null
     *
     * @return static
     */
    public function setCallid(?string $callid = null): self
    {
        $this->callid = $callid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCallid(): ?string
    {
        return $this->callid;
    }

    /**
     * @param int $cseq | null
     *
     * @return static
     */
    public function setCseq(?int $cseq = null): self
    {
        $this->cseq = $cseq;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getCseq(): ?int
    {
        return $this->cseq;
    }

    /**
     * @param \DateTimeInterface $lastModified | null
     *
     * @return static
     */
    public function setLastModified($lastModified = null): self
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @param int $flags | null
     *
     * @return static
     */
    public function setFlags(?int $flags = null): self
    {
        $this->flags = $flags;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getFlags(): ?int
    {
        return $this->flags;
    }

    /**
     * @param int $cflags | null
     *
     * @return static
     */
    public function setCflags(?int $cflags = null): self
    {
        $this->cflags = $cflags;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getCflags(): ?int
    {
        return $this->cflags;
    }

    /**
     * @param string $userAgent | null
     *
     * @return static
     */
    public function setUserAgent(?string $userAgent = null): self
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    /**
     * @param string $socket | null
     *
     * @return static
     */
    public function setSocket(?string $socket = null): self
    {
        $this->socket = $socket;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSocket(): ?string
    {
        return $this->socket;
    }

    /**
     * @param int $methods | null
     *
     * @return static
     */
    public function setMethods(?int $methods = null): self
    {
        $this->methods = $methods;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getMethods(): ?int
    {
        return $this->methods;
    }

    /**
     * @param string $instance | null
     *
     * @return static
     */
    public function setInstance(?string $instance = null): self
    {
        $this->instance = $instance;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getInstance(): ?string
    {
        return $this->instance;
    }

    /**
     * @param int $regId | null
     *
     * @return static
     */
    public function setRegId(?int $regId = null): self
    {
        $this->regId = $regId;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getRegId(): ?int
    {
        return $this->regId;
    }

    /**
     * @param int $serverId | null
     *
     * @return static
     */
    public function setServerId(?int $serverId = null): self
    {
        $this->serverId = $serverId;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getServerId(): ?int
    {
        return $this->serverId;
    }

    /**
     * @param int $connectionId | null
     *
     * @return static
     */
    public function setConnectionId(?int $connectionId = null): self
    {
        $this->connectionId = $connectionId;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getConnectionId(): ?int
    {
        return $this->connectionId;
    }

    /**
     * @param int $keepalive | null
     *
     * @return static
     */
    public function setKeepalive(?int $keepalive = null): self
    {
        $this->keepalive = $keepalive;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getKeepalive(): ?int
    {
        return $this->keepalive;
    }

    /**
     * @param int $partition | null
     *
     * @return static
     */
    public function setPartition(?int $partition = null): self
    {
        $this->partition = $partition;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPartition(): ?int
    {
        return $this->partition;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

}
