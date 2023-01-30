<?php

namespace Ivoz\Kam\Domain\Model\UsersLocationAttr;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* UsersLocationAttrInterface
*/
interface UsersLocationAttrInterface extends EntityInterface
{
    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): ?string;

    public static function createDto(string|int|null $id = null): UsersLocationAttrDto;

    /**
     * @internal use EntityTools instead
     * @param null|UsersLocationAttrInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UsersLocationAttrDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersLocationAttrDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersLocationAttrDto;

    public function getRuid(): string;

    public function getUsername(): string;

    public function getDomain(): ?string;

    public function getAname(): string;

    public function getAtype(): int;

    public function getAvalue(): string;

    public function getLastModified(): \DateTime;
}
