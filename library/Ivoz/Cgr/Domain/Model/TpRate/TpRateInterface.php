<?php

namespace Ivoz\Cgr\Domain\Model\TpRate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;

/**
* TpRateInterface
*/
interface TpRateInterface extends LoggableEntityInterface
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
     * Validate RateIncrement has valid unit
     */
    public function setRateIncrement(string $rateIncrement): static;

    /**
     * Validate GroupIntervalStart has valid unit
     */
    public function setGroupIntervalStart(string $groupIntervalStart): static;

    public static function createDto(string|int|null $id = null): TpRateDto;

    /**
     * @internal use EntityTools instead
     * @param null|TpRateInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TpRateDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpRateDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TpRateDto;

    public function getTpid(): string;

    public function getTag(): ?string;

    public function getConnectFee(): float;

    public function getRateCost(): float;

    public function getRateUnit(): string;

    public function getRateIncrement(): string;

    public function getGroupIntervalStart(): string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeInterface;

    public function setDestinationRate(DestinationRateInterface $destinationRate): static;

    public function getDestinationRate(): DestinationRateInterface;

    public function isInitialized(): bool;
}
