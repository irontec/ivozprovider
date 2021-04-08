<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;

/**
* TrunksLcrRuleInterface
*/
interface TrunksLcrRuleInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Return LcrRule FromUri string based on OutgoingRouting configuration
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     * @return string
     */
    public static function getFromUriForOutgoingRouting(OutgoingRoutingInterface $outgoingRouting);

    public function getLcrId(): int;

    public function getPrefix(): ?string;

    public function getFromUri(): ?string;

    public function getRequestUri(): ?string;

    public function getMtTvalue(): ?string;

    public function getStopper(): int;

    public function getEnabled(): int;

    public function setRoutingPattern(?RoutingPatternInterface $routingPattern = null): static;

    public function getRoutingPattern(): ?RoutingPatternInterface;

    public function getRoutingPatternGroupsRelPattern(): ?RoutingPatternGroupsRelPatternInterface;

    public function setOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): static;

    public function getOutgoingRouting(): OutgoingRoutingInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
