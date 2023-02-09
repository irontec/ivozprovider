<?php

namespace spec\Ivoz\Provider\Domain\Service\Ivr;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Ivr\IvrDto;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrRepository;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Service\Ivr\UpdateByVoicemail;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateByVoicemailSpec extends ObjectBehavior
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
        $this->shouldHaveType(UpdateByVoicemail::class);
    }

    function it_cleans_up_no_input_voicemail(
        VoicemailInterface $voicemail,
        IvrInterface $ivr,
        IvrDto $ivrDto
    ) {
        $this
            ->ivrRepository
            ->findByVoicemail($voicemail)
            ->willReturn([$ivr]);

        $ivr
            ->getNoInputVoicemail()
            ->willReturn($voicemail)
            ->shouldBeCalled();

        $voicemail
            ->getId()
            ->willReturn(1)
            ->shouldBeCalled();

        $ivr
            ->getErrorVoicemail()
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
            ->setNoInputVoicemailId(null)
            ->willReturn($ivrDto)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto($ivrDto, $ivr)
            ->shouldBeCalled();

        $this->execute($voicemail);
    }

    function it_cleans_up_no_error_voicemail(
        VoicemailInterface $voicemail,
        IvrInterface $ivr,
        IvrDto $ivrDto
    ) {
        $this
            ->ivrRepository
            ->findByVoicemail($voicemail)
            ->willReturn([$ivr]);

        $ivr
            ->getNoInputVoicemail()
            ->willReturn(null)
            ->shouldBeCalled();

        $voicemail
            ->getId()
            ->willReturn(1)
            ->shouldBeCalled();

        $ivr
            ->getErrorVoicemail()
            ->willReturn($voicemail)
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
            ->setErrorVoicemailId(null)
            ->willReturn($ivrDto)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->persistDto($ivrDto, $ivr)
            ->shouldBeCalled();

        $this->execute($voicemail);
    }
}
