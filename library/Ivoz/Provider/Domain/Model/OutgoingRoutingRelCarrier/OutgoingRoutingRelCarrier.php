<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier;

use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;

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

    public function setCarrier(CarrierInterface $carrier): static
    {
        $servers = $carrier->getServers();
        if (count($servers) === 0) {
            throw new \DomainException('Carrier has no CarrierServers');
        }

        return parent::setCarrier($carrier);
    }
}
