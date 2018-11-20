<?php

namespace spec\Ivoz\Kam\Domain\Service\TrunksLcrGateway;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayDto;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrGateway\UpdateByCarrierServer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UpdateByCarrierServerSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function let(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;

        $this->beConstructedWith($entityTools);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByCarrierServer::class);
    }

    function it_creates_lcr_gateway_if_none(
        CarrierServerInterface $entity,
        TrunksLcrGatewayInterface $lcrGateway
    ) {
        $this->getterProphecy(
            $entity,
            [
                'getLcrGateway' => null,
                'getName' => null,
                'getIp' => null,
                'getHostname' => null,
                'getPort' => null,
                'getUriScheme' => null,
                'getTransport' => null,
                'getId' => null
            ]
        );

        $this
            ->entityTools
            ->persistDto(
                Argument::type(TrunksLcrGatewayDto::class),
                null,
                true
            )
            ->willReturn($lcrGateway);

        $entity
            ->setLcrGateway($lcrGateway)
            ->shouldBeCalled();

        $this->entityTools
            ->persist($entity)
            ->shouldBeCalled();

        $this->execute($entity);
    }

    function it_updates_lcr_gateway(
        CarrierServerInterface $entity,
        TrunksLcrGatewayInterface $lcrGateway
    ) {
        $this->getterProphecy(
            $entity,
            [
                'getLcrGateway' => $lcrGateway,
                'getName' => null,
                'getIp' => null,
                'getHostname' => null,
                'getPort' => null,
                'getUriScheme' => null,
                'getTransport' => null,
                'getId' => null
            ]
        );

        $dto = new TrunksLcrGatewayDto();

        $lcrGateway
            ->toDto()
            ->willReturn($dto)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto(
                $dto,
                $lcrGateway,
                true
            )
            ->willReturn($lcrGateway);

        $entity
            ->setLcrGateway($lcrGateway)
            ->shouldBeCalled();

        $this->entityTools
            ->persist($entity)
            ->shouldBeCalled();

        $this->execute($entity);
    }
}
