<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;
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

    /**
     * Find obsolete LcrRuleTargets after applying OutgoingRouting changes
     *
     * This must be done by comparing active LcrRuleTargetss generated in other services with
     * stored ones in database as there is no valid constraint to delete cascade them.
     *
     * @see TrunksLcrRuleTargetDoctrineRepository::findOrphanLcrRuleTargets()
     *
     * @param OutgoingRoutingInterface $outgoingRouting
     */
    public function findOrphanLcrRuleTargets(OutgoingRoutingInterface $outgoingRouting);
}
