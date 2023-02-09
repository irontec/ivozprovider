<?php

namespace spec\Ivoz\Provider\Domain\Model\Ivr;

use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use Ivoz\Provider\Domain\Model\Ivr\IvrDto;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailDto;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

class IvrSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var IvrDto
     */
    protected $dto;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let()
    {
        $company = $this->getInstance(
            Company::class
        );
        $companyDto = new CompanyDto();
        $this->dto = $dto = new IvrDto();
        $dto
            ->setName('Name')
            ->setTimeout(5)
            ->setMaxDigits(2)
            ->setAllowExtensions(1)
            ->setCompany($companyDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$companyDto, $company]
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Ivr::class);
    }

    function it_resets_no_input_targets_but_current()
    {
        $timeoutExtension = $this->getInstance(
            Extension::class
        );
        $timeoutExtensionDto = new ExtensionDto();

        $timeoutVoicemail = $this->getInstance(
            Voicemail::class
        );
        $timeoutVoicemailDto = new VoicemailDto();

        $this
            ->dto
            ->setNoInputNumberValue('1234')
            ->setNoInputExtension($timeoutExtensionDto)
            ->setNoInputVoicemail($timeoutVoicemailDto);

        $this->transformer->appendFixedTransforms([
            [$timeoutVoicemailDto, $timeoutVoicemail],
            [$timeoutExtensionDto, $timeoutExtension]
        ]);

        $this
            ->getNoInputExtension()
            ->shouldBe(null);

        $this
            ->getNoInputVoicemail()
            ->shouldBe(null);
    }

    function it_resets_error_targets_but_current()
    {
        $timeoutExtension = $this->getInstance(
            Extension::class
        );
        $timeoutExtensionDto = new ExtensionDto();

        $timeoutVoicemail = $this->getInstance(
            Voicemail::class
        );
        $timeoutVoicemailDto = new VoicemailDto();

        $this
            ->dto
            ->setNoInputNumberValue('1234')
            ->setNoInputExtension($timeoutExtensionDto)
            ->setNoInputVoicemail($timeoutVoicemailDto);

        $this->transformer->appendFixedTransforms([
            [$timeoutVoicemailDto, $timeoutVoicemail],
            [$timeoutExtensionDto, $timeoutExtension]
        ]);

        $this
            ->getErrorExtension()
            ->shouldBe(null);

        $this
            ->getErrorVoicemail()
            ->shouldBe(null);
    }
}
