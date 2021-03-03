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
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
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

        $timeoutVoiceMailUser = $this->getInstance(
            User::class
        );
        $timeoutVoiceMailUserDto = new UserDto();

        $this
            ->dto
            ->setNoInputNumberValue('1234')
            ->setNoInputExtension($timeoutExtensionDto)
            ->setNoInputVoiceMailUser($timeoutVoiceMailUserDto);

        $this->transformer->appendFixedTransforms([
            [$timeoutVoiceMailUserDto, $timeoutVoiceMailUser],
            [$timeoutExtensionDto, $timeoutExtension]
        ]);

        $this
            ->getNoInputExtension()
            ->shouldBe(null);

        $this
            ->getNoInputVoiceMailUser()
            ->shouldBe(null);
    }

    function it_resets_error_targets_but_current()
    {
        $timeoutExtension = $this->getInstance(
            Extension::class
        );
        $timeoutExtensionDto = new ExtensionDto();

        $timeoutVoiceMailUser = $this->getInstance(
            User::class
        );
        $timeoutVoiceMailUserDto = new UserDto();

        $this
            ->dto
            ->setNoInputNumberValue('1234')
            ->setNoInputExtension($timeoutExtensionDto)
            ->setNoInputVoiceMailUser($timeoutVoiceMailUserDto);

        $this->transformer->appendFixedTransforms([
            [$timeoutVoiceMailUserDto, $timeoutVoiceMailUser],
            [$timeoutExtensionDto, $timeoutExtension]
        ]);

        $this
            ->getErrorExtension()
            ->shouldBe(null);

        $this
            ->getErrorVoiceMailUser()
            ->shouldBe(null);
    }
}
