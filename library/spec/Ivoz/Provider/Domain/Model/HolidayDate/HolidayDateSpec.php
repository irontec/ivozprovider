<?php

namespace spec\Ivoz\Provider\Domain\Model\HolidayDate;

use Ivoz\Provider\Domain\Model\Calendar\Calendar;
use Ivoz\Provider\Domain\Model\Calendar\CalendarDto;
use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\Country\CountryDto;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDate;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

class HolidayDateSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $dto;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let(
        CountryInterface $country,
        CalendarInterface $calendar
    ) {
        $countryDto = new CountryDto();
        $country = $this->getterProphecy(
            $this->getTestDouble(
                Country::class
            ),
            [
                'getId' => 1,
                'getCountryCode' => '34'
            ],
            false
        );

        $calendarDto = new CalendarDto();
        $calendar = $this->getInstance(
            Calendar::class
        );

        $this->dto = $dto = new HolidayDateDto();
        $dto
            ->setName('Name')
            ->setEventDate(
                new \DateTime('now', new \DateTimeZone('UTC'))
            )
            ->setWholeDayEvent(1)
            ->setRouteType('number')
            ->setNumberValue('733648484')
            ->setNumberCountry($countryDto)
            ->setCalendar($calendarDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$countryDto, $country->reveal()],
            [$calendarDto, $calendar],
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(HolidayDate::class);
    }

    function it_resets_time_values_on_whole_day_events()
    {
        $this->dto
            ->setWholeDayEvent(1)
            ->setTimeIn(new \DateTime('2 days ago'))
            ->setTimeOut(new \DateTime('1 days ago'));

        $this->updateFromDto(
            $this->dto,
            $this->transformer
        );

        $this
            ->getTimeIn()
            ->shouldReturn(null);

        $this
            ->getTimeOut()
            ->shouldReturn(null);
    }

    function it_checks_if_time_makes_sense()
    {
        $dto = clone $this->dto;
        $dto
            ->setWholeDayEvent(0)
            ->setTimeIn(new \DateTime('1 days ago'))
            ->setTimeOut(new \DateTime('2 days ago'));

        $this
            ->shouldThrow('\DomainException')
            ->duringUpdateFromDto(
                $dto,
                $this->transformer
            );
    }

    function it_resolves_e164_munber_value()
    {
        $this->dto
            ->setNumberValue('12345678');
        $this->updateFromDto(
            $this->dto,
            $this->transformer
        );

        $this
            ->getNumberValueE164()
            ->shouldReturn('3412345678');
    }
}
