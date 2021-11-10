<?php

namespace Ivoz\Kam\Domain\Model\UsersXcap;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* UsersXcapInterface
*/
interface UsersXcapInterface extends EntityInterface
{
    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): UsersXcapDto;

    /**
     * @internal use EntityTools instead
     * @param null|UsersXcapInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UsersXcapDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersXcapDto;

    public function getUsername(): string;

    public function getDomain(): string;

    public function getDoc(): string;

    public function getDocType(): int;

    public function getEtag(): string;

    public function getSource(): int;

    public function getDocUri(): string;

    public function getPort(): int;

    public function isInitialized(): bool;
}
