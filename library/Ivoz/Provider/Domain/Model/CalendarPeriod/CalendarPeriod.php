<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriod;

use Ivoz\Provider\Domain\Traits\RoutableTrait;

/**
 * CalendarPeriod
 */
class CalendarPeriod extends CalendarPeriodAbstract implements CalendarPeriodInterface
{
    use CalendarPeriodTrait;
    use RoutableTrait;

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
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164()
    {
        if (!$this->getNumberCountry()) {
            return "";
        }

        return
            $this->getNumberCountry()->getCountryCode() .
            $this->getNumberValue();
    }


    public function isOutOfSchedule()
    {
        $calendar = $this->getCalendar();
        $company = $calendar->getCompany();
        $timezone = $company->getDefaultTimezone();

        $now = new \DateTime('now', new \DateTimeZone('UTC'));

        $scheduleMatched = false;
        $calendarSchedules = $this->getRelSchedules();
        foreach ($calendarSchedules as $calendarSchedule) {
            $schedule = $calendarSchedule->getSchedule();

            $scheduleMatched = $schedule
                ->checkIsOnTimeRange(
                    $now->format('l'),
                    $now,
                    new \DateTimeZone($timezone->getTz())
                );

            if ($scheduleMatched) {
                break;
            }
        }

        return !$scheduleMatched;
    }
}
