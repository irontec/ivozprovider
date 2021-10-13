<?php

namespace Ivoz\Provider\Domain\Model\Calendar;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;

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
     * @param \DateTime $datetime
     * @return bool
     */
    public function isHolidayDate(\DateTimeInterface $datetime)
    {
        return $this->getHolidayDate($datetime) !== null;
    }

    /**
     * Return the first HolidayDate matching the given date
     *
     * @param \DateTime $dateTime
     * @return \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface|null
     */
    public function getHolidayDate(\DateTimeInterface $dateTime)
    {
        // Find HolidayDates for the given date that apply the whole day
        // or time is between the range of the event
        $criteria = CriteriaHelper::fromArray([
            ['eventDate', 'eq', $dateTime],
            'or' => [
                ['wholeDayEvent', 'eq', '1'],
                'and' => [
                    ['timeIn', 'lte', $dateTime],
                    ['timeOut', 'gte', $dateTime]
                ]
            ]
        ]);

        $holidayDates = $this->getHolidayDates($criteria);

        return array_shift($holidayDates);
    }
}
