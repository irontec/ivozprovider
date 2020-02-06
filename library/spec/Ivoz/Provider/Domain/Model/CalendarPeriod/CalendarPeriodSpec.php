<?php

namespace spec\Ivoz\Provider\Domain\Model\CalendarPeriod;

use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriod;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class CalendarPeriodSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $dto;

    function let(
        CalendarInterface $calendar
    ) {
        $this->dto = $dto = new CalendarPeriodDto();
        $dto
            ->setStartDate(
                new \DateTime('now', new \DateTimeZone('UTC'))
            )
            ->setEndDate(
                new \DateTime('now', new \DateTimeZone('UTC'))
            );

        $this->hydrate(
            $dto,
            [
                'calendar' => $calendar->getWrappedObject(),
            ]
        );

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
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
            ->duringUpdateFromDto($dto, new \spec\DtoToEntityFakeTransformer());
    }
}
