<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroup;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface RoutingPatternGroupInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface[]
     */
    public function getRoutingPatterns();

    public function __toString();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description = null);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

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
     * Add relPattern
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface $relPattern
     *
     * @return RoutingPatternGroupTrait
     */
    public function addRelPattern(\Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface $relPattern);

    /**
     * Remove relPattern
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface $relPattern
     */
    public function removeRelPattern(\Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface $relPattern);

    /**
     * Replace relPatterns
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface[] $relPatterns
     * @return self
     */
    public function replaceRelPatterns(Collection $relPatterns);

    /**
     * Get relPatterns
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface[]
     */
    public function getRelPatterns(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     *
     * @return RoutingPatternGroupTrait
     */
    public function addOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting);

    /**
     * Remove outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     */
    public function removeOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting);

    /**
     * Replace outgoingRoutings
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface[] $outgoingRoutings
     * @return self
     */
    public function replaceOutgoingRoutings(Collection $outgoingRoutings);

    /**
     * Get outgoingRoutings
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface[]
     */
    public function getOutgoingRoutings(\Doctrine\Common\Collections\Criteria $criteria = null);

}

