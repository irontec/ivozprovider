<?php

namespace Ivoz\Provider\Domain\Model\FixedCost;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

/**
* FixedCostInterface
*/
interface FixedCostInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): FixedCostDto;

    /**
     * @internal use EntityTools instead
     * @param null|FixedCostInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?FixedCostDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): FixedCostDto;

    public function getName(): string;

    public function getDescription(): ?string;

    public function getCost(): ?float;

    public function getBrand(): BrandInterface;

    public function isInitialized(): bool;
}
