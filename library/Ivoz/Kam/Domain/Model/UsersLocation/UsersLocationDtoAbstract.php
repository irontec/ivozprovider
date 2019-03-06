<?php

namespace Ivoz\Kam\Domain\Model\UsersLocation;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class UsersLocationDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $ruid = '';

    /**
     * @var string
     */
    private $username = '';

    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    private $contact = '';

    /**
     * @var string
     */
    private $received;

    /**
     * @var string
     */
    private $path;

    /**
     * @var \DateTime
     */
    private $expires = '2030-05-28 21:32:15';

    /**
     * @var float
     */
    private $q = 1.0;

    /**
     * @var string
     */
    private $callid = 'Default-Call-ID';

    /**
     * @var integer
     */
    private $cseq = 1;

    /**
     * @var \DateTime
     */
    private $lastModified = '1900-01-01 00:00:01';

    /**
     * @var integer
     */
    private $flags = 0;

    /**
     * @var integer
     */
    private $cflags = 0;

    /**
     * @var string
     */
    private $userAgent = '';

    /**
     * @var string
     */
    private $socket;

    /**
     * @var integer
     */
    private $methods;

    /**
     * @var string
     */
    private $instance;

    /**
     * @var integer
     */
    private $regId = 0;

    /**
     * @var integer
     */
    private $serverId = 0;

    /**
     * @var integer
     */
    private $connectionId = 0;

    /**
     * @var integer
     */
    private $keepalive = 0;

    /**
     * @var integer
     */
    private $partition = 0;

    /**
     * @var integer
     */
    private $id;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
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
        return [
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
    }

    /**
     * @param string $ruid
     *
     * @return static
     */
    public function setRuid($ruid = null)
    {
        $this->ruid = $ruid;

        return $this;
    }

    /**
     * @return string
     */
    public function getRuid()
    {
        return $this->ruid;
    }

    /**
     * @param string $username
     *
     * @return static
     */
    public function setUsername($username = null)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $domain
     *
     * @return static
     */
    public function setDomain($domain = null)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $contact
     *
     * @return static
     */
    public function setContact($contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param string $received
     *
     * @return static
     */
    public function setReceived($received = null)
    {
        $this->received = $received;

        return $this;
    }

    /**
     * @return string
     */
    public function getReceived()
    {
        return $this->received;
    }

    /**
     * @param string $path
     *
     * @return static
     */
    public function setPath($path = null)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param \DateTime $expires
     *
     * @return static
     */
    public function setExpires($expires = null)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * @param float $q
     *
     * @return static
     */
    public function setQ($q = null)
    {
        $this->q = $q;

        return $this;
    }

    /**
     * @return float
     */
    public function getQ()
    {
        return $this->q;
    }

    /**
     * @param string $callid
     *
     * @return static
     */
    public function setCallid($callid = null)
    {
        $this->callid = $callid;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallid()
    {
        return $this->callid;
    }

    /**
     * @param integer $cseq
     *
     * @return static
     */
    public function setCseq($cseq = null)
    {
        $this->cseq = $cseq;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCseq()
    {
        return $this->cseq;
    }

    /**
     * @param \DateTime $lastModified
     *
     * @return static
     */
    public function setLastModified($lastModified = null)
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @param integer $flags
     *
     * @return static
     */
    public function setFlags($flags = null)
    {
        $this->flags = $flags;

        return $this;
    }

    /**
     * @return integer
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * @param integer $cflags
     *
     * @return static
     */
    public function setCflags($cflags = null)
    {
        $this->cflags = $cflags;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCflags()
    {
        return $this->cflags;
    }

    /**
     * @param string $userAgent
     *
     * @return static
     */
    public function setUserAgent($userAgent = null)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param string $socket
     *
     * @return static
     */
    public function setSocket($socket = null)
    {
        $this->socket = $socket;

        return $this;
    }

    /**
     * @return string
     */
    public function getSocket()
    {
        return $this->socket;
    }

    /**
     * @param integer $methods
     *
     * @return static
     */
    public function setMethods($methods = null)
    {
        $this->methods = $methods;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @param string $instance
     *
     * @return static
     */
    public function setInstance($instance = null)
    {
        $this->instance = $instance;

        return $this;
    }

    /**
     * @return string
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * @param integer $regId
     *
     * @return static
     */
    public function setRegId($regId = null)
    {
        $this->regId = $regId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getRegId()
    {
        return $this->regId;
    }

    /**
     * @param integer $serverId
     *
     * @return static
     */
    public function setServerId($serverId = null)
    {
        $this->serverId = $serverId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getServerId()
    {
        return $this->serverId;
    }

    /**
     * @param integer $connectionId
     *
     * @return static
     */
    public function setConnectionId($connectionId = null)
    {
        $this->connectionId = $connectionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getConnectionId()
    {
        return $this->connectionId;
    }

    /**
     * @param integer $keepalive
     *
     * @return static
     */
    public function setKeepalive($keepalive = null)
    {
        $this->keepalive = $keepalive;

        return $this;
    }

    /**
     * @return integer
     */
    public function getKeepalive()
    {
        return $this->keepalive;
    }

    /**
     * @param integer $partition
     *
     * @return static
     */
    public function setPartition($partition = null)
    {
        $this->partition = $partition;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPartition()
    {
        return $this->partition;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
