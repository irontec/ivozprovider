<?php

namespace spec\Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByDomain;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UpdateByDomainSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    ////////////////////////////////////////
    ///
    ////////////////////////////////////////

    /**
     * @var DomainInterface
     */
    protected $domain;

    /**
     * @var FriendInterface
     */
    protected $friend;

    /**
     * @var ResidentialDeviceInterface
     */
    protected $residentialDevice;

    /**
     * @var TerminalInterface
     */
    protected $terminal;

    /**
     * @var PsEndpointInterface
     */
    protected $psEndpoint;

    /**
     * @var PsEndpointDto
     */
    protected $psEndpointDto;

    public function let(EntityPersisterInterface $entityPersister)
    {
        $this->entityPersister = $entityPersister;

        $this->beConstructedWith($entityPersister);

        $this->prepareExecution();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByDomain::class);
    }

    function it_updates_psEndpoint_on_empty_friend_fromDomain()
    {
        $this
            ->domain
            ->getFriends(Argument::any())
            ->willReturn([
                $this->friend
            ]);

        $this
            ->domain
            ->getDomain()
            ->willReturn('testDomain');

        $this
            ->friend
            ->getFromDomain()
            ->willReturn(null);

        $this
            ->friend
            ->getAstPsEndpoint()
            ->willReturn($this->psEndpoint);

        $this
            ->psEndpointDto
            ->setFromDomain('testDomain')
            ->shouldBeCalled();

        $this
            ->entityPersister
            ->persistDto(
                $this->psEndpointDto,
                $this->psEndpoint
            )
            ->shouldBeCalled();

        $this->execute($this->domain);
    }

    function it_updates_psEndpoint_on_empty_residentialDevice_fromDomain()
    {
        $this
            ->domain
            ->getResidentialDevices(Argument::any())
            ->willReturn([
                $this->residentialDevice
            ]);

        $this
            ->domain
            ->getDomain()
            ->willReturn('testDomain');

        $this
            ->residentialDevice
            ->getFromDomain()
            ->willReturn(null);

        $this
            ->residentialDevice
            ->getAstPsEndpoint()
            ->willReturn($this->psEndpoint);

        $this
            ->psEndpointDto
            ->setFromDomain('testDomain')
            ->shouldBeCalled();

        $this
            ->entityPersister
            ->persistDto(
                $this->psEndpointDto,
                $this->psEndpoint
            )
            ->shouldBeCalled();

        $this->execute($this->domain);
    }

    function it_updates_terminals_psEndpoint()
    {
        $this
            ->domain
            ->getTerminals(Argument::any())
            ->willReturn([
                $this->terminal
            ]);

        $this
            ->domain
            ->getDomain()
            ->willReturn('testDomain');

        $this
            ->terminal
            ->getAstPsEndpoint()
            ->willReturn($this->psEndpoint);

        $this
            ->psEndpointDto
            ->setFromDomain('testDomain')
            ->shouldBeCalled();

        $this
            ->entityPersister
            ->persistDto(
                $this->psEndpointDto,
                $this->psEndpoint
            )
            ->shouldBeCalled();

        $this->execute($this->domain);
    }

    function it_queues_operations()
    {
        $this
            ->entityPersister
            ->dispatchQueued()
            ->shouldBeCalled();

        $this->execute($this->domain);
    }

    protected function prepareExecution()
    {
        $this->domain = $this->getTestDouble(
            DomainInterface::class
        );
        $this->friend = $this->getTestDouble(
            FriendInterface::class
        );
        $this->residentialDevice = $this->getTestDouble(
            ResidentialDeviceInterface::class
        );
        $this->terminal = $this->getTestDouble(
            TerminalInterface::class
        );
        $this->psEndpoint = $this->getTestDouble(
            PsEndpointInterface::class
        );
        $this->psEndpointDto = $this->getTestDouble(
            PsEndpointDto::class
        );

        $this
            ->domain
            ->getFriends(
                Argument::any()
            )
            ->willReturn([]);

        $this
            ->domain
            ->getResidentialDevices(
                Argument::any()
            )
            ->willReturn([]);

        $this
            ->domain
            ->getTerminals(
                Argument::any()
            )
            ->willReturn([]);

        $this
            ->entityPersister
            ->dispatchQueued()
            ->willReturn(null);

        $this
            ->entityPersister
            ->persistDto(
                $this->psEndpointDto,
                $this->psEndpoint
            );

        $this
            ->psEndpoint
            ->toDto(
                Argument::any()
            )
            ->willReturn(
                $this->psEndpointDto
            );
    }
}
