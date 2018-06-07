<?php

namespace spec\Ivoz\Kam\Domain\Service\TrunksLcrGateway;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayDto;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrGateway\UpdateByPeerServer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UpdateByPeerServerSpec extends ObjectBehavior
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
        $this->shouldHaveType(UpdateByPeerServer::class);
    }

    function it_creates_lcr_gateway_if_none(
        PeerServerInterface $entity,
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

        $this->execute($entity, false);
    }

    function it_updates_lcr_gateway(
        PeerServerInterface $entity,
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

        $this->execute($entity, false);
    }
}
