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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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

