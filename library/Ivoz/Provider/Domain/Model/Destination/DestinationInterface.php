<?php

namespace Ivoz\Provider\Domain\Model\Destination;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

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
    public function setPrefix($prefix);

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
     * Get tpDestination
     *
     * @return \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface | null
     */
    public function getTpDestination();

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\Destination\Name
     */
    public function getName();

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add destinationRate
     *
     * @param \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate
     *
     * @return static
     */
    public function addDestinationRate(\Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate);

    /**
     * Remove destinationRate
     *
     * @param \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate
     */
    public function removeDestinationRate(\Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface $destinationRate);

    /**
     * Replace destinationRates
     *
     * @param ArrayCollection $destinationRates of Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface
     * @return static
     */
    public function replaceDestinationRates(ArrayCollection $destinationRates);

    /**
     * Get destinationRates
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface[]
     */
    public function getDestinationRates(\Doctrine\Common\Collections\Criteria $criteria = null);
}
