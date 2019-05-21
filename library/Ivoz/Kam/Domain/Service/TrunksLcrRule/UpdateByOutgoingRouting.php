<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Service\OutgoingRouting\OutgoingRoutingLifecycleEventHandlerInterface;

/**
 * Class UpdateByOutgoingRouting
 * @package Ivoz\Kam\Domain\Service\TrunksLcrRule
 */
class UpdateByOutgoingRouting implements OutgoingRoutingLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var TrunksLcrRuleFactory
     */
    protected $lcrRuleFactory;

    /**
     * UpdateByOutgoingRouting constructor.
     *
     * @param EntityTools $entityTools
     * @param TrunksLcrRuleFactory $lcrRuleFactory
     */
    public function __construct(
        EntityTools $entityTools,
        TrunksLcrRuleFactory $lcrRuleFactory
    ) {
        $this->entityTools = $entityTools;
        $this->lcrRuleFactory = $lcrRuleFactory;
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
