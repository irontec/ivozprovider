<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroup;

use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* RoutingPatternGroupInterface
*/
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
    public function getRoutingPatterns(?Criteria $criteria = null);

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get description
     *
     * @return string | null
     */
    public function getDescription(): ?string;

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
     * Add relPattern
     *
     * @param RoutingPatternGroupsRelPatternInterface $relPattern
     *
     * @return static
     */
    public function addRelPattern(RoutingPatternGroupsRelPatternInterface $relPattern): RoutingPatternGroupInterface;

    /**
     * Remove relPattern
     *
     * @param RoutingPatternGroupsRelPatternInterface $relPattern
     *
     * @return static
     */
    public function removeRelPattern(RoutingPatternGroupsRelPatternInterface $relPattern): RoutingPatternGroupInterface;

    /**
     * Replace relPatterns
     *
     * @param ArrayCollection $relPatterns of RoutingPatternGroupsRelPatternInterface
     *
     * @return static
     */
    public function replaceRelPatterns(ArrayCollection $relPatterns): RoutingPatternGroupInterface;

    /**
     * Get relPatterns
     * @param Criteria | null $criteria
     * @return RoutingPatternGroupsRelPatternInterface[]
     */
    public function getRelPatterns(?Criteria $criteria = null): array;

    /**
     * Add outgoingRouting
     *
     * @param OutgoingRoutingInterface $outgoingRouting
     *
     * @return static
     */
    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingPatternGroupInterface;

    /**
     * Remove outgoingRouting
     *
     * @param OutgoingRoutingInterface $outgoingRouting
     *
     * @return static
     */
    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingPatternGroupInterface;

    /**
     * Replace outgoingRoutings
     *
     * @param ArrayCollection $outgoingRoutings of OutgoingRoutingInterface
     *
     * @return static
     */
    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings): RoutingPatternGroupInterface;

    /**
     * Get outgoingRoutings
     * @param Criteria | null $criteria
     * @return OutgoingRoutingInterface[]
     */
    public function getOutgoingRoutings(?Criteria $criteria = null): array;

}
