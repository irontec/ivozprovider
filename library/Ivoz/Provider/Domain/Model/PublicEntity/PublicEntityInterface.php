<?php

namespace Ivoz\Provider\Domain\Model\PublicEntity;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* PublicEntityInterface
*/
interface PublicEntityInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): PublicEntityDto;

    /**
     * @internal use EntityTools instead
     * @param null|PublicEntityInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?PublicEntityDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param PublicEntityDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): PublicEntityDto;

    public function getIden(): string;

    public function getFqdn(): ?string;

    public function getPlatform(): bool;

    public function getBrand(): bool;

    public function getClient(): bool;

    public function getName(): Name;

    public function isInitialized(): bool;
}
