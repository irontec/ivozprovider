<?php

namespace spec\Ivoz\Provider\Domain\Service\Ivr;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Ivr\IvrDto;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Service\Ivr\UpdateByUser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateByUserSpec extends ObjectBehavior
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var IvrRepository
     */
    protected $ivrRepository;

    public function let(
        EntityTools $entityTools,
        IvrRepository $ivrRepository
    ) {
        $this->entityTools = $entityTools;
        $this->ivrRepository = $ivrRepository;

        $this->beConstructedWith($entityTools, $ivrRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByUser::class);
    }

    function it_cleans_up_no_input_voicemail_user(
        UserInterface $user,
        IvrInterface $ivr,
        IvrDto $ivrDto
    ) {
        $this
            ->ivrRepository
            ->findByUser($user)
            ->willReturn([$ivr]);

        $ivr
            ->getNoInputVoiceMailUser()
            ->willReturn($user)
            ->shouldBeCalled();

        $user
            ->getId()
            ->willReturn(1)
            ->shouldBeCalled();

        $ivr
            ->getErrorVoiceMailUser()
            ->willReturn(null)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto($ivr)
            ->willReturn($ivrDto);

        $ivrDto
            ->setNoInputRouteType(null)
            ->willReturn($ivrDto)
            ->shouldBeCalled();

        $ivrDto
            ->setNoInputVoiceMailUserId(null)
            ->willReturn($ivrDto)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto($ivrDto, $ivr)
            ->shouldBeCalled();

        $this->execute($user);
    }

    function it_cleans_up_no_error_voicemail_user(
        UserInterface $user,
        IvrInterface $ivr,
        IvrDto $ivrDto
    ) {
        $this
            ->ivrRepository
            ->findByUser($user)
            ->willReturn([$ivr]);

        $ivr
            ->getNoInputVoiceMailUser()
            ->willReturn(null)
            ->shouldBeCalled();

        $user
            ->getId()
            ->willReturn(1)
            ->shouldBeCalled();

        $ivr
            ->getErrorVoiceMailUser()
            ->willReturn($user)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto($ivr)
            ->willReturn($ivrDto);

        $ivrDto
            ->setErrorRouteType(null)
            ->willReturn($ivrDto)
            ->shouldBeCalled();

        $ivrDto
            ->setErrorVoiceMailUserId(null)
            ->willReturn($ivrDto)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto($ivrDto, $ivr)
            ->shouldBeCalled();

        $this->execute($user);
    }
}
