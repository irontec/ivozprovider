<?php

namespace Ivoz\Provider\Domain\Model\PickUpRelUser;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

/**
* PickUpRelUserInterface
*/
interface PickUpRelUserInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): PickUpRelUserDto;

    /**
     * @internal use EntityTools instead
     * @param null|PickUpRelUserInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?PickUpRelUserDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param PickUpRelUserDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): PickUpRelUserDto;

    public function setPickUpGroup(?PickUpGroupInterface $pickUpGroup = null): static;

    public function getPickUpGroup(): ?PickUpGroupInterface;

    public function setUser(?UserInterface $user = null): static;

    public function getUser(): ?UserInterface;

    public function isInitialized(): bool;
}
