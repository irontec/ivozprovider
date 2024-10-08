<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServerSetsRelBrand;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSetInterface;

/**
* ApplicationServerSetsRelBrandInterface
*/
interface ApplicationServerSetsRelBrandInterface extends LoggableEntityInterface
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
    public function getId(): ?int;

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): ApplicationServerSetsRelBrandDto;

    /**
     * @internal use EntityTools instead
     * @param null|ApplicationServerSetsRelBrandInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ApplicationServerSetsRelBrandDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ApplicationServerSetsRelBrandDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ApplicationServerSetsRelBrandDto;

    public function setBrand(?BrandInterface $brand = null): static;

    public function getBrand(): ?BrandInterface;

    public function getApplicationServerSet(): ApplicationServerSetInterface;
}
