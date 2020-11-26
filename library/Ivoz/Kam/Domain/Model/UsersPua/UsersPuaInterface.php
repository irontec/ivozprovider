<?php

namespace Ivoz\Kam\Domain\Model\UsersPua;

use Ivoz\Core\Domain\Model\EntityInterface;

/**
* UsersPuaInterface
*/
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
     * @return int
     */
    public function getEvent(): int;

    /**
     * Get expires
     *
     * @return int
     */
    public function getExpires(): int;

    /**
     * Get desiredExpires
     *
     * @return int
     */
    public function getDesiredExpires(): int;

    /**
     * Get flag
     *
     * @return int
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
    public function getTupleId(): ?string;

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
     * @return int
     */
    public function getCseq(): int;

    /**
     * Get recordRoute
     *
     * @return string | null
     */
    public function getRecordRoute(): ?string;

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
     * @return int
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
