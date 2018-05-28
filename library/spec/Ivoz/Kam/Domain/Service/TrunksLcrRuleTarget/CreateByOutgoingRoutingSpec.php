<?php

namespace spec\Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetDto;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget\CreateByOutgoingRouting;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class CreateByOutgoingRoutingSpec extends ObjectBehavior
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
        $this->shouldHaveType(CreateByOutgoingRouting::class);
    }

    function it_throws_exeption_on_empty_peeringContract(
        OutgoingRoutingInterface $outgoingRouting
    ) {
        $exception = new \Exception('Peering Contract not found');
        $this
            ->shouldThrow($exception)
            ->during('execute', [$outgoingRouting]);
    }

    function it_creates_lcr_rule_targets(
        OutgoingRoutingInterface $outgoingRouting,
        PeeringContractInterface $peeringContract,
        PeerServerInterface $peerServer,
        TrunksLcrGatewayInterface $lcrGateway,
        TrunksLcrRuleInterface $lcrRule
    ) {
        $this->getterProphecy(
            $outgoingRouting,
            [
                'getPeeringContract' => $peeringContract,
                'getLcrRules' => [$lcrRule],
                'getPriority' => 1,
                'getWeight' => 2,
                'getId' => 3
            ]
        );

        $peeringContract
            ->getPeerServers()
            ->willReturn([$peerServer]);

        $peerServer
            ->getLcrGateway()
            ->willReturn($lcrGateway)
            ->shouldBeCalled();

        $lcrRule
            ->getId()
            ->willReturn(4);

        $lcrGateway
            ->getId()
            ->willReturn(5);

        $this
            ->entityPersister
            ->persistDto(Argument::type(TrunksLcrRuleTargetDto::class))
            ->shouldBeCalled();

        $this->execute($outgoingRouting);
    }
}
