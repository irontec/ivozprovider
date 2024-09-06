<?php

namespace spec\Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository;
use Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByUserTerminalUnassignment;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UpdateByUserTerminalUnassignmentSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var EntityTools
     */
    protected $psEndpointRepository;

    /////////////////////////////////
    ///
    /////////////////////////////////

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var PsEndpointInterface
     */
    protected $psEndpoint;

    /**
     * @var PsEndpointDto
     */
    protected $psEndpointDto;

    public function let(
        EntityTools $entityTools,
        PsEndpointRepository $psEndpointRepository
    ) {
        $this->entityTools = $entityTools;
        $this->psEndpointRepository = $psEndpointRepository;

        $this->beConstructedWith(
            $entityTools,
            $psEndpointRepository
        );

        $this->prepareExecution();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByUserTerminalUnassignment::class);
    }

    function it_returns_on_unchanged_terminal()
    {
        $this
            ->user
            ->hasChanged('terminalId')
            ->willReturn(false)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto(
                Argument::any()
            )
            ->shouldNotBeCalled();

        $this->execute($this->user);
    }

    function it_returns_on_invalid_endpoint()
    {
        $this
            ->user
            ->hasChanged('terminalId')
            ->willReturn(true)
            ->shouldBeCalled();

        $this
            ->user
            ->getInitialValue('terminalId')
            ->willReturn(null)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto(
                Argument::any()
            )
            ->shouldNotBeCalled();

        $this->execute($this->user);
    }

    function it_updates_ps_endpoint()
    {
        $this
            ->user
            ->hasChanged('terminalId')
            ->willReturn(true)
            ->shouldBeCalled();

        $this
            ->user
            ->getInitialValue('terminalId')
            ->willReturn(1)
            ->shouldBeCalled();

        $this
            ->psEndpointRepository
            ->findOneByTerminalId(1)
            ->willReturn($this->psEndpoint)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto($this->psEndpoint)
            ->willReturn($this->psEndpointDto);

        $this
            ->psEndpointDto
            ->setCallerid(null)
            ->willReturn($this->psEndpointDto)
            ->shouldBeCalled();

        $this
            ->psEndpointDto
            ->setMailboxes(null)
            ->willReturn($this->psEndpointDto)
            ->shouldBeCalled();

        $this
            ->psEndpointDto
            ->setHintExtension(null)
            ->willReturn($this->psEndpointDto)
            ->shouldBeCalled();

        $this
            ->psEndpointDto
            ->setNamedPickupGroup(null)
            ->willReturn($this->psEndpointDto)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto(
                $this->psEndpointDto,
                $this->psEndpoint,
                false
            )
            ->willReturn($this->psEndpoint);

        $this->execute($this->user);
    }

    function prepareExecution()
    {
        $this->user = $this->getTestDouble(
            UserInterface::class
        );
        $this->psEndpoint = $this->getTestDouble(
            PsEndpointInterface::class
        );
        $this->psEndpointDto = $this->getTestDouble(
            PsEndpointDto::class
        );

        $this
            ->user
            ->getEndpoint()
            ->willReturn($this->psEndpoint);

        $this
            ->entityTools
            ->entityToDto($this->psEndpoint)
            ->willReturn($this->psEndpointDto);

        $this
            ->entityTools
            ->persistDto(
                $this->psEndpointDto,
                $this->psEndpoint,
                false
            )
            ->willReturn($this->psEndpoint);
    }
}
