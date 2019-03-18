<?php

namespace Ivoz\Provider\Domain\Model\Domain;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface DomainInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain();

    /**
     * Get pointsTo
     *
     * @return string
     */
    public function getPointsTo();

    /**
     * Get description
     *
     * @return string | null
     */
    public function getDescription();

    /**
     * Add friend
     *
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend
     *
     * @return static
     */
    public function addFriend(\Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend);

    /**
     * Remove friend
     *
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend
     */
    public function removeFriend(\Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend);

    /**
     * Replace friends
     *
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface[] $friends
     * @return static
     */
    public function replaceFriends(Collection $friends);

    /**
     * Get friends
     *
     * @return \Ivoz\Provider\Domain\Model\Friend\FriendInterface[]
     */
    public function getFriends(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add residentialDevice
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice
     *
     * @return static
     */
    public function addResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice);

    /**
     * Remove residentialDevice
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice
     */
    public function removeResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice);

    /**
     * Replace residentialDevices
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface[] $residentialDevices
     * @return static
     */
    public function replaceResidentialDevices(Collection $residentialDevices);

    /**
     * Get residentialDevices
     *
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface[]
     */
    public function getResidentialDevices(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add terminal
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal
     *
     * @return static
     */
    public function addTerminal(\Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal);

    /**
     * Remove terminal
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal
     */
    public function removeTerminal(\Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal);

    /**
     * Replace terminals
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface[] $terminals
     * @return static
     */
    public function replaceTerminals(Collection $terminals);

    /**
     * Get terminals
     *
     * @return \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface[]
     */
    public function getTerminals(\Doctrine\Common\Collections\Criteria $criteria = null);
}
