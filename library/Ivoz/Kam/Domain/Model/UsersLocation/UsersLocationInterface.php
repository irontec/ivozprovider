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
     * Get ruid
     *
     * @return string
     */
    public function getRuid();

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername();

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain();

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact();

    /**
     * Get received
     *
     * @return string
     */
    public function getReceived();

    /**
     * Get path
     *
     * @return string
     */
    public function getPath();

    /**
     * Get expires
     *
     * @return \DateTime
     */
    public function getExpires();

    /**
     * Get q
     *
     * @return float
     */
    public function getQ();

    /**
     * Get callid
     *
     * @return string
     */
    public function getCallid();

    /**
     * Get cseq
     *
     * @return integer
     */
    public function getCseq();

    /**
     * Get lastModified
     *
     * @return \DateTime
     */
    public function getLastModified();

    /**
     * Get flags
     *
     * @return integer
     */
    public function getFlags();

    /**
     * Get cflags
     *
     * @return integer
     */
    public function getCflags();

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent();

    /**
     * Get socket
     *
     * @return string
     */
    public function getSocket();

    /**
     * Get methods
     *
     * @return integer
     */
    public function getMethods();

    /**
     * Get instance
     *
     * @return string
     */
    public function getInstance();

    /**
     * Get regId
     *
     * @return integer
     */
    public function getRegId();

    /**
     * Get serverId
     *
     * @return integer
     */
    public function getServerId();

    /**
     * Get connectionId
     *
     * @return integer
     */
    public function getConnectionId();

    /**
     * Get keepalive
     *
     * @return integer
     */
    public function getKeepalive();

    /**
     * Get partition
     *
     * @return integer
     */
    public function getPartition();
}
