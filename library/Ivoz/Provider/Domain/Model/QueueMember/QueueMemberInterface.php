<?php

namespace Ivoz\Provider\Domain\Model\QueueMember;

use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* QueueMemberInterface
*/
interface QueueMemberInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get penalty
     *
     * @return int | null
     */
    public function getPenalty(): ?int;

    /**
     * Get queue
     *
     * @return QueueInterface
     */
    public function getQueue(): QueueInterface;

    /**
     * Set user
     *
     * @param UserInterface
     *
     * @return static
     */
    public function setUser(UserInterface $user): QueueMemberInterface;

    /**
     * Get user
     *
     * @return UserInterface
     */
    public function getUser(): UserInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
