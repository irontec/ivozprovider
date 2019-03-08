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
    public function getPrefix();

    /**
     * Set tpDestination
     *
     * @param \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface $tpDestination
     *
     * @return self
     */
    public function setTpDestination(\Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface $tpDestination = null);

    /**
     * Get tpDestination
     *
     * @return \Ivoz\Cgr\Domain\Model\TpDestination\TpDestinationInterface
     */
    public function getTpDestination();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Set name
     *
     * @param \Ivoz\Provider\Domain\Model\Destination\Name $name
     *
     * @return self
     */
    public function setName(\Ivoz\Provider\Domain\Model\Destination\Name $name);

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\Destination\Name
     */
    public function getName();

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
