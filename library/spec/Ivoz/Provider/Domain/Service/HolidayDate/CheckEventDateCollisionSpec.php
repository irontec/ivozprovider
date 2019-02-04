<?php

namespace spec\Ivoz\Provider\Domain\Service\HolidayDate;

use Ivoz\Provider\Domain\Service\HolidayDate\CheckEventDateCollision;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class CheckEventDateCollisionSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var HolidayDateRepository
     */
    protected $holidayDateRepository;

    public function let(
        HolidayDateRepository $holidayDateRepository
    ) {
        $this->holidayDateRepository = $holidayDateRepository;


        $this->beConstructedWith($holidayDateRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CheckEventDateCollision::class);
    }

    function it_throws_exception_if_matchingDateSibling_is_wholeDayEvent(
        HolidayDateInterface $holidayDate,
        HolidayDateInterface $holidayDate2
    ) {
        $holidayDate
            ->getWholeDayEvent()
            ->willReturn(false);

        $holidayDate2
            ->getWholeDayEvent()
            ->willReturn(true);

        $this
            ->holidayDateRepository
            ->findMatchingDateSiblings($holidayDate)
            ->willReturn([$holidayDate2]);

        $this
            ->shouldThrow(\DomainException::class)
            ->duringExecute($holidayDate);
    }

    function it_throws_exception_if_input_argument_is_wholeDayEvent_and_has_date_siblings(
        HolidayDateInterface $holidayDate,
        HolidayDateInterface $holidayDate2
    ) {
        $holidayDate
            ->getWholeDayEvent()
            ->willReturn(true);

        $holidayDate2
            ->getWholeDayEvent()
            ->willReturn(false);

        $this
            ->holidayDateRepository
            ->findMatchingDateSiblings($holidayDate)
            ->willReturn([$holidayDate2]);

        $this
            ->shouldThrow(new \DomainException('Another event already exists for this day.'))
            ->duringExecute($holidayDate);
    }

    function it_throws_exception_if_timeIn_overlaps(
        HolidayDateInterface $holidayDate,
        HolidayDateInterface $holidayDate2
    ) {
        $this->getterProphecy(
            $holidayDate,
            [
                'getWholeDayEvent' => false,
                'getTimeIn' => new \DateTime('10:00:00')
            ]
        );

        $this->getterProphecy(
            $holidayDate2,
            [
                'getWholeDayEvent' => false,
                'getTimeIn' => new \DateTime('08:00:00'),
                'getTimeOut' => new \DateTime('21:00:00'),
            ]
        );

        $this
            ->holidayDateRepository
            ->findMatchingDateSiblings($holidayDate)
            ->willReturn([$holidayDate2]);

        $this
            ->shouldThrow(new \DomainException('Time In conflicts with existing calendar event.'))
            ->duringExecute($holidayDate);
    }


    function it_throws_exception_if_timeOut_overlaps(
        HolidayDateInterface $holidayDate,
        HolidayDateInterface $holidayDate2
    ) {
        $this->getterProphecy(
            $holidayDate,
            [
                'getWholeDayEvent' => false,
                'getTimeIn' => new \DateTime('05:00:00'),
                'getTimeOut' => new \DateTime('20:00:00'),
            ]
        );

        $this->getterProphecy(
            $holidayDate2,
            [
                'getWholeDayEvent' => false,
                'getTimeIn' => new \DateTime('08:00:00'),
                'getTimeOut' => new \DateTime('21:00:00'),
            ]
        );

        $this
            ->holidayDateRepository
            ->findMatchingDateSiblings($holidayDate)
            ->willReturn([$holidayDate2]);

        $this
            ->shouldThrow(new \DomainException('Time Out conflicts with existing calendar event.'))
            ->duringExecute($holidayDate);
    }
}
