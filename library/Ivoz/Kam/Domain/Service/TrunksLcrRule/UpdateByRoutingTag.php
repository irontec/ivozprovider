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
    /**
     * @var UpdateByOutgoingRouting
     */
    protected $updateByOutgoingRouting;

    /**
     * UpdateByRoutingTag constructor.
     * @param UpdateByOutgoingRouting $updateByOutgoingRouting
     */
    public function __construct(
        UpdateByOutgoingRouting $updateByOutgoingRouting
    ) {
        $this->updateByOutgoingRouting = $updateByOutgoingRouting;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(RoutingTagInterface $entity, $isNew)
    {
        // Get all OutgointRoutings that use this routingTag
        $outgoingRoutings = $entity->getOutgoingRoutings();

        // Update all outgoing routes if required
        foreach ($outgoingRoutings as $outgoingRouting) {
            $this->updateByOutgoingRouting->execute($outgoingRouting);
        }
    }
}