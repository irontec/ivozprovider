<?php

namespace Ivoz\Provider\Domain\Model\MediaRelaySetsRelBrand;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;

/**
* MediaRelaySetsRelBrandInterface
*/
interface MediaRelaySetsRelBrandInterface extends LoggableEntityInterface
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
    public static function createDto($id = null): MediaRelaySetsRelBrandDto;

    /**
     * @internal use EntityTools instead
     * @param null|MediaRelaySetsRelBrandInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?MediaRelaySetsRelBrandDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param MediaRelaySetsRelBrandDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): MediaRelaySetsRelBrandDto;

    public function setBrand(?BrandInterface $brand = null): static;

    public function getBrand(): ?BrandInterface;

    public function getMediaRelaySet(): MediaRelaySetInterface;
}
