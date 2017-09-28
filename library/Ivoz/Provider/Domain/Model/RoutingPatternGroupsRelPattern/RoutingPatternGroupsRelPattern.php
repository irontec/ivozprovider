<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern;

/**
 * RoutingPatternGroupsRelPattern
 */
class RoutingPatternGroupsRelPattern extends RoutingPatternGroupsRelPatternAbstract implements RoutingPatternGroupsRelPatternInterface
{
    use RoutingPatternGroupsRelPatternTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

