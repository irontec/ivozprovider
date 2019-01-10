<?php

namespace spec\Ivoz\Provider\Domain\Model\Calendar;

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

        $this
            ->holidayDate
            ->checkEventOnTime(Argument::any())
            ->willReturn(true);

        $this->holidayDate2 = $holidayDate2;
        $this->holidayDate2
            ->getId()
            ->willReturn(2);

        $this->holidayDate2
            ->setCalendar(Argument::type(Calendar::class))
            ->willReturn();

        $this
            ->holidayDate2
            ->checkEventOnTime(Argument::any())
            ->willReturn(true);

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
        $this->getterProphecy(
            $this->holidayDate,
            [
                'getEventDate' => (new \DateTime('2019-01-01'))
            ],
            true
        );

        $this->getterProphecy(
            $this->holidayDate2,
            [
                'getEventDate' => (new \DateTime('2019-01-02'))
            ],
            true
        );

        $this
            ->isHolidayDate(new \DateTime('2019-01-01'))
            ->shouldReturn(true);

        $this
            ->isHolidayDate(new \DateTime('2019-01-02'))
            ->shouldReturn(true);

        $this
            ->isHolidayDate(new \DateTime('2019-01-03'))
            ->shouldReturn(false);
    }

    function it_makes_timezone_conversions_on_isHolidayDate()
    {
        // UTC#2018-12-31 23:00:00
        $eventDate = new \DateTime(
            '2019-01-01 00:00:00',
            new \DateTimeZone('Europe/Madrid')
        );
        $this->getterProphecy(
            $this->holidayDate,
            [
                'getEventDate' => $eventDate
            ],
            true
        );

        // UTC#2019-02-01 15:00:00
        $eventDate2 = new \DateTime(
            '2019-02-02 00:00:00',
            new \DateTimeZone('Asia/Tokyo')
        );
        $this->getterProphecy(
            $this->holidayDate2,
            [
                'getEventDate' => $eventDate2
            ],
            true
        );

        $utc = new \DateTimeZone('UTC');
        $this
            ->isHolidayDate(new \DateTime('2018-12-31 23:00:00', $utc))
            ->shouldReturn(true);

        $this
            ->isHolidayDate(new \DateTime('2019-01-01 23:00:00', $utc))
            ->shouldReturn(false);

        $this
            ->isHolidayDate(new \DateTime('2019-02-01 20:00:00', $utc))
            ->shouldReturn(true);
    }
}
