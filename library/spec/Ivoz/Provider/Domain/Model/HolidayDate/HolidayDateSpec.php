<?php

namespace spec\Ivoz\Provider\Domain\Model\HolidayDate;

use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDate;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class HolidayDateSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $dto;

    function let(
        CountryInterface $country,
        CalendarInterface $calendar
    ) {
        $this->dto = $dto = new HolidayDateDto();
        $dto
            ->setName('Name')
            ->setEventDate(
                new \DateTime('now', new \DateTimeZone('UTC'))
            )
            ->setWholeDayEvent(1)
            ->setRouteType('number')
            ->setNumberValue('733648484');

        $this->hydrate(
            $dto,
            [
                'numberCountry' => $country->getWrappedObject(),
                'calendar' => $calendar->getWrappedObject(),
            ]
        );

        $this->getterProphecy(
            $country,
            [
                'getId' => 1,
                'getCountryCode' => '34'
            ],
            false
        );

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
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

        $this->updateFromDto($this->dto, new \spec\DtoToEntityFakeTransformer());

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
            ->duringUpdateFromDto($dto, new \spec\DtoToEntityFakeTransformer());
    }

    function it_resolves_e164_munber_value()
    {
        $this->dto
            ->setNumberValue('12345678');
        $this->updateFromDto($this->dto, new \spec\DtoToEntityFakeTransformer());

        $this
            ->getNumberValueE164()
            ->shouldReturn('3412345678');
    }
}
