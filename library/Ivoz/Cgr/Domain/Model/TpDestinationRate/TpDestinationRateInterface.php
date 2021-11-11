<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;

/**
* TpDestinationRateInterface
*/
interface TpDestinationRateInterface extends LoggableEntityInterface
{
    public const ROUNDINGMETHOD_UP = '*up';

    public const ROUNDINGMETHOD_UPMINCOST = '*upmincost';

    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): TpDestinationRateDto;

    /**
     * @internal use EntityTools instead
     * @param null|TpDestinationRateInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TpDestinationRateDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TpDestinationRateDto;

    public function getTpid(): string;

    public function getTag(): ?string;

    public function getDestinationsTag(): ?string;

    public function getRatesTag(): ?string;

    public function getRoundingMethod(): string;

    public function getRoundingDecimals(): int;

    public function getMaxCost(): float;

    public function getMaxCostStrategy(): string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeInterface;

    public function setDestinationRate(DestinationRateInterface $destinationRate): static;

    public function getDestinationRate(): DestinationRateInterface;

    public function isInitialized(): bool;
}
