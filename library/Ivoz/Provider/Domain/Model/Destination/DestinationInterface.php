<?php

namespace Ivoz\Provider\Domain\Model\Destination;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
* DestinationInterface
*/
interface DestinationInterface extends LoggableEntityInterface
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
     * Validate prefix comes in E.164 format
     *
     * @inheritdoc
     */
    public function setPrefix(string $prefix): static;

    /**
     * @return string
     */
    public function getCgrTag(): string;

    public static function createDto(string|int|null $id = null): DestinationDto;

    /**
     * @internal use EntityTools instead
     * @param null|DestinationInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?DestinationDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DestinationDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DestinationDto;

    public function getPrefix(): string;

    public function getName(): Name;

    public function getBrand(): BrandInterface;

    public function setTpDestination(TpDestinationInterface $tpDestination): static;

    public function getTpDestination(): ?TpDestinationInterface;

    public function addDestinationRate(DestinationRateInterface $destinationRate): DestinationInterface;

    public function removeDestinationRate(DestinationRateInterface $destinationRate): DestinationInterface;

    /**
     * @param Collection<array-key, DestinationRateInterface> $destinationRates
     */
    public function replaceDestinationRates(Collection $destinationRates): DestinationInterface;

    /**
     * @return array<array-key, DestinationRateInterface>
     */
    public function getDestinationRates(?Criteria $criteria = null): array;
}
