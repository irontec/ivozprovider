<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface;

interface OutgoingRoutingRepository extends ObjectRepository, Selectable {


    public function findByRoutingPattern(RoutingPatternInterface $routingPattern) :array;

}

