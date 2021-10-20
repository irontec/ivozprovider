<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;
use Ivoz\Provider\Domain\Service\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternLifecycleEventHandlerInterface;

/**
 * Class UpdateByRoutingPatternGroupsRelPattern
 * @package Ivoz\Kam\Domain\Service\TrunksLcrRule
 * @lifecycle
 */
class UpdateByRoutingPatternGroupsRelPattern implements RoutingPatternGroupsRelPatternLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private TrunksLcrRuleFactory $trunksLcrRuleFactory
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY,
        ];
    }

    /**
     * @return void
     */
    public function execute(RoutingPatternGroupsRelPatternInterface $routingPatternGroupsRelPattern)
    {
        $isNew = $routingPatternGroupsRelPattern->isNew();

        // Get all OutgointRoutings that use this routingPattern
        $outgoingRoutings = $routingPatternGroupsRelPattern->getRoutingPatternGroup()->getOutgoingRoutings();
        $routingPattern = $routingPatternGroupsRelPattern->getRoutingPattern();

        // Update all outgoing routes if required
        foreach ($outgoingRoutings as $outgoingRouting) {
            $lcRule = $this->trunksLcrRuleFactory->execute(
                $outgoingRouting,
                $routingPattern
            );

            if ($isNew) {
                $outgoingRouting->addLcrRule($lcRule);
            }
        }
    }
}
