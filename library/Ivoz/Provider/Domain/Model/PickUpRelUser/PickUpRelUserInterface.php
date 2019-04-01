<?php

namespace Ivoz\Provider\Domain\Model\PickUpRelUser;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
     * @param \Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface $pickUpGroup
     *
     * @return static
     */
    public function setPickUpGroup(\Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface $pickUpGroup = null);

    /**
     * Get pickUpGroup
     *
     * @return \Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface
     */
    public function getPickUpGroup();

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     *
     * @return static
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user = null);

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getUser();
}
