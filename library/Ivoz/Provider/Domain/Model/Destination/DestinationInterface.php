<?php

namespace Ivoz\Provider\Domain\Model\Destination;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface DestinationInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return string
     */
    public function getCgrTag();

    /**
     * Set prefix
     *
     * @param string $prefix
     *
     * @return self
     */
    public function setPrefix($prefix);

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
     * @return DestinationTrait
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
     * @param \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface[] $destinationRates
     * @return self
     */
    public function replaceDestinationRates(Collection $destinationRates);

    /**
     * Get destinationRates
     *
     * @return \Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface[]
     */
    public function getDestinationRates(\Doctrine\Common\Collections\Criteria $criteria = null);

}

