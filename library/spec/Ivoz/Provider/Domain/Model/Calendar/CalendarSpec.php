<?php

namespace spec\Ivoz\Provider\Domain\Model\Calendar;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\Calendar\Calendar;
use Ivoz\Provider\Domain\Model\Calendar\CalendarDto;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDate;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\DtoToEntityFakeTransformer;
use spec\HelperTrait;

class CalendarSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $dto;

    protected $company;
    protected $holidayDate;
    protected $holidayDate2;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let()
    {
        $companyDto = new CompanyDto();
        $this->company = $this->getInstance(Company::class);

        $holidayDateDto = new HolidayDateDto();
        $this->holidayDate = $this->getterProphecy(
            $this->getTestDouble(HolidayDate::class),
            [
                'getId' => 1
            ]
        );
        $this->fluentSetterProphecy(
            $this->holidayDate,
            [
                'setCalendar' => Argument::type(Calendar::class),
            ],
            false
        );

        $holidayDate2Dto = new HolidayDateDto();
        $this->holidayDate2 = $this->getterProphecy(
            $this->getTestDouble(HolidayDate::class),
            [
                'getId' => 2
            ]
        );
        $this->fluentSetterProphecy(
            $this->holidayDate2,
            [
                'setCalendar' => Argument::type(Calendar::class),
            ],
            false
        );

        $holidayDates = [
            $holidayDateDto,
            $holidayDate2Dto
        ];

        $this->dto = $dto = new CalendarDto();
        $dto
            ->setName('Calendar')
            ->setCompany($companyDto)
            ->setHolidayDates($holidayDates);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$companyDto, $this->company],
            [$holidayDateDto, $this->holidayDate->reveal()],
            [$holidayDate2Dto, $this->holidayDate2->reveal()],
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Calendar::class);
    }

    function it_tells_whether_given_day_is_a_holiday()
    {

        $holidayDates = $this->getTestDouble(
            ArrayCollection::class
        );

        $this->hydrate(
            $this->getWrappedObject(),
            ['holidayDates' => $holidayDates->reveal()]
        );

        $holidayDates
            ->matching(
                Argument::type(Criteria::class)
            )
            ->willReturn(new ArrayCollection([true]));

        $this
            ->isHolidayDate(new \DateTime('2019-01-01'))
            ->shouldReturn(true);

        $this
            ->isHolidayDate(new \DateTime('2019-01-02'))
            ->shouldReturn(true);


        $holidayDates
            ->matching(
                Argument::type(Criteria::class)
            )
            ->willReturn(new ArrayCollection([]));

        $this
            ->isHolidayDate(new \DateTime('2019-01-03'))
            ->shouldReturn(false);
    }
}
