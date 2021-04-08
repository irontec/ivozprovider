<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;

/**
* RoutingPatternGroupsRelPatternInterface
*/
interface RoutingPatternGroupsRelPatternInterface extends LoggableEntityInterface
{

    public function getChangeSet();

    public function setRoutingPattern(?RoutingPatternInterface $routingPattern = null): static;

    public function getRoutingPattern(): ?RoutingPatternInterface;

    public function setRoutingPatternGroup(?RoutingPatternGroupInterface $routingPatternGroup = null): static;

    public function getRoutingPatternGroup(): ?RoutingPatternGroupInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
