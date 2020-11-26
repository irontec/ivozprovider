<?php

namespace Ivoz\Provider\Domain\Model\PickUpRelUser;

use Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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

    /**
     * Set pickUpGroup
     *
     * @param PickUpGroupInterface | null
     *
     * @return static
     */
    public function setPickUpGroup(?PickUpGroupInterface $pickUpGroup = null): PickUpRelUserInterface;

    /**
     * Get pickUpGroup
     *
     * @return PickUpGroupInterface | null
     */
    public function getPickUpGroup(): ?PickUpGroupInterface;

    /**
     * Set user
     *
     * @param UserInterface | null
     *
     * @return static
     */
    public function setUser(?UserInterface $user = null): PickUpRelUserInterface;

    /**
     * Get user
     *
     * @return UserInterface | null
     */
    public function getUser(): ?UserInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
