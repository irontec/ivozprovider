<?php

namespace Ivoz\Provider\Domain\Model\RoutingPattern;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* RoutingPatternInterface
*/
interface RoutingPatternInterface extends LoggableEntityInterface
{

    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setPrefix(string $prefix = null): RoutingPatternInterface;

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
     * Get description
     *
     * @return Description
     */
    public function getDescription(): Description;

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
     * Add outgoingRouting
     *
     * @param OutgoingRoutingInterface $outgoingRouting
     *
     * @return static
     */
    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingPatternInterface;

    /**
     * Remove outgoingRouting
     *
     * @param OutgoingRoutingInterface $outgoingRouting
     *
     * @return static
     */
    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingPatternInterface;

    /**
     * Replace outgoingRoutings
     *
     * @param ArrayCollection $outgoingRoutings of OutgoingRoutingInterface
     *
     * @return static
     */
    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings): RoutingPatternInterface;

    /**
     * Get outgoingRoutings
     * @param Criteria | null $criteria
     * @return OutgoingRoutingInterface[]
     */
    public function getOutgoingRoutings(?Criteria $criteria = null): array;

    /**
     * Add relPatternGroup
     *
     * @param RoutingPatternGroupsRelPatternInterface $relPatternGroup
     *
     * @return static
     */
    public function addRelPatternGroup(RoutingPatternGroupsRelPatternInterface $relPatternGroup): RoutingPatternInterface;

    /**
     * Remove relPatternGroup
     *
     * @param RoutingPatternGroupsRelPatternInterface $relPatternGroup
     *
     * @return static
     */
    public function removeRelPatternGroup(RoutingPatternGroupsRelPatternInterface $relPatternGroup): RoutingPatternInterface;

    /**
     * Replace relPatternGroups
     *
     * @param ArrayCollection $relPatternGroups of RoutingPatternGroupsRelPatternInterface
     *
     * @return static
     */
    public function replaceRelPatternGroups(ArrayCollection $relPatternGroups): RoutingPatternInterface;

    /**
     * Get relPatternGroups
     * @param Criteria | null $criteria
     * @return RoutingPatternGroupsRelPatternInterface[]
     */
    public function getRelPatternGroups(?Criteria $criteria = null): array;

    /**
     * Add lcrRule
     *
     * @param TrunksLcrRuleInterface $lcrRule
     *
     * @return static
     */
    public function addLcrRule(TrunksLcrRuleInterface $lcrRule): RoutingPatternInterface;

    /**
     * Remove lcrRule
     *
     * @param TrunksLcrRuleInterface $lcrRule
     *
     * @return static
     */
    public function removeLcrRule(TrunksLcrRuleInterface $lcrRule): RoutingPatternInterface;

    /**
     * Replace lcrRules
     *
     * @param ArrayCollection $lcrRules of TrunksLcrRuleInterface
     *
     * @return static
     */
    public function replaceLcrRules(ArrayCollection $lcrRules): RoutingPatternInterface;

    /**
     * Get lcrRules
     * @param Criteria | null $criteria
     * @return TrunksLcrRuleInterface[]
     */
    public function getLcrRules(?Criteria $criteria = null): array;

}
