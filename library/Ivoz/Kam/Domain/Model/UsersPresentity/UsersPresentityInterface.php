<?php

namespace Ivoz\Kam\Domain\Model\UsersPresentity;

use Ivoz\Core\Domain\Model\EntityInterface;

/**
* UsersPresentityInterface
*/
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
     * @return int
     */
    public function getExpires(): int;

    /**
     * Get receivedTime
     *
     * @return int
     */
    public function getReceivedTime(): int;

    /**
     * Get body
     *
     * @return 
     */
    public function getBody();

    /**
     * Get sender
     *
     * @return string
     */
    public function getSender(): string;

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority(): int;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
