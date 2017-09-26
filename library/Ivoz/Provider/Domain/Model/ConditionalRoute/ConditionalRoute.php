<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoute;

/**
 * ConditionalRoute
 * @codeCoverageIgnore
 */
class ConditionalRoute extends ConditionalRouteAbstract implements ConditionalRouteInterface
{
    use ConditionalRouteTrait;

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

