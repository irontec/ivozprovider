<?php

namespace Ivoz\Provider\Domain\Model\RoutingPattern;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;

/**
* RoutingPatternInterface
*/
interface RoutingPatternInterface extends LoggableEntityInterface
{

    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setPrefix(?string $prefix = null): static;

    public function getPrefix(): string;

    public function getName(): Name;

    public function getDescription(): Description;

    public function getBrand(): BrandInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingPatternInterface;

    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingPatternInterface;

    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings): RoutingPatternInterface;

    public function getOutgoingRoutings(?Criteria $criteria = null): array;

    public function addRelPatternGroup(RoutingPatternGroupsRelPatternInterface $relPatternGroup): RoutingPatternInterface;

    public function removeRelPatternGroup(RoutingPatternGroupsRelPatternInterface $relPatternGroup): RoutingPatternInterface;

    public function replaceRelPatternGroups(ArrayCollection $relPatternGroups): RoutingPatternInterface;

    public function getRelPatternGroups(?Criteria $criteria = null): array;

    public function addLcrRule(TrunksLcrRuleInterface $lcrRule): RoutingPatternInterface;

    public function removeLcrRule(TrunksLcrRuleInterface $lcrRule): RoutingPatternInterface;

    public function replaceLcrRules(ArrayCollection $lcrRules): RoutingPatternInterface;

    public function getLcrRules(?Criteria $criteria = null): array;

}
