<?php

namespace Ivoz\Kam\Domain\Model\UsersWatcher;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* UsersWatcherInterface
*/
interface UsersWatcherInterface extends EntityInterface
{
    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): UsersWatcherDto;

    /**
     * @internal use EntityTools instead
     * @param null|UsersWatcherInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UsersWatcherDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersWatcherDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersWatcherDto;

    public function getPresentityUri(): string;

    public function getWatcherUsername(): string;

    public function getWatcherDomain(): string;

    public function getEvent(): string;

    public function getStatus(): int;

    public function getReason(): ?string;

    public function getInsertedTime(): int;

    public function isInitialized(): bool;
}
