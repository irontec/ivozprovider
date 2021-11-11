<?php

namespace Ivoz\Kam\Domain\Model\UsersPua;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* UsersPuaInterface
*/
interface UsersPuaInterface extends EntityInterface
{
    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): UsersPuaDto;

    /**
     * @internal use EntityTools instead
     * @param null|UsersPuaInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UsersPuaDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersPuaDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersPuaDto;

    public function getPresUri(): string;

    public function getPresId(): string;

    public function getEvent(): int;

    public function getExpires(): int;

    public function getDesiredExpires(): int;

    public function getFlag(): int;

    public function getEtag(): string;

    public function getTupleId(): ?string;

    public function getWatcherUri(): string;

    public function getCallId(): string;

    public function getToTag(): string;

    public function getFromTag(): string;

    public function getCseq(): int;

    public function getRecordRoute(): ?string;

    public function getContact(): string;

    public function getRemoteContact(): string;

    public function getVersion(): int;

    public function getExtraHeaders(): string;

    public function isInitialized(): bool;
}
