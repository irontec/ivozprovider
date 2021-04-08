<?php

namespace Ivoz\Kam\Domain\Model\UsersActiveWatcher;

use Ivoz\Core\Domain\Model\EntityInterface;

/**
* UsersActiveWatcherInterface
*/
interface UsersActiveWatcherInterface extends EntityInterface
{

    public function getPresentityUri(): string;

    public function getWatcherUsername(): string;

    public function getWatcherDomain(): string;

    public function getToUser(): string;

    public function getToDomain(): string;

    public function getEvent(): string;

    public function getEventId(): ?string;

    public function getToTag(): string;

    public function getFromTag(): string;

    public function getCallid(): string;

    public function getLocalCseq(): int;

    public function getRemoteCseq(): int;

    public function getContact(): string;

    public function getRecordRoute(): ?string;

    public function getExpires(): int;

    public function getStatus(): int;

    public function getReason(): ?string;

    public function getVersion(): int;

    public function getSocketInfo(): string;

    public function getLocalContact(): string;

    public function getFromUser(): string;

    public function getFromDomain(): string;

    public function getUpdated(): int;

    public function getUpdatedWinfo(): int;

    public function getFlags(): int;

    public function getUserAgent(): string;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
