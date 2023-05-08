<?php

namespace Ivoz\Provider\Domain\Model\Corporation;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

/**
* CorporationInterface
*/
interface CorporationInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): string|int|null;

    public static function createDto(string|int|null $id = null): CorporationDto;

    /**
     * @internal use EntityTools instead
     * @param null|CorporationInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CorporationDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CorporationDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CorporationDto;

    public function getName(): string;

    public function getDescription(): ?string;

    public function getBrand(): ?BrandInterface;
}
