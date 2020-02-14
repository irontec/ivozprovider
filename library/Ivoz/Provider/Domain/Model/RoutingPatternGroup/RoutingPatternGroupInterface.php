<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroup;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

interface RoutingPatternGroupInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @param Criteria|null $criteria
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface[]
     */
    public function getRoutingPatterns(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get description
     *
     * @return string | null
     */
    public function getDescription();

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
     * @return static
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
     * @param ArrayCollection $relPatterns of Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface
     * @return static
     */
    public function replaceRelPatterns(ArrayCollection $relPatterns);

    /**
     * Get relPatterns
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface[]
     */
    public function getRelPatterns(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     *
     * @return static
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
     * @param ArrayCollection $outgoingRoutings of Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface
     * @return static
     */
    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings);

    /**
     * Get outgoingRoutings
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface[]
     */
    public function getOutgoingRoutings(\Doctrine\Common\Collections\Criteria $criteria = null);
}
