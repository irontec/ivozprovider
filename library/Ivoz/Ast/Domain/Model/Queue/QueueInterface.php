<?php

namespace Ivoz\Ast\Domain\Model\Queue;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* QueueInterface
*/
interface QueueInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return int
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): QueueDto;

    /**
     * @internal use EntityTools instead
     * @param null|QueueInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?QueueDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): QueueDto;

    public function getName(): string;

    public function getPeriodicAnnounce(): ?string;

    public function getPeriodicAnnounceFrequency(): ?int;

    public function getTimeout(): ?int;

    public function getAutopause(): string;

    public function getRinginuse(): string;

    public function getWrapuptime(): ?int;

    public function getMaxlen(): ?int;

    public function getStrategy(): ?string;

    public function getWeight(): ?int;

    public function getQueue(): \Ivoz\Provider\Domain\Model\Queue\QueueInterface;

    public function isInitialized(): bool;
}
