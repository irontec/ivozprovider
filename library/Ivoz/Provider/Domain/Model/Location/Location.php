<?php

namespace Ivoz\Provider\Domain\Model\Location;

/**
 * Location
 */
class Location extends LocationAbstract implements LocationInterface
{
    use LocationTrait;

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
}
