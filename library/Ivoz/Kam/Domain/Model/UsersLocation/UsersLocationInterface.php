<?php

namespace Ivoz\Kam\Domain\Model\UsersLocation;

use Ivoz\Core\Domain\Model\EntityInterface;

/**
* UsersLocationInterface
*/
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
    public function getDomain(): ?string;

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
    public function getReceived(): ?string;

    /**
     * Get path
     *
     * @return string | null
     */
    public function getPath(): ?string;

    /**
     * Get expires
     *
     * @return \DateTimeInterface
     */
    public function getExpires(): \DateTimeInterface;

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
     * @return int
     */
    public function getCseq(): int;

    /**
     * Get lastModified
     *
     * @return \DateTimeInterface
     */
    public function getLastModified(): \DateTimeInterface;

    /**
     * Get flags
     *
     * @return int
     */
    public function getFlags(): int;

    /**
     * Get cflags
     *
     * @return int
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
    public function getSocket(): ?string;

    /**
     * Get methods
     *
     * @return int | null
     */
    public function getMethods(): ?int;

    /**
     * Get instance
     *
     * @return string | null
     */
    public function getInstance(): ?string;

    /**
     * Get regId
     *
     * @return int
     */
    public function getRegId(): int;

    /**
     * Get serverId
     *
     * @return int
     */
    public function getServerId(): int;

    /**
     * Get connectionId
     *
     * @return int
     */
    public function getConnectionId(): int;

    /**
     * Get keepalive
     *
     * @return int
     */
    public function getKeepalive(): int;

    /**
     * Get partition
     *
     * @return int
     */
    public function getPartition(): int;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
