<?php

namespace Ivoz\Provider\Domain\Model\Calendar;

use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface;

/**
 * Calendar
 */
class Calendar extends CalendarAbstract implements CalendarInterface
{
    use CalendarTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Check if the given day is registered as Holiday
     *
     * @param \DateTime $date
     * @return bool
     */
    public function isHolidayDate($date)
    {
        $filteredHolidayDates = array_filter(
            $this->getHolidayDates(),
            function (HolidayDateInterface $holidayDate) use ($date) {

                $eventDate = $holidayDate->getEventDate();
                $date->setTimezone($eventDate->getTimezone());
                $eventDateStr = $eventDate->format('Y-m-d');

                return $eventDateStr === $date->format('Y-m-d');
            }
        );

        foreach ($filteredHolidayDates as $holidayDate) {
            $eventMatched = $holidayDate
                ->checkEventOnTime(
                    $date
                );

            if ($eventMatched) {
                return true;
            }
        }

        return false;
    }
}
