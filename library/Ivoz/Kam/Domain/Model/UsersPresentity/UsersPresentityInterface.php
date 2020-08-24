<?php

namespace Ivoz\Kam\Domain\Model\UsersPresentity;

use Ivoz\Core\Domain\Model\EntityInterface;

interface UsersPresentityInterface extends EntityInterface
{
    /**
     * Get username
     *
     * @return string
     */
    public function getUsername(): string;

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain(): string;

    /**
     * Get event
     *
     * @return string
     */
    public function getEvent(): string;

    /**
     * Get etag
     *
     * @return string
     */
    public function getEtag(): string;

    /**
     * Get expires
     *
     * @return integer
     */
    public function getExpires(): int;

    /**
     * Get receivedTime
     *
     * @return integer
     */
    public function getReceivedTime(): int;

    /**
     * Get body
     *
     * @return string
     */
    public function getBody(): string;

    /**
     * Get sender
     *
     * @return string
     */
    public function getSender(): string;

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority(): int;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
