<?php
namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

/**
 * OutgoingRouting
 */
class OutgoingRouting extends OutgoingRoutingAbstract implements OutgoingRoutingInterface
{
    use OutgoingRoutingTrait;

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

