<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Service\OutgoingRouting\OutgoingRoutingLifecycleEventHandlerInterface;

/**
 * Class UpdateByOutgoingRouting
 * @package Ivoz\Kam\Domain\Service\TrunksLcrRule
 */
class UpdateByOutgoingRouting implements OutgoingRoutingLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools,
        private TrunksLcrRuleFactory $lcrRuleFactory
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @param OutgoingRoutingInterface $outgoingRouting
     *
     * @throws \Exception
     *
     * @return void
     */
    public function execute(OutgoingRoutingInterface $outgoingRouting)
    {
        $lcrRules = [];

        // Create or update existing LcrRules based on actual RoutingPatterns of OutgoingRouting
        $routingPatterns = $outgoingRouting->getRoutingPatterns();
        foreach ($routingPatterns as $routingPattern) {
            $lcrRules[] = $this->lcrRuleFactory->execute(
                $outgoingRouting,
                $routingPattern
            );
        }

        $outgoingRouting->replaceLcrRules(new ArrayCollection($lcrRules));

        $this->entityTools->persist($outgoingRouting);
    }
}
