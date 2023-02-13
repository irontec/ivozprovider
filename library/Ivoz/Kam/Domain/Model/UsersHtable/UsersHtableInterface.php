<?php

namespace Ivoz\Kam\Domain\Model\UsersHtable;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;

/**
* UsersHtableInterface
*/
interface UsersHtableInterface extends EntityInterface
{
    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): UsersHtableDto;

    /**
     * @internal use EntityTools instead
     * @param null|UsersHtableInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UsersHtableDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersHtableDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersHtableDto;

    public function getKeyName(): string;

    public function getKeyType(): int;

    public function getValueType(): int;

    public function getKeyValue(): string;

    public function getExpires(): int;
}
