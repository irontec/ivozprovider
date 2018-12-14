<?php

namespace Ivoz\Kam\Domain\Model\UsersActiveWatcher;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface UsersActiveWatcherInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get presentityUri
     *
     * @return string
     */
    public function getPresentityUri();

    /**
     * Get watcherUsername
     *
     * @return string
     */
    public function getWatcherUsername();

    /**
     * Get watcherDomain
     *
     * @return string
     */
    public function getWatcherDomain();

    /**
     * Get toUser
     *
     * @return string
     */
    public function getToUser();

    /**
     * Get toDomain
     *
     * @return string
     */
    public function getToDomain();

    /**
     * Get event
     *
     * @return string
     */
    public function getEvent();

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
    public function getToTag();

    /**
     * Get fromTag
     *
     * @return string
     */
    public function getFromTag();

    /**
     * Get callid
     *
     * @return string
     */
    public function getCallid();

    /**
     * Get localCseq
     *
     * @return integer
     */
    public function getLocalCseq();

    /**
     * Get remoteCseq
     *
     * @return integer
     */
    public function getRemoteCseq();

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact();

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
    public function getExpires();

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus();

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
    public function getVersion();

    /**
     * Get socketInfo
     *
     * @return string
     */
    public function getSocketInfo();

    /**
     * Get localContact
     *
     * @return string
     */
    public function getLocalContact();

    /**
     * Get fromUser
     *
     * @return string
     */
    public function getFromUser();

    /**
     * Get fromDomain
     *
     * @return string
     */
    public function getFromDomain();

    /**
     * Get updated
     *
     * @return integer
     */
    public function getUpdated();

    /**
     * Get updatedWinfo
     *
     * @return integer
     */
    public function getUpdatedWinfo();

    /**
     * Get flags
     *
     * @return integer
     */
    public function getFlags();

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent();
}
