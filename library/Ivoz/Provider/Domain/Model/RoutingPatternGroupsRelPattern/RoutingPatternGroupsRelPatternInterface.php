<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern;

use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* RoutingPatternGroupsRelPatternInterface
*/
interface RoutingPatternGroupsRelPatternInterface extends LoggableEntityInterface
{

    public function getChangeSet();

    /**
     * Set routingPattern
     *
     * @param RoutingPatternInterface | null
     *
     * @return static
     */
    public function setRoutingPattern(?RoutingPatternInterface $routingPattern = null): RoutingPatternGroupsRelPatternInterface;

    /**
     * Get routingPattern
     *
     * @return RoutingPatternInterface | null
     */
    public function getRoutingPattern(): ?RoutingPatternInterface;

    /**
     * Set routingPatternGroup
     *
     * @param RoutingPatternGroupInterface | null
     *
     * @return static
     */
    public function setRoutingPatternGroup(?RoutingPatternGroupInterface $routingPatternGroup = null): RoutingPatternGroupsRelPatternInterface;

    /**
     * Get routingPatternGroup
     *
     * @return RoutingPatternGroupInterface | null
     */
    public function getRoutingPatternGroup(): ?RoutingPatternGroupInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
