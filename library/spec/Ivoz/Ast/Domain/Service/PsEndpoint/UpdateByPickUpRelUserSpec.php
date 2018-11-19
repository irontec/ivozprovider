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

class UpdateByPickUpRelUserSpec extends ObjectBehavior
{
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
        $this->shouldHaveType(UpdateByPickUpRelUser::class);
    }


    function it_updates_named_pickup_group(
        PickUpRelUserInterface $pickUpRelUser,
        UserInterface $user,
        PsEndpointInterface $psEndpoint,
        PsEndpointDto $psEndpointDto
    ) {
        $pickUpRelUser
            ->getUser()
            ->willReturn($user);

        $user
            ->getEndpoint()
            ->willReturn($psEndpoint);

        $this
            ->entityTools
            ->entityToDto($psEndpoint)
            ->willReturn($psEndpointDto);

        $user
            ->getPickUpGroupsIds()
            ->willReturn('1,2,3');

        $psEndpointDto
            ->setNamedPickupGroup('1,2,3')
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto(
                $psEndpointDto,
                $psEndpoint,
                false
            )->shouldBeCalled();

        $this->execute($pickUpRelUser);
    }
}
