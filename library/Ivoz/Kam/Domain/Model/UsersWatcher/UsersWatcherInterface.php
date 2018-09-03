<?php

namespace Ivoz\Kam\Domain\Model\UsersWatcher;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface UsersWatcherInterface extends LoggableEntityInterface
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
     * Set insertedTime
     *
     * @param integer $insertedTime
     *
     * @return self
     */
    public function setInsertedTime($insertedTime);

    /**
     * Get insertedTime
     *
     * @return integer
     */
    public function getInsertedTime();
}
