<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

interface TrunksLcrRuleTargetRepository extends ObjectRepository, Selectable
{
    /**
     * @param OutgoingRoutingInterface $outgoingRouting
     * @param TrunksLcrRuleInterface $lcrRule
     * @param TrunksLcrGatewayInterface $lcrGateway
     * @return TrunksLcrRuleTargetInterface | null
     */
    public function findRuleTarget(
        OutgoingRoutingInterface $outgoingRouting,
        TrunksLcrRuleInterface $lcrRule,
        TrunksLcrGatewayInterface $lcrGateway
    );
}

