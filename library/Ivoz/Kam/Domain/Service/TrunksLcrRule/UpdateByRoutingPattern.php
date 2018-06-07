<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
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
    /**
     * @var UpdateByOutgoingRouting
     */
    protected $updateByOutgoingRouting;

    /**
     * @var OutgoingRoutingRepository
     */
    protected $outgoingRoutingRepository;

    /**
     * UpdateByRoutingPattern constructor.
     * @param UpdateByOutgoingRouting $updateByOutgoingRouting
     * @param OutgoingRoutingRepository $outgoingRoutingRepository
     */
    public function __construct(
        UpdateByOutgoingRouting $updateByOutgoingRouting,
        OutgoingRoutingRepository $outgoingRoutingRepository
    ) {
        $this->updateByOutgoingRouting = $updateByOutgoingRouting;
        $this->outgoingRoutingRepository = $outgoingRoutingRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(RoutingPatternInterface $entity, $isNew)
    {
        if (!$entity->hasChanged('prefix')) {
            return;
        }

        // Get all OutgointRoutings that use this routingPattern
        $outgoingRoutings = $this->outgoingRoutingRepository->findByRoutingPattern($entity);

        // Update all outgoing routes if required
        foreach ($outgoingRoutings as $outgoingRouting) {
            $this->updateByOutgoingRouting->execute($outgoingRouting);
        }
    }
}
