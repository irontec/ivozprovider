<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface;
use Ivoz\Provider\Domain\Service\RoutingTag\RoutingTagLifecycleEventHandlerInterface;

/**
 * Class UpdateByRoutingTag
 * @package Ivoz\Kam\Domain\Service\TrunksLcrRule
 * @lifecycle
 */
class UpdateByRoutingTag implements RoutingTagLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var TrunksLcrRuleFactory
     */
    protected $trunksLcrRuleFactory;

    /**
     * UpdateByRoutingTag constructor.
     *
     * @param TrunksLcrRuleFactory $trunksLcrRuleFactory
     */
    public function __construct(
        TrunksLcrRuleFactory $trunksLcrRuleFactory
    ) {
        $this->trunksLcrRuleFactory = $trunksLcrRuleFactory;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @param RoutingTagInterface $routingTag
     * @throws \Exception
     */
    public function execute(RoutingTagInterface $routingTag)
    {
        if (!$routingTag->hasChanged('tag')) {
            return;
        }

        // Get all OutgointRoutings that use this routingTag
        $outgoingRoutings = $routingTag->getOutgoingRoutings();

        // Update all outgoing routes if required
        foreach ($outgoingRoutings as $outgoingRouting) {
            $routingPatterns = $outgoingRouting->getRoutingPatterns();
            foreach ($routingPatterns as $routingPattern) {
                $this->trunksLcrRuleFactory->execute(
                    $outgoingRouting,
                    $routingPattern
                );
            }
        }
    }
}
