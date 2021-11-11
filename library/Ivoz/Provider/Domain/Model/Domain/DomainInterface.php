<?php

namespace Ivoz\Provider\Domain\Model\Domain;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): DomainDto;

    /**
     * @internal use EntityTools instead
     * @param null|DomainInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?DomainDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DomainDto;

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
