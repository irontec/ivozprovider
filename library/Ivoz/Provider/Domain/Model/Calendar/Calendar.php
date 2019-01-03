<?php

namespace Ivoz\Provider\Domain\Model\Calendar;

use Doctrine\Common\Collections\Criteria;

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
        $criteria = new Criteria();
        $criteria->where(
            Criteria::expr()->eq(
                'eventDate',
                $date
            )
        );

        $eventMatched = false;

        $holidayDates = $this->getHolidayDates($criteria);
        foreach ($holidayDates as $holidayDate) {
            $eventMatched = $holidayDate
                ->checkEventOnTime(
                    $date
                );

            if ($eventMatched) {
                break;
            }
        }

        return $eventMatched;
    }
}
