<?php

namespace Ivoz\Provider\Domain\Model\Destination;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* DestinationInterface
*/
interface DestinationInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Validate prefix comes in E.164 format
     *
     * @inheritdoc
     */
    public function setPrefix(string $prefix): DestinationInterface;

    /**
     * @return string
     */
    public function getCgrTag();

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix(): string;

    /**
     * Get name
     *
     * @return Name
     */
    public function getName(): Name;

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * @var TpDestinationInterface
     * mappedBy destination
     */
    public function setTpDestination(TpDestinationInterface $tpDestination): DestinationInterface;

    /**
     * Get tpDestination
     * @return TpDestinationInterface
     */
    public function getTpDestination(): ?TpDestinationInterface;

    /**
     * Add destinationRate
     *
     * @param DestinationRateInterface $destinationRate
     *
     * @return static
     */
    public function addDestinationRate(DestinationRateInterface $destinationRate): DestinationInterface;

    /**
     * Remove destinationRate
     *
     * @param DestinationRateInterface $destinationRate
     *
     * @return static
     */
    public function removeDestinationRate(DestinationRateInterface $destinationRate): DestinationInterface;

    /**
     * Replace destinationRates
     *
     * @param ArrayCollection $destinationRates of DestinationRateInterface
     *
     * @return static
     */
    public function replaceDestinationRates(ArrayCollection $destinationRates): DestinationInterface;

    /**
     * Get destinationRates
     * @param Criteria | null $criteria
     * @return DestinationRateInterface[]
     */
    public function getDestinationRates(?Criteria $criteria = null): array;

}
