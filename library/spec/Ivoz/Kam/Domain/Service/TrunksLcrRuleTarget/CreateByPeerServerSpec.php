<?php

namespace spec\Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget\TrunksLcrRuleTargetDto;
use Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget\CreateByOutgoingRouting;
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

    /**
     * @var CreateByOutgoingRouting
     */
    protected $lcrRuleTargetFactory;

    public function let(
        EntityPersisterInterface $entityPersister,
        CreateByOutgoingRouting $lcrRuleTargetFactory
    ) {
        $this->entityPersister = $entityPersister;
        $this->lcrRuleTargetFactory = $lcrRuleTargetFactory;

        $this->beConstructedWith(
            $entityPersister,
            $lcrRuleTargetFactory
        );
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


    function it_calls_lcrRuleTargetFactory_per_outgoingRouting(
        PeerServerInterface $entity,
        PeeringContractInterface $peeringContract,
        TrunksLcrGatewayInterface $lcrGateway,
        OutgoingRoutingInterface $outgoingRouting,
        TrunksLcrRuleInterface $lcrRule
    ) {
        $this->getterProphecy(
            $entity,
            [
                'getPeeringContract' => $peeringContract
            ]
        );

        $peeringContract
            ->getOutgoingRoutings()
            ->willReturn([$outgoingRouting])
            ->shouldBeCalled();

        $this
            ->lcrRuleTargetFactory
            ->execute($outgoingRouting)
            ->shouldBeCalled();

        $this->execute($entity, true);
    }
}
