<?php

namespace Ivoz\Provider\Domain\Model\FriendsPattern;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;

/**
* FriendsPatternInterface
*/
interface FriendsPatternInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): FriendsPatternDto;

    /**
     * @internal use EntityTools instead
     * @param null|FriendsPatternInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?FriendsPatternDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): FriendsPatternDto;

    public function getName(): string;

    public function getRegExp(): string;

    public function setFriend(FriendInterface $friend): static;

    public function getFriend(): FriendInterface;

    public function isInitialized(): bool;
}
