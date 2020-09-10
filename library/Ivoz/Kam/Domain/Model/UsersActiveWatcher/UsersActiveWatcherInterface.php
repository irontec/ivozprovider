<?php

namespace Ivoz\Kam\Domain\Model\UsersActiveWatcher;

use Ivoz\Core\Domain\Model\EntityInterface;

interface UsersActiveWatcherInterface extends EntityInterface
{
    /**
     * Get presentityUri
     *
     * @return string
     */
    public function getPresentityUri(): string;

    /**
     * Get watcherUsername
     *
     * @return string
     */
    public function getWatcherUsername(): string;

    /**
     * Get watcherDomain
     *
     * @return string
     */
    public function getWatcherDomain(): string;

    /**
     * Get toUser
     *
     * @return string
     */
    public function getToUser(): string;

    /**
     * Get toDomain
     *
     * @return string
     */
    public function getToDomain(): string;

    /**
     * Get event
     *
     * @return string
     */
    public function getEvent(): string;

    /**
     * Get eventId
     *
     * @return string | null
     */
    public function getEventId();

    /**
     * Get toTag
     *
     * @return string
     */
    public function getToTag(): string;

    /**
     * Get fromTag
     *
     * @return string
     */
    public function getFromTag(): string;

    /**
     * Get callid
     *
     * @return string
     */
    public function getCallid(): string;

    /**
     * Get localCseq
     *
     * @return integer
     */
    public function getLocalCseq(): int;

    /**
     * Get remoteCseq
     *
     * @return integer
     */
    public function getRemoteCseq(): int;

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact(): string;

    /**
     * Get recordRoute
     *
     * @return string | null
     */
    public function getRecordRoute();

    /**
     * Get expires
     *
     * @return integer
     */
    public function getExpires(): int;

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus(): int;

    /**
     * Get reason
     *
     * @return string | null
     */
    public function getReason();

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion(): int;

    /**
     * Get socketInfo
     *
     * @return string
     */
    public function getSocketInfo(): string;

    /**
     * Get localContact
     *
     * @return string
     */
    public function getLocalContact(): string;

    /**
     * Get fromUser
     *
     * @return string
     */
    public function getFromUser(): string;

    /**
     * Get fromDomain
     *
     * @return string
     */
    public function getFromDomain(): string;

    /**
     * Get updated
     *
     * @return integer
     */
    public function getUpdated(): int;

    /**
     * Get updatedWinfo
     *
     * @return integer
     */
    public function getUpdatedWinfo(): int;

    /**
     * Get flags
     *
     * @return integer
     */
    public function getFlags(): int;

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent(): string;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
