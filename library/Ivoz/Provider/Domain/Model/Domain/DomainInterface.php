<?php

namespace Ivoz\Provider\Domain\Model\Domain;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;

/**
* DomainInterface
*/
interface DomainInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    public function getDomain(): string;

    public function getPointsTo(): string;

    public function getDescription(): ?string;

    public function isInitialized(): bool;

    public function addFriend(FriendInterface $friend): DomainInterface;

    public function removeFriend(FriendInterface $friend): DomainInterface;

    public function replaceFriends(ArrayCollection $friends): DomainInterface;

    public function getFriends(?Criteria $criteria = null): array;

    public function addResidentialDevice(ResidentialDeviceInterface $residentialDevice): DomainInterface;

    public function removeResidentialDevice(ResidentialDeviceInterface $residentialDevice): DomainInterface;

    public function replaceResidentialDevices(ArrayCollection $residentialDevices): DomainInterface;

    public function getResidentialDevices(?Criteria $criteria = null): array;

    public function addTerminal(TerminalInterface $terminal): DomainInterface;

    public function removeTerminal(TerminalInterface $terminal): DomainInterface;

    public function replaceTerminals(ArrayCollection $terminals): DomainInterface;

    public function getTerminals(?Criteria $criteria = null): array;
}
