<?php

namespace Ivoz\Provider\Domain\Model\FriendsPattern;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend
     *
     * @return static
     */
    public function setFriend(\Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend);

    /**
     * Get friend
     *
     * @return \Ivoz\Provider\Domain\Model\Friend\FriendInterface
     */
    public function getFriend();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
