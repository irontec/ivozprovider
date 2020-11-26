<?php

namespace Ivoz\Kam\Domain\Model\UsersWatcher;

use Ivoz\Core\Domain\Model\EntityInterface;

/**
* UsersWatcherInterface
*/
interface UsersWatcherInterface extends EntityInterface
{
    /**
     * Get presentityUri
     *
     * @return string
     */
    public function getPresentityUri(): string;

    /**
     * Get watcherUsername
     *
     * @return string
     */
    public function getWatcherUsername(): string;

    /**
     * Get watcherDomain
     *
     * @return string
     */
    public function getWatcherDomain(): string;

    /**
     * Get event
     *
     * @return string
     */
    public function getEvent(): string;

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus(): int;

    /**
     * Get reason
     *
     * @return string | null
     */
    public function getReason(): ?string;

    /**
     * Get insertedTime
     *
     * @return int
     */
    public function getInsertedTime(): int;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
