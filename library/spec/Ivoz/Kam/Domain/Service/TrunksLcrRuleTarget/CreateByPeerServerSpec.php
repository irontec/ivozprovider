<?php

namespace spec\Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetDto;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget\CreateByPeerServer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class CreateByPeerServerSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function let(EntityPersisterInterface $entityPersister)
    {
        $this->entityPersister = $entityPersister;
        $this->beConstructedWith($entityPersister);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CreateByPeerServer::class);
    }

    function it_does_nothing_if_not_new(
        PeerServerInterface $entity,
        PeeringContractInterface $peeringContract
    ) {
        $entity
            ->getPeeringContract()
            ->willReturn($peeringContract)
            ->shouldNotBeCalled();

        $this->execute($entity, false);
    }


    function it_creates_new_lcrRuleTarges(
        PeerServerInterface $entity,
        PeeringContractInterface $peeringContract,
        TrunksLcrGatewayInterface $lcrGateway,
        OutgoingRoutingInterface $outgoingRouting,
        TrunksLcrRuleInterface $lcrRule
    ) {
        $this->getterProphecy(
            $entity,
            [
                'getPeeringContract' => $peeringContract,
                'getLcrGateway' => $lcrGateway
            ]
        );

        $peeringContract
            ->getOutgoingRoutings()
            ->willReturn([$outgoingRouting])
            ->shouldBeCalled();

        $this->getterProphecy(
            $outgoingRouting,
            [
                'getLcrRules' => [$lcrRule],
                'getPriority' => ($priority = 8),
                'getWeight' => ($weight = 2),
                'getId' => ($outgoingRoutingId = 3)
            ]
        );

        $lcrGateway
            ->getId()
            ->willReturn($lcrGatewayId = 1);

        $lcrRule
            ->getId()
            ->willReturn($lcrRuleId = 1);

        $dto = new TrunksLcrRuleTargetDto();
        $dto
            ->setRuleId($lcrGatewayId)
            ->setGwId($lcrRuleId)
            ->setPriority($priority)
            ->setWeight($weight)
            ->setOutgoingRoutingId($outgoingRoutingId);

        $this
            ->entityPersister
            ->persistDto($dto)
            ->shouldBeCalled();

        $this->execute($entity, true);
    }
}
