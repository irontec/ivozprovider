<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRule;

use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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

    /**
     * Get lcrId
     *
     * @return int
     */
    public function getLcrId(): int;

    /**
     * Get prefix
     *
     * @return string | null
     */
    public function getPrefix(): ?string;

    /**
     * Get fromUri
     *
     * @return string | null
     */
    public function getFromUri(): ?string;

    /**
     * Get requestUri
     *
     * @return string | null
     */
    public function getRequestUri(): ?string;

    /**
     * Get mtTvalue
     *
     * @return string | null
     */
    public function getMtTvalue(): ?string;

    /**
     * Get stopper
     *
     * @return int
     */
    public function getStopper(): int;

    /**
     * Get enabled
     *
     * @return int
     */
    public function getEnabled(): int;

    /**
     * Set routingPattern
     *
     * @param RoutingPatternInterface | null
     *
     * @return static
     */
    public function setRoutingPattern(?RoutingPatternInterface $routingPattern = null): TrunksLcrRuleInterface;

    /**
     * Get routingPattern
     *
     * @return RoutingPatternInterface | null
     */
    public function getRoutingPattern(): ?RoutingPatternInterface;

    /**
     * Get routingPatternGroupsRelPattern
     *
     * @return RoutingPatternGroupsRelPatternInterface | null
     */
    public function getRoutingPatternGroupsRelPattern(): ?RoutingPatternGroupsRelPatternInterface;

    /**
     * Set outgoingRouting
     *
     * @param OutgoingRoutingInterface
     *
     * @return static
     */
    public function setOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): TrunksLcrRuleInterface;

    /**
     * Get outgoingRouting
     *
     * @return OutgoingRoutingInterface
     */
    public function getOutgoingRouting(): OutgoingRoutingInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
