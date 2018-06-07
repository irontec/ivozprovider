<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

/**
 * Class UpdateByOutgoingRouting
 * @package Ivoz\Kam\Domain\Service\TrunksLcrRule
 */
class UpdateByOutgoingRouting
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var CreateByOutgoingRoutingAndRoutingPattern
     */
    protected $lcrRuleFactory;

    public function __construct(
        EntityTools $entityTools,
        CreateByOutgoingRoutingAndRoutingPattern $lcrRuleFactory
    ) {
        $this->entityTools = $entityTools;
        $this->lcrRuleFactory = $lcrRuleFactory;
    }

    /**
     * @param OutgoingRoutingInterface $outgoingRouting
     * @throws \Exception
     */
    public function execute(OutgoingRoutingInterface $outgoingRouting)
    {
        /** @todo split this service into two */
        $originalLcrRules = $outgoingRouting->getLcrRules();
        $this->addNewLcrRules($outgoingRouting);
        $this->removeObsoleteLrcRules($outgoingRouting, $originalLcrRules);
    }

    /**
     * @param OutgoingRoutingInterface $outgoingRouting
     * @return void
     * @throws \Exception
     */
    protected function removeObsoleteLrcRules(OutgoingRoutingInterface $outgoingRouting, array $prevLcrRules)
    {
        $currentLcrRules = $outgoingRouting->getLcrRules();

        $entitiesToBeRemoved = [];
        foreach ($prevLcrRules as $prevLcrRule) {
            if (!in_array($prevLcrRule, $currentLcrRules)) {
                $entitiesToBeRemoved[] = $prevLcrRule;
            }
        }

        if (empty($entitiesToBeRemoved)) {
            return;
        }

        $this->entityTools->removeFromArray($entitiesToBeRemoved);
    }

    /**
     * @param OutgoingRoutingInterface $outgoingRouting
     */
    private function addNewLcrRules(OutgoingRoutingInterface $outgoingRouting)
    {
        //! Fax OutgoingRoutings have no routingPattern and a single LcrRule with NULL routingPatternId
        if ($outgoingRouting->getType() == OutgoingRouting::FAX) {
            $lcrRule = $this->lcrRuleFactory->execute($outgoingRouting, null);
            if ($lcrRule->hasChanged('id')) {
                $outgoingRouting->replaceLcrRules(new ArrayCollection([$lcrRule]));
            }
            return;
        }

        // Create or update existing LcrRules based on actual RoutingPatterns of OutgoingRouting
        $routingPatterns = $outgoingRouting->getRoutingPatterns();
        $lcrRules = array();
        foreach ($routingPatterns as $routingPattern) {
            $lcrRules[] = $this->lcrRuleFactory->execute($outgoingRouting, $routingPattern);
        }
        $outgoingRouting->replaceLcrRules(new ArrayCollection($lcrRules));
    }
}