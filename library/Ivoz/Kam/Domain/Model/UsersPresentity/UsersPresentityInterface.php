<?php

namespace Ivoz\Kam\Domain\Model\UsersPresentity;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface UsersPresentityInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set username
     *
     * @param string $username
     *
     * @return self
     */
    public function setUsername($username);

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername();

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return self
     */
    public function setDomain($domain);

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain();

    /**
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
     * Set receivedTime
     *
     * @param integer $receivedTime
     *
     * @return self
     */
    public function setReceivedTime($receivedTime);

    /**
     * Get receivedTime
     *
     * @return integer
     */
    public function getReceivedTime();

    /**
     * Set body
     *
     * @param string $body
     *
     * @return self
     */
    public function setBody($body);

    /**
     * Get body
     *
     * @return string
     */
    public function getBody();

    /**
     * Set sender
     *
     * @param string $sender
     *
     * @return self
     */
    public function setSender($sender);

    /**
     * Get sender
     *
     * @return string
     */
    public function getSender();

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return self
     */
    public function setPriority($priority);

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority();

}

