<?php

namespace Ivoz\Provider\Domain\Model\RoutingPattern;

use Ivoz\Core\Domain\Model\EntityInterface;
use Doctrine\Common\Collections\Collection;

interface RoutingPatternInterface extends EntityInterface
{
    /**
     * {@inheritDoc}
     */
    public function setPrefix($prefix = null);

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
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\Name $name
     *
     * @return self
     */
    public function setName(\Ivoz\Provider\Domain\Model\RoutingPattern\Name $name);

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\Name
     */
    public function getName();

    /**
     * Set description
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\Description $description
     *
     * @return self
     */
    public function setDescription(\Ivoz\Provider\Domain\Model\RoutingPattern\Description $description);

    /**
     * Get description
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\Description
     */
    public function getDescription();

    /**
     * Add outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     *
     * @return RoutingPatternTrait
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

    /**
     * Add relPatternGroup
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface $relPatternGroup
     *
     * @return RoutingPatternTrait
     */
    public function addRelPatternGroup(\Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface $relPatternGroup);

    /**
     * Remove relPatternGroup
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface $relPatternGroup
     */
    public function removeRelPatternGroup(\Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface $relPatternGroup);

    /**
     * Replace relPatternGroups
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface[] $relPatternGroups
     * @return self
     */
    public function replaceRelPatternGroups(Collection $relPatternGroups);

    /**
     * Get relPatternGroups
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface[]
     */
    public function getRelPatternGroups(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add lcrRule
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface $lcrRule
     *
     * @return RoutingPatternTrait
     */
    public function addLcrRule(\Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface $lcrRule);

    /**
     * Remove lcrRule
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface $lcrRule
     */
    public function removeLcrRule(\Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface $lcrRule);

    /**
     * Replace lcrRules
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface[] $lcrRules
     * @return self
     */
    public function replaceLcrRules(Collection $lcrRules);

    /**
     * Get lcrRules
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface[]
     */
    public function getLcrRules(\Doctrine\Common\Collections\Criteria $criteria = null);

}

