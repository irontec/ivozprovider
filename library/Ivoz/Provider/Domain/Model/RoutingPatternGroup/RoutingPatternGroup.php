<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroup;

use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;

/**
 * RoutingPatternGroup
 */
class RoutingPatternGroup extends RoutingPatternGroupAbstract implements RoutingPatternGroupInterface
{
    use RoutingPatternGroupTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface[]
     */
    public function getRoutingPatterns()
    {
        $patterns = array();
        $rels = $this->getRelPatterns();

        /**
         * @var RoutingPatternGroupsRelPatternInterface $rel
         */
        foreach ($rels as $rel) {
            array_push($patterns, $rel->getRoutingPattern());
        }

        return $patterns;
    }
}

