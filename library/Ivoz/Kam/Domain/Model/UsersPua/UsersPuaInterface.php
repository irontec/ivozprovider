<?php

namespace Ivoz\Kam\Domain\Model\UsersPua;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface UsersPuaInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @deprecated
     * Set presUri
     *
     * @param string $presUri
     *
     * @return self
     */
    public function setPresUri($presUri);

    /**
     * Get presUri
     *
     * @return string
     */
    public function getPresUri();

    /**
     * @deprecated
     * Set presId
     *
     * @param string $presId
     *
     * @return self
     */
    public function setPresId($presId);

    /**
     * Get presId
     *
     * @return string
     */
    public function getPresId();

    /**
     * @deprecated
     * Set event
     *
     * @param integer $event
     *
     * @return self
     */
    public function setEvent($event);

    /**
     * Get event
     *
     * @return integer
     */
    public function getEvent();

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
     * Set desiredExpires
     *
     * @param integer $desiredExpires
     *
     * @return self
     */
    public function setDesiredExpires($desiredExpires);

    /**
     * Get desiredExpires
     *
     * @return integer
     */
    public function getDesiredExpires();

    /**
     * @deprecated
     * Set flag
     *
     * @param integer $flag
     *
     * @return self
     */
    public function setFlag($flag);

    /**
     * Get flag
     *
     * @return integer
     */
    public function getFlag();

    /**
     * @deprecated
     * Set etag
     *
     * @param string $etag
     *
     * @return self
     */
    public function setEtag($etag);

    /**
     * Get etag
     *
     * @return string
     */
    public function getEtag();

    /**
     * @deprecated
     * Set tupleId
     *
     * @param string $tupleId
     *
     * @return self
     */
    public function setTupleId($tupleId = null);

    /**
     * Get tupleId
     *
     * @return string
     */
    public function getTupleId();

    /**
     * @deprecated
     * Set watcherUri
     *
     * @param string $watcherUri
     *
     * @return self
     */
    public function setWatcherUri($watcherUri);

    /**
     * Get watcherUri
     *
     * @return string
     */
    public function getWatcherUri();

    /**
     * @deprecated
     * Set callId
     *
     * @param string $callId
     *
     * @return self
     */
    public function setCallId($callId);

    /**
     * Get callId
     *
     * @return string
     */
    public function getCallId();

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
     * Set remoteContact
     *
     * @param string $remoteContact
     *
     * @return self
     */
    public function setRemoteContact($remoteContact);

    /**
     * Get remoteContact
     *
     * @return string
     */
    public function getRemoteContact();

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
     * Set extraHeaders
     *
     * @param string $extraHeaders
     *
     * @return self
     */
    public function setExtraHeaders($extraHeaders);

    /**
     * Get extraHeaders
     *
     * @return string
     */
    public function getExtraHeaders();

}

