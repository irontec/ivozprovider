<?php
namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

/**
 * OutgoingRouting
 */
class OutgoingRouting extends OutgoingRoutingAbstract implements OutgoingRoutingInterface
{
    use OutgoingRoutingTrait;

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

