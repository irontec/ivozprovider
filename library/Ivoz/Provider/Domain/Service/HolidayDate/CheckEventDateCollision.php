<?php

namespace Ivoz\Provider\Domain\Service\HolidayDate;

use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateRepository;

/**
 * Class CheckEventDateCollision
 * @package Ivoz\Provider\Domain\Service\HolidayDate
 */
class CheckEventDateCollision implements HolidayDateLifecycleEventHandlerInterface
{
    const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private HolidayDateRepository $holidayDateRepository
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY,
        ];
    }

    /**
     * @return void
     */
    public function execute(HolidayDateInterface $holidayDate)
    {
        $calendarHolidays = $this->holidayDateRepository
            ->findMatchingDateSiblings($holidayDate);

        foreach ($calendarHolidays as $calendarHoliday) {
            // Only one whole day event allowed per day
            if ($calendarHoliday->getWholeDayEvent() || $holidayDate->getWholeDayEvent()) {
                throw new \DomainException("Another event already exists for this day.");
            }

            $calendarHolidayTimeIn = $calendarHoliday
                ->getTimeIn()
                ->format('H:i:s');

            $calendarHolidayTimeOut = $calendarHoliday
                ->getTimeOut()
                ->format('H:i:s');

            // Validate TimeIn collisions
            $timeIn = $holidayDate
                ->getTimeIn()
                ->format('H:i:s');

            if ($timeIn >= $calendarHolidayTimeIn && $timeIn <=  $calendarHolidayTimeOut) {
                throw new \DomainException("Time In conflicts with existing calendar event.");
            }

            // Validate TimeOut collisions
            $timeOut = $holidayDate
                ->getTimeOut()
                ->format('H:i:s');

            if ($timeOut >= $calendarHolidayTimeIn && $timeOut <=  $calendarHolidayTimeOut) {
                throw new \DomainException("Time Out conflicts with existing calendar event.");
            }
        }
    }
}
