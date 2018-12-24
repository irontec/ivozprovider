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
     * Get presUri
     *
     * @return string
     */
    public function getPresUri();

    /**
     * Get presId
     *
     * @return string
     */
    public function getPresId();

    /**
     * Get event
     *
     * @return integer
     */
    public function getEvent();

    /**
     * Get expires
     *
     * @return integer
     */
    public function getExpires();

    /**
     * Get desiredExpires
     *
     * @return integer
     */
    public function getDesiredExpires();

    /**
     * Get flag
     *
     * @return integer
     */
    public function getFlag();

    /**
     * Get etag
     *
     * @return string
     */
    public function getEtag();

    /**
     * Get tupleId
     *
     * @return string | null
     */
    public function getTupleId();

    /**
     * Get watcherUri
     *
     * @return string
     */
    public function getWatcherUri();

    /**
     * Get callId
     *
     * @return string
     */
    public function getCallId();

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
     * Get cseq
     *
     * @return integer
     */
    public function getCseq();

    /**
     * Get recordRoute
     *
     * @return string | null
     */
    public function getRecordRoute();

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact();

    /**
     * Get remoteContact
     *
     * @return string
     */
    public function getRemoteContact();

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion();

    /**
     * Get extraHeaders
     *
     * @return string
     */
    public function getExtraHeaders();
}
