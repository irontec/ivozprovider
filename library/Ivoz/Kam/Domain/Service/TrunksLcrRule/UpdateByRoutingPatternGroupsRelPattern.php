<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget\CreateByOutgoingRouting as RuleTargetByOutgoingRouting;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrRule\UpdateByOutgoingRouting as LcrRuleByOutgoingRouting;
use Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternLifecycleEventHandlerInterface;

/**
 * Class UpdateByRoutingPatternGroupsRelPattern
 * @package Ivoz\Kam\Domain\Service\TrunksLcrRule
 * @lifecycle
 */
class UpdateByRoutingPatternGroupsRelPattern implements RoutingPatternGroupsRelPatternLifecycleEventHandlerInterface
{
    /**
     * @var RuleTargetByOutgoingRouting
     */
    protected $ruleTargetByOutgoingRouting;

    /**
     * @var LcrRuleByOutgoingRouting
     */
    protected $lcrRuleByOutgoingRouting;

    /**
     * UpdateByRoutingPatternGroupsRelPattern constructor.
     * @param UpdateByOutgoingRouting $ruleTargetByOutgoingRouting
     */
    public function __construct(
        RuleTargetByOutgoingRouting $ruleTargetByOutgoingRouting,
        LcrRuleByOutgoingRouting $lcrRuleByByOutgoingRouting
    ) {
        $this->ruleTargetByOutgoingRouting = $ruleTargetByOutgoingRouting;
        $this->lcrRuleByOutgoingRouting = $lcrRuleByByOutgoingRouting;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10,
            self::EVENT_POST_REMOVE => 10,
        ];
    }

    public function execute(RoutingPatternGroupsRelPatternInterface $entity, $isNew)
    {
        // Get all OutgointRoutings that use this routingPattern
        $outgoingRoutings = $entity->getRoutingPatternGroup()->getOutgoingRoutings();

        // Update all outgoing routes if required
        foreach ($outgoingRoutings as $outgoingRouting) {
            $this->lcrRuleByOutgoingRouting->execute($outgoingRouting);
            $this->ruleTargetByOutgoingRouting->execute($outgoingRouting);
        }
    }
}