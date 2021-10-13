<?php

namespace Ivoz\Provider\Domain\Model\Destination;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* DestinationInterface
*/
interface DestinationInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

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

    public function getPrefix(): string;

    public function getName(): Name;

    public function getBrand(): BrandInterface;

    public function isInitialized(): bool;

    public function setTpDestination(TpDestinationInterface $tpDestination): static;

    public function getTpDestination(): ?TpDestinationInterface;

    public function addDestinationRate(DestinationRateInterface $destinationRate): DestinationInterface;

    public function removeDestinationRate(DestinationRateInterface $destinationRate): DestinationInterface;

    public function replaceDestinationRates(ArrayCollection $destinationRates): DestinationInterface;

    public function getDestinationRates(?Criteria $criteria = null): array;
}
