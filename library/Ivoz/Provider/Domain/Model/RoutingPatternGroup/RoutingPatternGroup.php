<?php

namespace Ivoz\Provider\Domain\Model\RoutingPatternGroup;

use Doctrine\Common\Collections\Criteria;
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
    public function getChangeSet(): array
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
     * @param Criteria|null $criteria
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface[]
     */
    public function getRoutingPatterns(Criteria $criteria = null)
    {
        $patterns = array();
        $rels = $this->getRelPatterns($criteria);

        /**
         * @var RoutingPatternGroupsRelPatternInterface $rel
         */
        foreach ($rels as $rel) {
            array_push($patterns, $rel->getRoutingPattern());
        }

        return $patterns;
    }
}
