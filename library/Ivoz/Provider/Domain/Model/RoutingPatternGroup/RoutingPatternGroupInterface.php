<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroup;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

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

    public function getName(): string;

    public function getDescription(): ?string;

    public function getBrand(): BrandInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    public function addRelPattern(RoutingPatternGroupsRelPatternInterface $relPattern): RoutingPatternGroupInterface;

    public function removeRelPattern(RoutingPatternGroupsRelPatternInterface $relPattern): RoutingPatternGroupInterface;

    public function replaceRelPatterns(ArrayCollection $relPatterns): RoutingPatternGroupInterface;

    public function getRelPatterns(?Criteria $criteria = null): array;

    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingPatternGroupInterface;

    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingPatternGroupInterface;

    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings): RoutingPatternGroupInterface;

    public function getOutgoingRoutings(?Criteria $criteria = null): array;
}
