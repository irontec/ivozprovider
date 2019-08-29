<?php

namespace spec\Ivoz\Provider\Domain\Model\Calendar;

use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\Calendar\Calendar;
use Ivoz\Provider\Domain\Model\Calendar\CalendarDto;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use Doctrine\Common\Collections\ArrayCollection;

class CalendarSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $dto;

    protected $company;
    protected $holidayDate;
    protected $holidayDate2;

    function let(
        CompanyInterface $company,
        HolidayDateInterface $holidayDate,
        HolidayDateInterface $holidayDate2
    ) {
        $this->dto = $dto = new CalendarDto();
        $dto->setName('Calendar');

        $this->company = $company;
        $this->holidayDate = $holidayDate;

        $this
            ->holidayDate
            ->getId()
            ->willReturn(1);

        $this->holidayDate
            ->setCalendar(Argument::type(Calendar::class))
            ->willReturn();


        $this->holidayDate2 = $holidayDate2;
        $this->holidayDate2
            ->getId()
            ->willReturn(2);

        $this->holidayDate2
            ->setCalendar(Argument::type(Calendar::class))
            ->willReturn();

        $holidayDates = [
            $holidayDate->getWrappedObject(),
            $holidayDate2->getWrappedObject()
        ];

        $this->hydrate(
            $dto,
            [
                'company' => $company->getWrappedObject(),
                'holidayDates' => $holidayDates
            ]
        );

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
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
                Argument::type(\Doctrine\Common\Collections\Criteria::class)
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
                Argument::type(\Doctrine\Common\Collections\Criteria::class)
            )
            ->willReturn(new ArrayCollection([]));

        $this
            ->isHolidayDate(new \DateTime('2019-01-03'))
            ->shouldReturn(false);
    }
}
