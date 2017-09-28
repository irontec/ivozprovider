<?php
namespace Ivoz\Provider\Domain\Service\LcrGateway;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayInterface;
use Ivoz\Provider\Domain\Model\LcrRuleTarget\LcrRuleTarget;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;

/**
 * Class CreateByOutgoingRouting
 * @package Ivoz\Provider\Domain\Service\LcrGateway
 */
class CreateByOutgoingRouting
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function __construct(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $this->entityPersister;
    }

    public function execute(OutgoingRoutingInterface $outgoingRouting)
    {
        $peeringContract = $outgoingRouting->getPeeringContract();
        if (empty($peeringContract)) {
            throw new \Exception('Peering Contract not found');
        }

        $peerServers = $peeringContract->getPeerServers();

        /**
         * @var LcrGatewayInterface[] $lcrGateways
         */
        $lcrGateways = array();

        /**
         * @var PeerServerInterface $peerServer
         */
        foreach ($peerServers as $peerServer) {
            $lcrGateways = array_merge($lcrGateways, $peerServer->getLcrGateways());
        }

        $lcrRules = $outgoingRouting->getLcrRules();
        // Create n x m LcrRuleTargets (n LcrRules; m LcrGateways)
        foreach ($lcrRules as $lcrRule) {
            foreach ($lcrGateways as $lcrGateway) {
                $lcrRuleTargetDto = LcrRuleTarget::createDTO();

                $lcrRuleTargetDto
                    ->setRuleId($lcrRule->getId())
                    ->setGwId($lcrGateway->getId())
                    ->setPriority($outgoingRouting->getPriority())
                    ->setWeight($outgoingRouting->getWeight())
                    ->setOutgoingRoutingId($outgoingRouting->getId());

                $this->entityPersister->persistDto($lcrRuleTargetDto);
            }
        }
    }
}