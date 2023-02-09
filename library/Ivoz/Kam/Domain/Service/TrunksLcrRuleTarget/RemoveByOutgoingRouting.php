<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetRepository;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Service\OutgoingRouting\OutgoingRoutingLifecycleEventHandlerInterface;

/**
 * Class RemoveByOutgoingRouting
 *
 * @package Ivoz\Kam\Domain\Service\TrunksLcrGateway
 */
class RemoveByOutgoingRouting implements OutgoingRoutingLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = UpdateByOutgoingRouting::POST_PERSIST_PRIORITY + 10;

    public function __construct(
        private EntityTools $entityTools,
        private TrunksLcrRuleTargetRepository $trunksLcrRuleTargetRepository
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * This Service remove obsolete LcrRuleTargets after applying OutgoingRouting changes
     *
     * This must be done by comparing active LcrRuleTargets generated in other services with
     * stored ones in database as there is no valid constraint to delete cascade them.
     *
     * @see TrunksLcrRuleTargetDoctrineRepository::findOrphanLcrRules()
     *
     * @param OutgoingRoutingInterface $outgoingRouting
     *
     * @return void
     */
    public function execute(OutgoingRoutingInterface $outgoingRouting)
    {
        // Find all orphan database TrunksLcrRuleTargetss for this OutgoingRouting
        $orphanLcrRuleTargets = $this->trunksLcrRuleTargetRepository->findOrphanLcrRuleTargets(
            $outgoingRouting
        );

        foreach ($orphanLcrRuleTargets as $orphanLcrRuleTarget) {
            $this->entityTools->remove($orphanLcrRuleTarget);
        }
    }
}
