<?php

namespace spec\Ivoz\Provider\Domain\Service\LcrGateway;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayDto;
use Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayInterface;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;
use Ivoz\Provider\Domain\Service\LcrGateway\UpdateByPeerServer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UpdateByPeerServerSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function let(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;

        $this->beConstructedWith($entityPersister);
    }


    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByPeerServer::class);
    }

    function it_creates_lcr_gateway_if_none(
        PeerServerInterface $entity,
        LcrGatewayInterface $lcrGateway
    ) {
        $this->getterProphecy(
            $entity,
            [
                'getLcrGateway' => null,
                'getName' => null,
                'getIp' => null,
                'getHostname' => null,
                'getPort' => null,
                'getParams' => null,
                'getUriScheme' => null,
                'getTransport' => null,
                'getFlags' => null,
                'getId' => null
            ]
        );

        $this
            ->entityPersister
            ->persistDto(
                Argument::type(LcrGatewayDto::class),
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
        LcrGatewayInterface $lcrGateway
    ) {
        $this->getterProphecy(
            $entity,
            [
                'getLcrGateway' => $lcrGateway,
                'getName' => null,
                'getIp' => null,
                'getHostname' => null,
                'getPort' => null,
                'getParams' => null,
                'getUriScheme' => null,
                'getTransport' => null,
                'getFlags' => null,
                'getId' => null
            ]
        );

        $dto = new LcrGatewayDto();

        $lcrGateway
            ->toDto()
            ->willReturn($dto)
            ->shouldBeCalled();

        $this
            ->entityPersister
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
