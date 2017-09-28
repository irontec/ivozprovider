<?php

namespace Ivoz\Provider\Domain\Model\RoutingPattern;

/**
 * RoutingPattern
 */
class RoutingPattern extends RoutingPatternAbstract implements RoutingPatternInterface
{
    use RoutingPatternTrait;

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

