<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier;

/**
 * OutgoingRoutingRelCarrier
 */
class OutgoingRoutingRelCarrier extends OutgoingRoutingRelCarrierAbstract implements OutgoingRoutingRelCarrierInterface
{
    use OutgoingRoutingRelCarrierTrait;

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
}
