<?php

namespace Ivoz\Provider\Domain\Model\PickUpRelUser;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

/**
* PickUpRelUserInterface
*/
interface PickUpRelUserInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function setPickUpGroup(?PickUpGroupInterface $pickUpGroup = null): static;

    public function getPickUpGroup(): ?PickUpGroupInterface;

    public function setUser(?UserInterface $user = null): static;

    public function getUser(): ?UserInterface;

    public function isInitialized(): bool;
}
