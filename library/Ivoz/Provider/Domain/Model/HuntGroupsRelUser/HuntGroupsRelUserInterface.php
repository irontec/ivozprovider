<?php

namespace Ivoz\Provider\Domain\Model\HuntGroupsRelUser;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface HuntGroupsRelUserInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get timeoutTime
     *
     * @return integer | null
     */
    public function getTimeoutTime();

    /**
     * Get priority
     *
     * @return integer | null
     */
    public function getPriority();

    /**
     * Set huntGroup
     *
     * @param \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntGroup | null
     *
     * @return static
     */
    public function setHuntGroup(\Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntGroup = null);

    /**
     * Get huntGroup
     *
     * @return \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface | null
     */
    public function getHuntGroup();

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getUser();
}
