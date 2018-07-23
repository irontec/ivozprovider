<?php

namespace spec\Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget\CreateByOutgoingRouting;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget\CreateByCarrierServer;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;

class CreateByCarrierServerSpec extends ObjectBehavior
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
        $this->shouldHaveType(CreateByCarrierServer::class);
    }

    function it_does_nothing_if_not_new(
        CarrierServerInterface $entity,
        CarrierInterface $carrier
    ) {
        $entity
            ->getCarrier()
            ->willReturn($carrier)
            ->shouldNotBeCalled();

        $this->execute($entity, false);
    }


    function it_calls_lcrRuleTargetFactory_per_outgoingRouting(
        CarrierServerInterface $entity,
        CarrierInterface $carrier,
        TrunksLcrGatewayInterface $lcrGateway,
        OutgoingRoutingInterface $outgoingRouting,
        TrunksLcrRuleInterface $lcrRule
    ) {
        $this->getterProphecy(
            $entity,
            [
                'getCarrier' => $carrier
            ]
        );

        $carrier
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
