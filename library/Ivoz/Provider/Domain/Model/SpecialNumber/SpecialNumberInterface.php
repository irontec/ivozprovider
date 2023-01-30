<?php

namespace Ivoz\Provider\Domain\Model\SpecialNumber;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;

/**
* SpecialNumberInterface
*/
interface SpecialNumberInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): SpecialNumberDto;

    /**
     * @internal use EntityTools instead
     * @param null|SpecialNumberInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?SpecialNumberDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param SpecialNumberDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): SpecialNumberDto;

    public function getNumber(): string;

    public function getNumberE164(): ?string;

    public function getDisableCDR(): int;

    public function getBrand(): ?BrandInterface;

    public function getCountry(): CountryInterface;
}
