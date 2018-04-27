<?php
namespace Ivoz\Provider\Domain\Service\LcrRuleTarget;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface;
use Ivoz\Provider\Domain\Model\LcrRuleTarget\LcrRuleTarget;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;
use Ivoz\Provider\Domain\Service\PeerServer\PeerServerLifecycleEventHandlerInterface;

/**
 * Class CreateByPeerServer
 * @package Ivoz\Provider\Domain\Service\LcrRuleTarget
 */
class CreateByPeerServer implements PeerServerLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function __construct(EntityPersisterInterface $entityPersister)
    {
        $this->entityPersister = $entityPersister;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 20
        ];
    }

    /**
     * @param PeerServerInterface $entity
     * @param $isNew
     */
    public function execute(PeerServerInterface $entity, $isNew)
    {
        if (!$isNew) {
            return;
        }

        /** @var OutgoingRoutingInterface[] $outgoingRoutings */
        $outgoingRoutings = $entity->getPeeringContract()->getOutgoingRoutings();

        foreach ($outgoingRoutings as $outgoingRouting) {
            /** @var LcrRuleInterface[] $lcrRules */
            $lcrRules = $outgoingRouting->getLcrRules();

            foreach ($lcrRules as $lcrRule) {
                $lcrRuleTargetDto = LcrRuleTarget::createDto();

                $lcrRuleTargetDto
                    ->setRuleId($lcrRule->getId())
                    ->setGwId($entity->getLcrGateway()->getId())
                    ->setPriority($outgoingRouting->getPriority())
                    ->setWeight($outgoingRouting->getWeight())
                    ->setOutgoingRoutingId($outgoingRouting->getId());

                $this
                    ->entityPersister
                    ->persistDto($lcrRuleTargetDto);
            }
        }
    }
}