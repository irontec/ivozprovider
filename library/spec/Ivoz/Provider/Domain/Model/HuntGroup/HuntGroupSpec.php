<?php

namespace spec\Ivoz\Provider\Domain\Model\HuntGroup;

use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroup;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupDto;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use spec\DtoToEntityFakeTransformer;

class HuntGroupSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var HuntGroupDto
     */
    protected $dto;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let()
    {
        $companyDto = new CompanyDto();
        $company = $this->getInstance(
            Company::class
        );

        $this->dto = $dto = new HuntGroupDto();

        $dto
            ->setName('name')
            ->setDescription('Description')
            ->setStrategy('ringAll')
            ->setRingAllTimeout(1)
            ->setCompany($companyDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$companyDto, $company],
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(HuntGroup::class);
    }

    function it_resets_noAnswer_targets_but_current(
        UserInterface $noAnswerVoiceMailUser,
        ExtensionInterface $noAnswerExtension
    ) {
        $noAnswerVoiceMailUserDto = new UserDto();
        $noAnswerVoiceMailUser = $this->getInstance(
            User::class
        );

        $noAnswerExtensionDto = new ExtensionDto();
        $noAnswerExtension = $this->getInstance(
            Extension::class
        );

        $this->dto
            ->setNoAnswerTargetType('number')
            ->setNoAnswerNumberValue('1234')
            ->setNoAnswerExtension($noAnswerExtensionDto)
            ->setNoAnswerVoiceMailUser($noAnswerVoiceMailUserDto)
        ;

        $this->transformer->appendFixedTransforms([
            [$noAnswerExtensionDto, $noAnswerExtension],
            [$noAnswerVoiceMailUserDto, $noAnswerVoiceMailUser],
        ]);

        $this
            ->getNoAnswerExtension()
            ->shouldBe(null);

        $this
            ->getNoAnswerVoiceMailUser()
            ->shouldBe(null);
    }
}
