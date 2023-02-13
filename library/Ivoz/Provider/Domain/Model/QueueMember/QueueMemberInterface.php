<?php

namespace Ivoz\Provider\Domain\Model\QueueMember;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

/**
* QueueMemberInterface
*/
interface QueueMemberInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): QueueMemberDto;

    /**
     * @internal use EntityTools instead
     * @param null|QueueMemberInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?QueueMemberDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param QueueMemberDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): QueueMemberDto;

    public function getPenalty(): ?int;

    public function getQueue(): QueueInterface;

    public function setUser(UserInterface $user): static;

    public function getUser(): UserInterface;
}
