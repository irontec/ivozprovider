<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleRepository;
use Ivoz\Kam\Infrastructure\Persistence\Doctrine\TrunksLcrRuleDoctrineRepository;
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
        private TrunksLcrRuleRepository $trunksLcrRuleRepository
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * This Service remove obsolete LcrRules after applying OutgoingRouting changes
     *
     * This must be done by comparing active LcrRules generated in other services with
     * stored ones in database as there is no valid constraint to delete cascade them.
     *
     * @see TrunksLcrRuleDoctrineRepository::findOrphanLcrRules()
     *
     * @param OutgoingRoutingInterface $outgoingRouting
     *
     * @return void
     */
    public function execute(OutgoingRoutingInterface $outgoingRouting)
    {
        // Find all orphan database TrunksLcrRules for this OutgoingRouting
        $orphanLcrRules = $this->trunksLcrRuleRepository->findOrphanLcrRules(
            $outgoingRouting
        );

        foreach ($orphanLcrRules as $orphanLcrRule) {
            $this->entityTools->remove($orphanLcrRule);
        }
    }
}
