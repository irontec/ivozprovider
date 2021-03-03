<?php

namespace spec\Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilter;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserDto;
use PhpSpec\ObjectBehavior;
use spec\DtoToEntityFakeTransformer;
use spec\HelperTrait;

class ExternalCallFilterSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var ExternalCallFilterDto
     */
    protected $dto;

    /**
     * @var DtoToEntityFakeTransformer
     */
    protected $transformer;

    function let()
    {
        $companyDto = new CompanyDto();
        $company = $this->getInstance(Company::class);

        $this->dto = $dto = new ExternalCallFilterDto();
        $dto
            ->setName('name')
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
        $this->shouldHaveType(ExternalCallFilter::class);
    }

    function it_resets_holiday_targets_but_current_value()
    {
        $holidayVoiceMailUserDto = new UserDto();
        $holidayVoiceMailUser = $this->getInstance(
            User::class
        );

        $holidayExtensionDto = new ExtensionDto();
        $holidayExtension = $this->getInstance(
            Extension::class
        );

        $this
            ->dto
            ->setHolidayTargetType('number')
            ->setHolidayNumberValue('1234')
            ->setHolidayExtension($holidayExtensionDto)
            ->setHolidayVoiceMailUser($holidayVoiceMailUserDto);

        $this->transformer->appendFixedTransforms([
            [$holidayExtensionDto, $holidayExtension],
            [$holidayVoiceMailUserDto, $holidayVoiceMailUser],
        ]);

        $this
            ->getHolidayExtension()
            ->shouldBe(null);

        $this
            ->getHolidayVoiceMailUser()
            ->shouldBe(null);
    }

    function it_resets_outOfSchedule_targets_but_current_value()
    {
        $outOfScheduleVoiceMailUserDto = new UserDto();
        $outOfScheduleVoiceMailUser = $this->getInstance(
            User::class
        );

        $outOfScheduleExtensionDto = new ExtensionDto();
        $outOfScheduleExtension = $this->getInstance(
            Extension::class
        );

        $this
            ->dto
            ->setHolidayTargetType('number')
            ->setHolidayNumberValue('1234')
            ->setOutOfScheduleExtension($outOfScheduleExtensionDto)
            ->setOutOfScheduleVoiceMailUser($outOfScheduleVoiceMailUserDto);

        $this->transformer->appendFixedTransforms([
            [$outOfScheduleExtensionDto, $outOfScheduleExtension],
            [$outOfScheduleVoiceMailUserDto, $outOfScheduleVoiceMailUser],
        ]);

        $this
            ->getOutOfScheduleExtension()
            ->shouldBe(null);

        $this
            ->getOutOfScheduleVoiceMailUser()
            ->shouldBe(null);
    }
}
