<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTarget;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;
use Ivoz\Provider\Domain\Service\OutgoingRouting\OutgoingRoutingLifecycleEventHandlerInterface;

/**
 * Class CreateByOutgoingRouting
 * @package Ivoz\Kam\Domain\Service\TrunksLcrGateway
 */
class CreateByOutgoingRouting implements OutgoingRoutingLifecycleEventHandlerInterface
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

    public function execute(OutgoingRoutingInterface $outgoingRouting)
    {
        $peeringContract = $outgoingRouting->getPeeringContract();
        if (empty($peeringContract)) {
            throw new \DomainException('Peering Contract not found');
        }

        $peerServers = $peeringContract->getPeerServers();

        /**
         * @var TrunksLcrGatewayInterface[] $lcrGateways
         */
        $lcrGateways = array();

        /**
         * @var PeerServerInterface $peerServer
         */
        foreach ($peerServers as $peerServer) {
            $lcrGateways[] = $peerServer->getLcrGateway();
        }

        $lcrRules = $outgoingRouting->getLcrRules();
        // Create n x m LcrRuleTargets (n LcrRules; m LcrGateways)
        foreach ($lcrRules as $lcrRule) {
            foreach ($lcrGateways as $lcrGateway) {
                $lcrRuleTargetDto = TrunksLcrRuleTarget::createDto();

                $lcrRuleTargetDto
                    ->setRuleId($lcrRule->getId())
                    ->setGwId($lcrGateway->getId())
                    ->setPriority($outgoingRouting->getPriority())
                    ->setWeight($outgoingRouting->getWeight())
                    ->setOutgoingRoutingId($outgoingRouting->getId());

                //@todo double check this condition,
                //we're creating new entities every time
                $this->entityPersister->persistDto($lcrRuleTargetDto);
            }
        }
    }
}