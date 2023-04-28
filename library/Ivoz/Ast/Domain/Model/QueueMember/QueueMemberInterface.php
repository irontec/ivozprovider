<?php

namespace Ivoz\Ast\Domain\Model\QueueMember;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;

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
     */
    public function getId(): string|int|null;

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

    public function getUniqueid(): string;

    public function getQueueName(): string;

    public function getInterface(): string;

    public function getMembername(): string;

    public function getStateInterface(): string;

    public function getPenalty(): int;

    public function getPaused(): int;

    public function getQueueMember(): ?\Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface;
}
