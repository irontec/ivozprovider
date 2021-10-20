<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;

/**
* TpDestinationRateInterface
*/
interface TpDestinationRateInterface extends LoggableEntityInterface
{
    public const ROUNDINGMETHOD_UP = '*up';

    public const ROUNDINGMETHOD_UPMINCOST = '*upmincost';

    public function getChangeSet(): array;

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
