<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface RoutingPatternGroupsRelPatternInterface extends LoggableEntityInterface
{
    public function getChangeSet();

    /**
     * Set routingPattern
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern | null
     *
     * @return static
     */
    public function setRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern = null);

    /**
     * Get routingPattern
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface | null
     */
    public function getRoutingPattern();

    /**
     * Set routingPatternGroup
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface $routingPatternGroup | null
     *
     * @return static
     */
    public function setRoutingPatternGroup(\Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface $routingPatternGroup = null);

    /**
     * Get routingPatternGroup
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface | null
     */
    public function getRoutingPatternGroup();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
