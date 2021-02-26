<?php

namespace Ivoz\Kam\Domain\Model\UsersWatcher;

use Ivoz\Core\Domain\Model\EntityInterface;

/**
* UsersWatcherInterface
*/
interface UsersWatcherInterface extends EntityInterface
{

    public function getPresentityUri(): string;

    public function getWatcherUsername(): string;

    public function getWatcherDomain(): string;

    public function getEvent(): string;

    public function getStatus(): int;

    public function getReason(): ?string;

    public function getInsertedTime(): int;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
