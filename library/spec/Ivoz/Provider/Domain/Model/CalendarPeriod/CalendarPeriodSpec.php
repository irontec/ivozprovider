<?php

namespace spec\Ivoz\Provider\Domain\Model\CalendarPeriod;

use Ivoz\Provider\Domain\Model\Calendar\Calendar;
use Ivoz\Provider\Domain\Model\Calendar\CalendarDto;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriod;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodDto;
use PhpSpec\ObjectBehavior;
use spec\DtoToEntityFakeTransformer;
use spec\HelperTrait;

class CalendarPeriodSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $dto;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let()
    {
        $calendarDto = new CalendarDto();
        $calendar = $this->getInstance(Calendar::class);

        $this->dto = $dto = new CalendarPeriodDto();
        $dto
            ->setStartDate(
                new \DateTime('now', new \DateTimeZone('UTC'))
            )
            ->setEndDate(
                new \DateTime('now', new \DateTimeZone('UTC'))
            )
            ->setCalendar(
                $calendarDto
            );

        $this->transformer = new DtoToEntityFakeTransformer([
            [$calendarDto, $calendar]
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CalendarPeriod::class);
    }

    function it_checks_if_date_makes_sense()
    {
        $dto = clone $this->dto;
        $dto
            ->setStartDate(new \DateTime('1 days ago'))
            ->setEndDate(new \DateTime('2 days ago'));

        $this
            ->shouldThrow('\DomainException')
            ->duringUpdateFromDto($dto, $this->transformer);
    }
}
