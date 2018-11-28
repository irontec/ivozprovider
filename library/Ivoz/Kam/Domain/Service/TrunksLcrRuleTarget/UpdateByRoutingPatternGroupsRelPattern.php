<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget;

use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;
use Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternLifecycleEventHandlerInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrRule\UpdateByRoutingPatternGroupsRelPattern as LcrRuleUpdateByRoutingPatternGroupsRelPattern;

/**
 * Class UpdateByRoutingPatternGroupsRelPattern
 * @package Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget
 * @lifecycle
 */
class UpdateByRoutingPatternGroupsRelPattern implements RoutingPatternGroupsRelPatternLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = LcrRuleUpdateByRoutingPatternGroupsRelPattern::POST_PERSIST_PRIORITY + 10;

    /**
     * @var TrunksLcrRuleTargetFactory
     */
    protected $trunksLcrRuleTargetFactory;

    /**
     * UpdateByRoutingPatternGroupsRelPattern constructor.
     * @param TrunksLcrRuleTargetFactory $trunksLcrRuleTargetFactory
     */
    public function __construct(
        TrunksLcrRuleTargetFactory $trunksLcrRuleTargetFactory
    ) {
        $this->trunksLcrRuleTargetFactory = $trunksLcrRuleTargetFactory;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY,
        ];
    }

    public function execute(
        RoutingPatternGroupsRelPatternInterface $routingPatternGroupsRelPattern
    ) {
        // Get all OutgointRoutings that use this routingPattern
        $outgoingRoutings = $routingPatternGroupsRelPattern->getRoutingPatternGroup()->getOutgoingRoutings();

        // Update all outgoing routes if required
        foreach ($outgoingRoutings as $outgoingRouting) {
            $this->trunksLcrRuleTargetFactory->execute(
                $outgoingRouting
            );
        }
    }
}
