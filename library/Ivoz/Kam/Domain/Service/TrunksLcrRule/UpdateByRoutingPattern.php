<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingRepository;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Service\RoutingPattern\RoutingPatternLifecycleEventHandlerInterface;

/**
 * Class UpdateByRoutingPattern
 * @package Ivoz\Kam\Domain\Service\TrunksLcrRule
 * @lifecycle
 */
class UpdateByRoutingPattern implements RoutingPatternLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private TrunksLcrRuleFactory $trunksLcrRuleFactory,
        private OutgoingRoutingRepository $outgoingRoutingRepository
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @param RoutingPatternInterface $routingPattern
     *
     * @throws \Exception
     *
     * @return void
     */
    public function execute(RoutingPatternInterface $routingPattern)
    {
        if ($routingPattern->isNew()) {
            return;
        }

        if (!$routingPattern->hasChanged('prefix')) {
            return;
        }

        // Get all OutgointRoutings that use this routingPattern
        $outgoingRoutings = $this
                ->outgoingRoutingRepository
                ->findByRoutingPattern($routingPattern);

        // Update all outgoing routes if required
        foreach ($outgoingRoutings as $outgoingRouting) {
            $this->trunksLcrRuleFactory->execute(
                $outgoingRouting,
                $routingPattern
            );
        }
    }
}
