<?php

namespace Ivoz\Kam\Domain\Model\UsersLocation;

use Ivoz\Core\Domain\Model\EntityInterface;

interface UsersLocationInterface extends EntityInterface
{
    /**
     * Get ruid
     *
     * @return string
     */
    public function getRuid(): string;

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername(): string;

    /**
     * Get domain
     *
     * @return string | null
     */
    public function getDomain();

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact(): string;

    /**
     * Get received
     *
     * @return string | null
     */
    public function getReceived();

    /**
     * Get path
     *
     * @return string | null
     */
    public function getPath();

    /**
     * Get expires
     *
     * @return \DateTime
     */
    public function getExpires(): \DateTime;

    /**
     * Get q
     *
     * @return float
     */
    public function getQ(): float;

    /**
     * Get callid
     *
     * @return string
     */
    public function getCallid(): string;

    /**
     * Get cseq
     *
     * @return integer
     */
    public function getCseq(): int;

    /**
     * Get lastModified
     *
     * @return \DateTime
     */
    public function getLastModified(): \DateTime;

    /**
     * Get flags
     *
     * @return integer
     */
    public function getFlags(): int;

    /**
     * Get cflags
     *
     * @return integer
     */
    public function getCflags(): int;

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent(): string;

    /**
     * Get socket
     *
     * @return string | null
     */
    public function getSocket();

    /**
     * Get methods
     *
     * @return integer | null
     */
    public function getMethods();

    /**
     * Get instance
     *
     * @return string | null
     */
    public function getInstance();

    /**
     * Get regId
     *
     * @return integer
     */
    public function getRegId(): int;

    /**
     * Get serverId
     *
     * @return integer
     */
    public function getServerId(): int;

    /**
     * Get connectionId
     *
     * @return integer
     */
    public function getConnectionId(): int;

    /**
     * Get keepalive
     *
     * @return integer
     */
    public function getKeepalive(): int;

    /**
     * Get partition
     *
     * @return integer
     */
    public function getPartition(): int;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
