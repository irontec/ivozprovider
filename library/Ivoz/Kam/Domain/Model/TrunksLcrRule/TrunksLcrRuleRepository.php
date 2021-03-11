<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRule;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Cgr\Domain\Model\TpLcrRule\TpLcrRule;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

interface TrunksLcrRuleRepository extends ObjectRepository, Selectable
{
    /**
     * Return the orphaned LcrRules after changes in OutgoingRouting
     * It's not possible to remove this entries using database constraints, so we have
     * to check the internal OutgoingRouting LcrRule Array against the stored rules in the
     * table.
     *
     * @param OutgoingRoutingInterface $outgoingRouting
     * @return TrunksLcrRuleInterface[]
     */
    public function findOrphanLcrRules(OutgoingRoutingInterface $outgoingRouting);
}
