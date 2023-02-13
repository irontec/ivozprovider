<?php

namespace Ivoz\Provider\Domain\Model\Service;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;

/**
* ServiceInterface
*/
interface ServiceInterface extends LoggableEntityInterface
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

    /**
     * {@inheritDoc}
     */
    public function setDefaultCode(string $defaultCode): static;

    public static function createDto(string|int|null $id = null): ServiceDto;

    /**
     * @internal use EntityTools instead
     * @param null|ServiceInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ServiceDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ServiceDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ServiceDto;

    public function getIden(): string;

    public function getDefaultCode(): string;

    public function getExtraArgs(): bool;

    public function getName(): Name;

    public function getDescription(): Description;
}
