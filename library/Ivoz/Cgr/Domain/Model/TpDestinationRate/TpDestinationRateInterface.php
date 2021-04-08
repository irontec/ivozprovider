<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRate;

/**
* TpDestinationRateInterface
*/
interface TpDestinationRateInterface extends LoggableEntityInterface
{
    const ROUNDINGMETHOD_UP = '*up';

    const ROUNDINGMETHOD_UPMINCOST = '*upmincost';

    public function getChangeSet();

    public function getTpid(): string;

    public function getTag(): ?string;

    public function getDestinationsTag(): ?string;

    public function getRatesTag(): ?string;

    public function getRoundingMethod(): string;

    public function getRoundingDecimals(): int;

    public function getMaxCost(): float;

    public function getMaxCostStrategy(): string;

    public function getCreatedAt(): \DateTime;

    public function setDestinationRate(DestinationRate $destinationRate): static;

    public function getDestinationRate(): DestinationRate;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
