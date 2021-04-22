<?php

namespace Ivoz\Provider\Domain\Model\FriendsPattern;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;

/**
* FriendsPatternInterface
*/
interface FriendsPatternInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function getName(): string;

    public function getRegExp(): string;

    public function setFriend(FriendInterface $friend): static;

    public function getFriend(): FriendInterface;

    public function isInitialized(): bool;
}
