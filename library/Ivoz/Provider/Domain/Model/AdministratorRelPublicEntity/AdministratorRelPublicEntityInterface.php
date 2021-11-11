<?php

namespace Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\PublicEntity\PublicEntityInterface;

/**
* AdministratorRelPublicEntityInterface
*/
interface AdministratorRelPublicEntityInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): AdministratorRelPublicEntityDto;

    /**
     * @internal use EntityTools instead
     * @param null|AdministratorRelPublicEntityInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?AdministratorRelPublicEntityDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): AdministratorRelPublicEntityDto;

    public function getCreate(): bool;

    public function getRead(): bool;

    public function getUpdate(): bool;

    public function getDelete(): bool;

    public function setAdministrator(AdministratorInterface $administrator): static;

    public function getAdministrator(): AdministratorInterface;

    public function getPublicEntity(): PublicEntityInterface;

    public function isInitialized(): bool;
}
