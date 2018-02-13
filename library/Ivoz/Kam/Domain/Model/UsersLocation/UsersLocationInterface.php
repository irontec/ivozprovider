<?php

namespace Ivoz\Kam\Domain\Model\UsersLocation;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface UsersLocationInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set ruid
     *
     * @param string $ruid
     *
     * @return self
     */
    public function setRuid($ruid);

    /**
     * Get ruid
     *
     * @return string
     */
    public function getRuid();

    /**
     * Set username
     *
     * @param string $username
     *
     * @return self
     */
    public function setUsername($username);

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername();

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return self
     */
    public function setDomain($domain = null);

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain();

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return self
     */
    public function setContact($contact);

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact();

    /**
     * Set received
     *
     * @param string $received
     *
     * @return self
     */
    public function setReceived($received = null);

    /**
     * Get received
     *
     * @return string
     */
    public function getReceived();

    /**
     * Set path
     *
     * @param string $path
     *
     * @return self
     */
    public function setPath($path = null);

    /**
     * Get path
     *
     * @return string
     */
    public function getPath();

    /**
     * Set expires
     *
     * @param \DateTime $expires
     *
     * @return self
     */
    public function setExpires($expires);

    /**
     * Get expires
     *
     * @return \DateTime
     */
    public function getExpires();

    /**
     * Set q
     *
     * @param float $q
     *
     * @return self
     */
    public function setQ($q);

    /**
     * Get q
     *
     * @return float
     */
    public function getQ();

    /**
     * Set callid
     *
     * @param string $callid
     *
     * @return self
     */
    public function setCallid($callid);

    /**
     * Get callid
     *
     * @return string
     */
    public function getCallid();

    /**
     * Set cseq
     *
     * @param integer $cseq
     *
     * @return self
     */
    public function setCseq($cseq);

    /**
     * Get cseq
     *
     * @return integer
     */
    public function getCseq();

    /**
     * Set lastModified
     *
     * @param \DateTime $lastModified
     *
     * @return self
     */
    public function setLastModified($lastModified);

    /**
     * Get lastModified
     *
     * @return \DateTime
     */
    public function getLastModified();

    /**
     * Set flags
     *
     * @param integer $flags
     *
     * @return self
     */
    public function setFlags($flags);

    /**
     * Get flags
     *
     * @return integer
     */
    public function getFlags();

    /**
     * Set cflags
     *
     * @param integer $cflags
     *
     * @return self
     */
    public function setCflags($cflags);

    /**
     * Get cflags
     *
     * @return integer
     */
    public function getCflags();

    /**
     * Set userAgent
     *
     * @param string $userAgent
     *
     * @return self
     */
    public function setUserAgent($userAgent);

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent();

    /**
     * Set socket
     *
     * @param string $socket
     *
     * @return self
     */
    public function setSocket($socket = null);

    /**
     * Get socket
     *
     * @return string
     */
    public function getSocket();

    /**
     * Set methods
     *
     * @param integer $methods
     *
     * @return self
     */
    public function setMethods($methods = null);

    /**
     * Get methods
     *
     * @return integer
     */
    public function getMethods();

    /**
     * Set instance
     *
     * @param string $instance
     *
     * @return self
     */
    public function setInstance($instance = null);

    /**
     * Get instance
     *
     * @return string
     */
    public function getInstance();

    /**
     * Set regId
     *
     * @param integer $regId
     *
     * @return self
     */
    public function setRegId($regId);

    /**
     * Get regId
     *
     * @return integer
     */
    public function getRegId();

    /**
     * Set serverId
     *
     * @param integer $serverId
     *
     * @return self
     */
    public function setServerId($serverId);

    /**
     * Get serverId
     *
     * @return integer
     */
    public function getServerId();

    /**
     * Set connectionId
     *
     * @param integer $connectionId
     *
     * @return self
     */
    public function setConnectionId($connectionId);

    /**
     * Get connectionId
     *
     * @return integer
     */
    public function getConnectionId();

    /**
     * Set keepalive
     *
     * @param integer $keepalive
     *
     * @return self
     */
    public function setKeepalive($keepalive);

    /**
     * Get keepalive
     *
     * @return integer
     */
    public function getKeepalive();

    /**
     * Set partition
     *
     * @param integer $partition
     *
     * @return self
     */
    public function setPartition($partition);

    /**
     * Get partition
     *
     * @return integer
     */
    public function getPartition();

}

