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
    public function getUsername();

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain();

    /**
     * Get event
     *
     * @return string
     */
    public function getEvent();

    /**
     * Get etag
     *
     * @return string
     */
    public function getEtag();

    /**
     * Get expires
     *
     * @return integer
     */
    public function getExpires();

    /**
     * Get receivedTime
     *
     * @return integer
     */
    public function getReceivedTime();

    /**
     * Get body
     *
     * @return string
     */
    public function getBody();

    /**
     * Get sender
     *
     * @return string
     */
    public function getSender();

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority();
}
