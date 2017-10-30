<?php

namespace Ivoz\Kam\Domain\Model\UsersLocation;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class UsersLocationDTO implements DataTransferObjectInterface
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
    private $q = '1.00';

    /**
     * @var string
     */
    private $callid = 'Default-Call-ID';

    /**
     * @var integer
     */
    private $cseq = '1';

    /**
     * @var \DateTime
     */
    private $lastModified = '1900-01-01 00:00:01';

    /**
     * @var integer
     */
    private $flags = '0';

    /**
     * @var integer
     */
    private $cflags = '0';

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
    private $regId = '0';

    /**
     * @var integer
     */
    private $serverId = '0';

    /**
     * @var integer
     */
    private $connectionId = '0';

    /**
     * @var integer
     */
    private $keepalive = '0';

    /**
     * @var integer
     */
    private $partition = '0';

    /**
     * @var integer
     */
    private $id;

    /**
     * @return array
     */
    public function __toArray()
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
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $ruid
     *
     * @return UsersLocationDTO
     */
    public function setRuid($ruid)
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
     * @return UsersLocationDTO
     */
    public function setUsername($username)
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
     * @return UsersLocationDTO
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
     * @return UsersLocationDTO
     */
    public function setContact($contact)
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
     * @return UsersLocationDTO
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
     * @return UsersLocationDTO
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
     * @return UsersLocationDTO
     */
    public function setExpires($expires)
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
     * @return UsersLocationDTO
     */
    public function setQ($q)
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
     * @return UsersLocationDTO
     */
    public function setCallid($callid)
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
     * @return UsersLocationDTO
     */
    public function setCseq($cseq)
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
     * @return UsersLocationDTO
     */
    public function setLastModified($lastModified)
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
     * @return UsersLocationDTO
     */
    public function setFlags($flags)
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
     * @return UsersLocationDTO
     */
    public function setCflags($cflags)
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
     * @return UsersLocationDTO
     */
    public function setUserAgent($userAgent)
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
     * @return UsersLocationDTO
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
     * @return UsersLocationDTO
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
     * @return UsersLocationDTO
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
     * @return UsersLocationDTO
     */
    public function setRegId($regId)
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
     * @return UsersLocationDTO
     */
    public function setServerId($serverId)
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
     * @return UsersLocationDTO
     */
    public function setConnectionId($connectionId)
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
     * @return UsersLocationDTO
     */
    public function setKeepalive($keepalive)
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
     * @return UsersLocationDTO
     */
    public function setPartition($partition)
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
     * @return UsersLocationDTO
     */
    public function setId($id)
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


