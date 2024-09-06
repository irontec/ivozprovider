<?php

namespace spec\Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByUserDeleted;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UpdateByUserDeletedSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityTools
     */
    protected $entityTools;

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
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;

        $this->beConstructedWith($entityTools);

        $this->prepareExecution();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByUserDeleted::class);
    }

    function it_returns_on_empty_endpoint()
    {
        $this
            ->user
            ->getEndpoint()
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

    function it_sets_callerid()
    {
        $this
            ->psEndpointDto
            ->setCallerid(null)
            ->willReturn($this->psEndpointDto)
            ->shouldBeCalled();

        $this->execute($this->user);
    }

    function it_sets_voicemail()
    {
        $this
            ->psEndpointDto
            ->setMailboxes(null)
            ->willReturn($this->psEndpointDto)
            ->shouldBeCalled();

        $this->execute($this->user);
    }

    function it_sets_hint_extension()
    {
        $this
            ->psEndpointDto
            ->setHintExtension(null)
            ->willReturn($this->psEndpointDto)
            ->shouldBeCalled();

        $this->execute($this->user);
    }

    function it_sets_named_pickup_group()
    {
        $this
            ->psEndpointDto
            ->setNamedPickupGroup(null)
            ->willReturn($this->psEndpointDto)
            ->shouldBeCalled();

        $this->execute($this->user);
    }

    function it_sets_extension()
    {
        $this
            ->psEndpointDto
            ->setExtension(null)
            ->willReturn($this->psEndpointDto)
            ->shouldBeCalled();

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
