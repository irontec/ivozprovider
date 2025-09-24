<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierInterface;

interface OutgoingRoutingRelCarrierRepository extends ObjectRepository, Selectable
{
    /**
     * @return OutgoingRoutingRelCarrierInterface[]
     */
    public function findByCarrier(int $carrierId): array;
}
