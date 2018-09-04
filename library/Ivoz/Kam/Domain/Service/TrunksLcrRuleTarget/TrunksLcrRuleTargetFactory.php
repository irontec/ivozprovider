<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget;

use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayRepository;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleRepository;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTarget;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetRepository;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

/**
 * Class TrunksLcrRuleTargetFactory
 * @package Ivoz\Kam\Domain\Service\TrunksLcrGateway
 */
class TrunksLcrRuleTargetFactory
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
     * @var TrunksLcrGatewayRepository
     */
    protected $trunksLcrGatewayRepository;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        TrunksLcrRuleTargetRepository $trunksLcrRuleTargetRepository,
        TrunksLcrGatewayRepository $trunksLcrGatewayRepository,
        EntityTools $entityTools
    ) {
        $this->entityPersister = $entityPersister;
        $this->trunksLcrRuleTargetRepository = $trunksLcrRuleTargetRepository;
        $this->trunksLcrGatewayRepository = $trunksLcrGatewayRepository;
        $this->entityTools = $entityTools;
    }

    public function execute(
        OutgoingRoutingInterface $outgoingRouting
    )
    {
        /**
         * @var TrunksLcrGatewayInterface[] $lcrGateways
         */

        $lcrGateways = array();

        switch ($outgoingRouting->getRoutingMode()) {
            case OutgoingRouting::MODE_STATIC:
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

            case OutgoingRouting::MODE_LCR:
                // Lcr Rules use special dummy gateway
                $lcrGateways[] = $this->trunksLcrGatewayRepository->findDummyGateway();
                break;

            default:
                throw new \DomainException('Invalid Routing mode');
        }

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
                $lcrRuleTargets[] = $this->entityPersister->persistDto(
                    $lcrRuleTargetDto,
                    $lcrRuleTarget,
                    true
                );
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