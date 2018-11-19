<?php

namespace spec\Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByUser;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateByUserSpec extends ObjectBehavior
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
        $this->shouldHaveType(UpdateByUser::class);
    }

    function it_updates_named_pickup_group(
        UserInterface $user,
        PsEndpointInterface $psEndpoint,
        PsEndpointDto $psEndpointDto
    ) {
        $user
            ->getEndpoint()
            ->willReturn($psEndpoint);

        $this
            ->entityTools
            ->entityToDto($psEndpoint)
            ->willReturn($psEndpointDto);

        $user
            ->getFullName()
            ->willReturn('Name');

        $user
            ->getExtensionNumber()
            ->willReturn('ExtensionNumber');

        $psEndpointDto
            ->setCallerid('Name <ExtensionNumber>')
            ->willReturn($psEndpointDto)
            ->shouldBeCalled();

        $user
            ->getVoiceMail()
            ->willReturn('userVoiceMail');

        $psEndpointDto
            ->setMailboxes('userVoiceMail')
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto($psEndpointDto, $psEndpoint, false)
            ->shouldBeCalled();

        $this->execute($user);
    }
}
