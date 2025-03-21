<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget;

use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayRepository;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTarget;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetDto;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetRepository;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

/**
 * Class TrunksLcrRuleTargetFactory
 * @package Ivoz\Kam\Domain\Service\TrunksLcrGateway
 */
class TrunksLcrRuleTargetFactory
{
    public function __construct(
        private TrunksLcrRuleTargetRepository $trunksLcrRuleTargetRepository,
        private TrunksLcrGatewayRepository $trunksLcrGatewayRepository,
        private EntityTools $entityTools
    ) {
    }

    /**
     * @return void
     */
    public function execute(
        OutgoingRoutingInterface $outgoingRouting
    ) {
        /**
         * @var TrunksLcrGatewayInterface[] $lcrGateways
         */

        $lcrGateways = array();

        switch ($outgoingRouting->getRoutingMode()) {
            case OutgoingRoutingInterface::ROUTINGMODE_STATIC:
                $carrier = $outgoingRouting->getCarrier();
                if (empty($carrier)) {
                    throw new \DomainException('Carrier not found');
                }

                $carrierServers = $carrier->getServers();

                // Static routes use selected carriers servers
                foreach ($carrierServers as $carrierServer) {
                    $lcrGateways[] = $carrierServer->getLcrGateway();
                }
                break;

            case OutgoingRoutingInterface::ROUTINGMODE_LCR:
                // Lcr Rules use special dummy gateway
                $lcrGateways[] = $this->trunksLcrGatewayRepository->findDummyGateway();
                break;

            case OutgoingRoutingInterface::ROUTINGMODE_BLOCK:
                // Blocking Rules use special dummy gateway
                $lcrGateways[] = $this->trunksLcrGatewayRepository->findDummyGateway();
                break;

            default:
                throw new \DomainException('Invalid Routing mode');
        }

        // On last carrierServer deletion, just leave
        if (empty($lcrGateways)) {
            return;
        }

        // Share route weight between all carrier servers inside the carrier
        // This way an even distribution between Carriers is achieved, no matter how many CarrierServers they have
        $ponderatedWeight = ceil(10 * $outgoingRouting->getWeight() / count($lcrGateways));

        $lcrRuleTargets = [];
        $lcrRules = $outgoingRouting->getLcrRules();
        // Create n x m LcrRuleTargets (n LcrRules; m LcrGateways)
        foreach ($lcrRules as $lcrRule) {
            foreach ($lcrGateways as $lcrGateway) {
                $lcrRuleTarget = $this->trunksLcrRuleTargetRepository->findRuleTarget(
                    $outgoingRouting,
                    $lcrRule,
                    $lcrGateway
                );

                /** @var TrunksLcrRuleTargetDto $lcrRuleTargetDto */
                $lcrRuleTargetDto = $lcrRuleTarget
                    ? $this->entityTools->entityToDto($lcrRuleTarget)
                    : TrunksLcrRuleTarget::createDto();

                $lcrRuleTargetDto
                    ->setRuleId($lcrRule->getId())
                    ->setGwId($lcrGateway->getId())
                    ->setPriority($outgoingRouting->getPriority())
                    ->setWeight((int) $ponderatedWeight)
                    ->setOutgoingRoutingId($outgoingRouting->getId());

                //we're creating new entities every time
                /** @var TrunksLcrRuleTargetInterface $lcrRuleTarget */
                $lcrRuleTarget = $this->entityTools->persistDto(
                    $lcrRuleTargetDto,
                    $lcrRuleTarget,
                    true
                );

                $lcrRuleTargets[] = $lcrRuleTarget;
            }
        }

        $outgoingRouting->replaceLcrRuleTargets(
            new ArrayCollection($lcrRuleTargets)
        );

        $this->entityTools->persist(
            $outgoingRouting
        );
    }
}
