<?php

namespace Ivoz\Provider\Domain\Model\QueueMember;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

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

    public function getPenalty(): ?int;

    public function getQueue(): QueueInterface;

    public function setUser(UserInterface $user): static;

    public function getUser(): UserInterface;

    public function isInitialized(): bool;
}
