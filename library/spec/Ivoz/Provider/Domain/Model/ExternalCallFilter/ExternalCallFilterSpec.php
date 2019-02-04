<?php

namespace spec\Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilter;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class ExternalCallFilterSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var ExtensionDto
     */
    protected $dto;

    function let(
        CompanyInterface $company
    ) {

        $this->dto = $dto = new ExternalCallFilterDto();
        $dto->setName('name');

        $this->hydrate(
            $dto,
            [
                'company' => $company->getWrappedObject()
            ]
        );

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ExternalCallFilter::class);
    }

    function it_resets_holiday_targets_but_current_value(
        UserInterface $holidayVoiceMailUser,
        ExtensionInterface $holidayExtension
    ) {
        $this
            ->dto
            ->setHolidayTargetType('number');

        $this->hydrate(
            $this->dto,
            [
                'holidayNumberValue'   => '1234',
                'holidayExtension'     => $holidayExtension->getWrappedObject(),
                'holidayVoiceMailUser' => $holidayVoiceMailUser->getWrappedObject()
            ]
        );

        $this
            ->getHolidayExtension()
            ->shouldBe(null);

        $this
            ->getHolidayVoiceMailUser()
            ->shouldBe(null);
    }


    function it_resets_outOfSchedule_targets_but_current_value(
        UserInterface $outOfScheduleVoiceMailUser,
        ExtensionInterface $outOfScheduleExtension
    ) {
        $this
            ->dto
            ->setHolidayTargetType('number');

        $this->hydrate(
            $this->dto,
            [
                'outOfScheduleNumberValue'   => '1234',
                'outOfScheduleExtension'     => $outOfScheduleExtension->getWrappedObject(),
                'outOfScheduleVoiceMailUser' => $outOfScheduleVoiceMailUser->getWrappedObject()
            ]
        );

        $this
            ->getOutOfScheduleExtension()
            ->shouldBe(null);

        $this
            ->getOutOfScheduleVoiceMailUser()
            ->shouldBe(null);
    }
}
