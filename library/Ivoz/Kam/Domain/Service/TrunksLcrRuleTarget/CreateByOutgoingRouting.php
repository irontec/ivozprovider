<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleRepository;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTarget;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetRepository;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;

/**
 * Class CreateByOutgoingRouting
 * @package Ivoz\Kam\Domain\Service\TrunksLcrGateway
 */
class CreateByOutgoingRouting
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var TrunksLcrRuleRepository
     */
    protected $trunksLcrRuleTargetRepository;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        TrunksLcrRuleTargetRepository $trunksLcrRuleTargetRepository,
        EntityTools $entityTools
    ) {
        $this->entityPersister = $entityPersister;
        $this->trunksLcrRuleTargetRepository = $trunksLcrRuleTargetRepository;
        $this->entityTools = $entityTools;
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

                $lcrRuleTarget = $this->trunksLcrRuleTargetRepository->findRuleTarget(
                    $outgoingRouting,
                    $lcrRule,
                    $lcrGateway
                );

                $lcrRuleTargetDto = $lcrRuleTarget
                    ? $this->entityTools->entityToDto($lcrRuleTarget)
                    : TrunksLcrRuleTarget::createDto();

                $lcrRuleTargetDto
                    ->setRuleId($lcrRule->getId())
                    ->setGwId($lcrGateway->getId())
                    ->setPriority($outgoingRouting->getPriority())
                    ->setWeight($outgoingRouting->getWeight())
                    ->setOutgoingRoutingId($outgoingRouting->getId());

                //we're creating new entities every time
                $this->entityPersister->persistDto($lcrRuleTargetDto, $lcrRuleTarget);
            }
        }
    }
}