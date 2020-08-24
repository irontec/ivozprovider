<?php

namespace Ivoz\Kam\Domain\Model\UsersPua;

use Ivoz\Core\Domain\Model\EntityInterface;

interface UsersPuaInterface extends EntityInterface
{
    /**
     * Get presUri
     *
     * @return string
     */
    public function getPresUri(): string;

    /**
     * Get presId
     *
     * @return string
     */
    public function getPresId(): string;

    /**
     * Get event
     *
     * @return integer
     */
    public function getEvent(): int;

    /**
     * Get expires
     *
     * @return integer
     */
    public function getExpires(): int;

    /**
     * Get desiredExpires
     *
     * @return integer
     */
    public function getDesiredExpires(): int;

    /**
     * Get flag
     *
     * @return integer
     */
    public function getFlag(): int;

    /**
     * Get etag
     *
     * @return string
     */
    public function getEtag(): string;

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
    public function getWatcherUri(): string;

    /**
     * Get callId
     *
     * @return string
     */
    public function getCallId(): string;

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
     * Get cseq
     *
     * @return integer
     */
    public function getCseq(): int;

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
    public function getContact(): string;

    /**
     * Get remoteContact
     *
     * @return string
     */
    public function getRemoteContact(): string;

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion(): int;

    /**
     * Get extraHeaders
     *
     * @return string
     */
    public function getExtraHeaders(): string;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
