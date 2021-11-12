<?php

namespace spec\Ivoz\Ast\Domain\Service\PsEndpoint;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Ivoz\Ast\Domain\Service\PsEndpoint\UpdateByExtension;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use PhpSpec\ObjectBehavior;

class UpdateByExtensionSpec extends ObjectBehavior
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
        $this->shouldHaveType(UpdateByExtension::class);
    }

    function it_ignores_non_user_extensions(
        ExtensionInterface $extension
    ) {
        $extension
            ->getUser()
            ->willReturn(null)
            ->shouldBecalled();

        $this->execute($extension);
    }

    function it_checks_that_its_main_user_extension(
        ExtensionInterface $extension,
        UserInterface $user
    ) {
        $extension
            ->getId()
            ->willReturn(101);

        $extension
            ->getUser()
            ->willReturn($user)
            ->shouldBecalled();

        $user
            ->getExtension()
            ->willReturn($extension);

        $user
            ->getTerminal()
            ->shouldBeCalled();

        $this->execute($extension);
    }

    function it_updates_psEndpoint(
        ExtensionInterface $extension,
        UserInterface $user,
        TerminalInterface $terminal,
        VoicemailInterface $voicemail,
        PsEndpointInterface $psEndpoint,
        PsEndpointDto $psEndpointDto
    ) {
        $extension
            ->getId()
            ->willReturn(101);

        $extension
            ->getUser()
            ->willReturn($user)
            ->shouldBecalled();

        $user
            ->getExtension()
            ->willReturn($extension);

        $user
            ->getTerminal()
            ->willReturn($terminal)
            ->shouldBeCalled();

        $terminal
            ->getPsEndpoint()
            ->willReturn($psEndpoint)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto($psEndpoint)
            ->willReturn($psEndpointDto)
            ->shouldBeCalled();

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
            ->getVoicemail()
            ->willReturn($voicemail)
            ->shouldBeCalled();

        $voicemail->getVoicemailName()
            ->willReturn('name1@company2');

        $psEndpointDto
            ->setMailboxes('name1@company2')
            ->willReturn($psEndpointDto)
            ->shouldBeCalled();

        $user
            ->getPickUpGroupsIds()
            ->willReturn(1);

        $psEndpointDto
            ->setNamedPickupGroup(1)
            ->willReturn($psEndpointDto)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto(
                $psEndpointDto,
                $psEndpoint
            )->shouldBeCalled();

        $this->execute($extension);
    }
}
