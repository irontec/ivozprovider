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
     * @deprecated
     * Set presentityUri
     *
     * @param string $presentityUri
     *
     * @return self
     */
    public function setPresentityUri($presentityUri);

    /**
     * Get presentityUri
     *
     * @return string
     */
    public function getPresentityUri();

    /**
     * @deprecated
     * Set watcherUsername
     *
     * @param string $watcherUsername
     *
     * @return self
     */
    public function setWatcherUsername($watcherUsername);

    /**
     * Get watcherUsername
     *
     * @return string
     */
    public function getWatcherUsername();

    /**
     * @deprecated
     * Set watcherDomain
     *
     * @param string $watcherDomain
     *
     * @return self
     */
    public function setWatcherDomain($watcherDomain);

    /**
     * Get watcherDomain
     *
     * @return string
     */
    public function getWatcherDomain();

    /**
     * @deprecated
     * Set toUser
     *
     * @param string $toUser
     *
     * @return self
     */
    public function setToUser($toUser);

    /**
     * Get toUser
     *
     * @return string
     */
    public function getToUser();

    /**
     * @deprecated
     * Set toDomain
     *
     * @param string $toDomain
     *
     * @return self
     */
    public function setToDomain($toDomain);

    /**
     * Get toDomain
     *
     * @return string
     */
    public function getToDomain();

    /**
     * @deprecated
     * Set event
     *
     * @param string $event
     *
     * @return self
     */
    public function setEvent($event);

    /**
     * Get event
     *
     * @return string
     */
    public function getEvent();

    /**
     * @deprecated
     * Set eventId
     *
     * @param string $eventId
     *
     * @return self
     */
    public function setEventId($eventId = null);

    /**
     * Get eventId
     *
     * @return string
     */
    public function getEventId();

    /**
     * @deprecated
     * Set toTag
     *
     * @param string $toTag
     *
     * @return self
     */
    public function setToTag($toTag);

    /**
     * Get toTag
     *
     * @return string
     */
    public function getToTag();

    /**
     * @deprecated
     * Set fromTag
     *
     * @param string $fromTag
     *
     * @return self
     */
    public function setFromTag($fromTag);

    /**
     * Get fromTag
     *
     * @return string
     */
    public function getFromTag();

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
     * Set localCseq
     *
     * @param integer $localCseq
     *
     * @return self
     */
    public function setLocalCseq($localCseq);

    /**
     * Get localCseq
     *
     * @return integer
     */
    public function getLocalCseq();

    /**
     * @deprecated
     * Set remoteCseq
     *
     * @param integer $remoteCseq
     *
     * @return self
     */
    public function setRemoteCseq($remoteCseq);

    /**
     * Get remoteCseq
     *
     * @return integer
     */
    public function getRemoteCseq();

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
     * Set recordRoute
     *
     * @param string $recordRoute
     *
     * @return self
     */
    public function setRecordRoute($recordRoute = null);

    /**
     * Get recordRoute
     *
     * @return string
     */
    public function getRecordRoute();

    /**
     * @deprecated
     * Set expires
     *
     * @param integer $expires
     *
     * @return self
     */
    public function setExpires($expires);

    /**
     * Get expires
     *
     * @return integer
     */
    public function getExpires();

    /**
     * @deprecated
     * Set status
     *
     * @param integer $status
     *
     * @return self
     */
    public function setStatus($status);

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus();

    /**
     * @deprecated
     * Set reason
     *
     * @param string $reason
     *
     * @return self
     */
    public function setReason($reason = null);

    /**
     * Get reason
     *
     * @return string
     */
    public function getReason();

    /**
     * @deprecated
     * Set version
     *
     * @param integer $version
     *
     * @return self
     */
    public function setVersion($version);

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion();

    /**
     * @deprecated
     * Set socketInfo
     *
     * @param string $socketInfo
     *
     * @return self
     */
    public function setSocketInfo($socketInfo);

    /**
     * Get socketInfo
     *
     * @return string
     */
    public function getSocketInfo();

    /**
     * @deprecated
     * Set localContact
     *
     * @param string $localContact
     *
     * @return self
     */
    public function setLocalContact($localContact);

    /**
     * Get localContact
     *
     * @return string
     */
    public function getLocalContact();

    /**
     * @deprecated
     * Set fromUser
     *
     * @param string $fromUser
     *
     * @return self
     */
    public function setFromUser($fromUser);

    /**
     * Get fromUser
     *
     * @return string
     */
    public function getFromUser();

    /**
     * @deprecated
     * Set fromDomain
     *
     * @param string $fromDomain
     *
     * @return self
     */
    public function setFromDomain($fromDomain);

    /**
     * Get fromDomain
     *
     * @return string
     */
    public function getFromDomain();

    /**
     * @deprecated
     * Set updated
     *
     * @param integer $updated
     *
     * @return self
     */
    public function setUpdated($updated);

    /**
     * Get updated
     *
     * @return integer
     */
    public function getUpdated();

    /**
     * @deprecated
     * Set updatedWinfo
     *
     * @param integer $updatedWinfo
     *
     * @return self
     */
    public function setUpdatedWinfo($updatedWinfo);

    /**
     * Get updatedWinfo
     *
     * @return integer
     */
    public function getUpdatedWinfo();

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

}

