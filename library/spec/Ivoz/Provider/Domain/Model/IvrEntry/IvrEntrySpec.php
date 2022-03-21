<?php

namespace spec\Ivoz\Provider\Domain\Model\IvrEntry;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRoute;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteDto;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrDto;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\IvrEntry\IvrEntry;
use Ivoz\Provider\Domain\Model\IvrEntry\IvrEntryDto;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailDto;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

class IvrEntrySpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var IvrEntryDto
     */
    protected $dto;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let(
        IvrInterface $ivr
    ) {
        $ivrDto = new IvrDto();
        $this->dto = $dto = new IvrEntryDto();
        $dto
            ->setEntry('Entry')
            ->setRouteType('number')
            ->setNumberValue('946002020')
            ->setIvr($ivrDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$ivrDto, $ivr->getWrappedObject()]
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(IvrEntry::class);
    }

    function it_resets_targets_but_current()
    {
        $extension = $this->getInstance(
            Extension::class
        );
        $extensionDto = new ExtensionDto();

        $voicemail = $this->getInstance(
            Voicemail::class
        );
        $voicemailDto = new VoicemailDto();

        $conditionalRoute = $this->getInstance(
            ConditionalRoute::class
        );
        $conditionalRouteDto = new ConditionalRouteDto();

        $dto = clone $this->dto;
        $dto
            ->setRouteType('number')
            ->setNumberValue('946002020')
            ->setExtension($extensionDto)
            ->setVoicemail($voicemailDto)
            ->setConditionalRoute($conditionalRouteDto);

        $this
            ->transformer
            ->appendFixedTransforms([
                [$extensionDto, $extension],
                [$voicemailDto, $voicemail],
                [$conditionalRouteDto, $conditionalRoute],
            ]);

        $this->updateFromDto(
            $dto,
            $this->transformer
        );

        $this
            ->getExtension()
            ->shouldBe(null);

        $this
            ->getVoicemail()
            ->shouldBe(null);

        $this
            ->getConditionalRoute()
            ->shouldBe(null);
    }
}
