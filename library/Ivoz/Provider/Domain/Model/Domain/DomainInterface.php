<?php

namespace Ivoz\Provider\Domain\Model\Domain;

use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* DomainInterface
*/
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
    public function getDomain(): string;

    /**
     * Get pointsTo
     *
     * @return string
     */
    public function getPointsTo(): string;

    /**
     * Get description
     *
     * @return string | null
     */
    public function getDescription(): ?string;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add friend
     *
     * @param FriendInterface $friend
     *
     * @return static
     */
    public function addFriend(FriendInterface $friend): DomainInterface;

    /**
     * Remove friend
     *
     * @param FriendInterface $friend
     *
     * @return static
     */
    public function removeFriend(FriendInterface $friend): DomainInterface;

    /**
     * Replace friends
     *
     * @param ArrayCollection $friends of FriendInterface
     *
     * @return static
     */
    public function replaceFriends(ArrayCollection $friends): DomainInterface;

    /**
     * Get friends
     * @param Criteria | null $criteria
     * @return FriendInterface[]
     */
    public function getFriends(?Criteria $criteria = null): array;

    /**
     * Add residentialDevice
     *
     * @param ResidentialDeviceInterface $residentialDevice
     *
     * @return static
     */
    public function addResidentialDevice(ResidentialDeviceInterface $residentialDevice): DomainInterface;

    /**
     * Remove residentialDevice
     *
     * @param ResidentialDeviceInterface $residentialDevice
     *
     * @return static
     */
    public function removeResidentialDevice(ResidentialDeviceInterface $residentialDevice): DomainInterface;

    /**
     * Replace residentialDevices
     *
     * @param ArrayCollection $residentialDevices of ResidentialDeviceInterface
     *
     * @return static
     */
    public function replaceResidentialDevices(ArrayCollection $residentialDevices): DomainInterface;

    /**
     * Get residentialDevices
     * @param Criteria | null $criteria
     * @return ResidentialDeviceInterface[]
     */
    public function getResidentialDevices(?Criteria $criteria = null): array;

    /**
     * Add terminal
     *
     * @param TerminalInterface $terminal
     *
     * @return static
     */
    public function addTerminal(TerminalInterface $terminal): DomainInterface;

    /**
     * Remove terminal
     *
     * @param TerminalInterface $terminal
     *
     * @return static
     */
    public function removeTerminal(TerminalInterface $terminal): DomainInterface;

    /**
     * Replace terminals
     *
     * @param ArrayCollection $terminals of TerminalInterface
     *
     * @return static
     */
    public function replaceTerminals(ArrayCollection $terminals): DomainInterface;

    /**
     * Get terminals
     * @param Criteria | null $criteria
     * @return TerminalInterface[]
     */
    public function getTerminals(?Criteria $criteria = null): array;

}
