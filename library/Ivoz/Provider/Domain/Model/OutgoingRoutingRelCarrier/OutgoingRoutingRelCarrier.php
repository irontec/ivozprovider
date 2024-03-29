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
     * @return array<string, mixed>
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
    public function getId(): ?int
    {
        return $this->id;
    }
}
