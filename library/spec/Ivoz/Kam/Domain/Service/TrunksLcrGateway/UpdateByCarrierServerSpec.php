<?php

namespace spec\Ivoz\Kam\Domain\Service\TrunksLcrGateway;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayDto;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerDto;
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

    protected $carrierServer;
    protected $carrierServerDto;

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

    private function prepareExecution(
        TrunksLcrGatewayInterface $lcrGateway = null
    ) {
        $this->carrierServer = $this->getTestDouble(
            CarrierServerInterface::class
        );

        $this->getterProphecy(
            $this->carrierServer,
            [
                'getLcrGateway' => $lcrGateway
            ],
            true
        );

        $this->carrierServerDto = $this->getTestDouble(
            CarrierServerDto::class
        );

        $this
            ->entityTools
            ->persistDto(
                Argument::type(TrunksLcrGatewayDto::class),
                $lcrGateway,
                true
            )
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto(
                $this->carrierServer
            )
            ->willReturn(
                $this->carrierServerDto
            );

        $this
            ->entityTools
            ->persistDto(
                $this->carrierServerDto,
                $this->carrierServer
            )
            ->shouldBeCalled();
    }

    function it_creates_lcr_gateway_if_none()
    {
        $lcrGateway = null;
        $this->prepareExecution(
            $lcrGateway
        );

        $this
            ->entityTools
            ->persistDto(
                Argument::type(TrunksLcrGatewayDto::class),
                Argument::type(TrunksLcrGatewayinterface::class),
                true
            );

        $this
            ->carrierServerDto
            ->setLcrGateway(
                Argument::type(TrunksLcrGatewayDto::class)
            )
            ->shouldBeCalled();

        $this->execute(
            $this->carrierServer
        );
    }

    function it_updates_lcr_gateway()
    {
        $lcrGateway = $this->getTestDouble(
            TrunksLcrGatewayInterface::class,
            false
        );

        $lcrGatewayDto = new TrunksLcrGatewayDto();
        $lcrGateway
            ->toDto()
            ->willReturn($lcrGatewayDto)
            ->shouldBeCalled();

        $this->prepareExecution(
            $lcrGateway
        );

        $this
            ->entityTools
            ->persistDto(
                $lcrGatewayDto,
                $lcrGateway,
                true
            )
            ->shouldBeCalled();

        $this
            ->carrierServerDto
            ->setLcrGateway(
                $lcrGatewayDto
            )
            ->shouldBeCalled();

        $this->execute(
            $this->carrierServer
        );
    }
}
