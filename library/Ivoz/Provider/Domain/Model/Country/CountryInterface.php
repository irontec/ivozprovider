<?php

namespace Ivoz\Provider\Domain\Model\Country;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* CountryInterface
*/
interface CountryInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): CountryDto;

    /**
     * @internal use EntityTools instead
     * @param null|CountryInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CountryDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CountryDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CountryDto;

    public function getCode(): string;

    public function getCountryCode(): ?string;

    public function getName(): Name;

    public function getZone(): Zone;
}
