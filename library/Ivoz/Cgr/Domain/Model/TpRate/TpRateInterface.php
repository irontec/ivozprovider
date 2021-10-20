<?php

namespace Ivoz\Cgr\Domain\Model\TpRate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;

/**
* TpRateInterface
*/
interface TpRateInterface extends LoggableEntityInterface
{

    public function getChangeSet(): array;

    /**
     * Validate RateIncrement has valid unit
     */
    public function setRateIncrement(string $rateIncrement): static;

    /**
     * Validate GroupIntervalStart has valid unit
     */
    public function setGroupIntervalStart(string $groupIntervalStart): static;

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
