<?php

namespace spec\Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByPickUpRelUser;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UpdateByPickUpRelUserSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    //////////////////////////////////////
    ///
    //////////////////////////////////////

    /**
     * @var PickUpRelUserInterface
     */
    protected $pickUpRelUser;

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
        $this->shouldHaveType(UpdateByPickUpRelUser::class);
    }

    function it_returns_on_empty_user()
    {
        $this
            ->pickUpRelUser
            ->getUser()
            ->willReturn(null)
            ->shouldBeCalled();

        $this
            ->user
            ->getEndpoint()
            ->shouldNotBeCalled();

        $this->execute($this->pickUpRelUser);
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
                Argument::type(PsEndpointInterface::class)
            )
            ->shouldNotBeCalled();

        $this->execute($this->pickUpRelUser);
    }

    function it_updates_named_pickup_group()
    {
        $this->user
            ->getPickUpGroupsIds()
            ->willReturn('1,2,3')
            ->shouldBeCalled();

        $this
            ->psEndpointDto
            ->setNamedPickupGroup('1,2,3')
            ->shouldBeCalled();

        $this->execute($this->pickUpRelUser);
    }


    protected function prepareExecution()
    {
        $this->pickUpRelUser = $this->getTestDouble(
            PickUpRelUserInterface::class
        );
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
            ->pickUpRelUser
            ->getUser()
            ->willReturn($this->user);

        $this->getterProphecy(
            $this->user,
            [
                'getEndpoint' => $this->psEndpoint,
                'getPickUpGroupsIds' => ''
            ],
            false
        );

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
