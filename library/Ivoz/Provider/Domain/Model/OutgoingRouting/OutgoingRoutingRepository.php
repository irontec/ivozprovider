<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

interface OutgoingRoutingRepository extends ObjectRepository, Selectable
{
    public function findByRoutingPattern(RoutingPatternInterface $routingPattern): array;

    /**
     * @return OutgoingRoutingInterface[]
     */
    public function findByCarrier(int $carrierId): array;
}
