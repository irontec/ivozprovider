<?php

namespace Ivoz\Provider\Domain\Model\FriendsPattern;

use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get regExp
     *
     * @return string
     */
    public function getRegExp(): string;

    /**
     * Set friend
     *
     * @param FriendInterface
     *
     * @return static
     */
    public function setFriend(FriendInterface $friend): FriendsPatternInterface;

    /**
     * Get friend
     *
     * @return FriendInterface
     */
    public function getFriend(): FriendInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
