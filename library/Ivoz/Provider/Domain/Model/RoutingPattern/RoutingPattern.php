<?php

namespace Ivoz\Provider\Domain\Model\RoutingPattern;

use Assert\Assertion;

/**
 * RoutingPattern
 */
class RoutingPattern extends RoutingPatternAbstract implements RoutingPatternInterface
{
    use RoutingPatternTrait;

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
     * {@inheritDoc}
     */
    public function setPrefix($prefix = null)
    {
        if (!empty($prefix)) {
            Assertion::regex($prefix, '/^\+[0-9]*/');
        }
        return parent::setPrefix($prefix);
    }
}

