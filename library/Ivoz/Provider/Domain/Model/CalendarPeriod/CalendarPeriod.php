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
    public function getChangeSet(): array
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

    protected function sanitizeValues()
    {
        $startDate = $this->getStartDate();
        $endDate = $this->getEndDate();

        if ($endDate < $startDate) {
            throw new \DomainException('End date must be later or equal than start date.', 30300);
        }
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

        $now = new \DateTime('now', new \DateTimeZone($timezone->getTz()));

        $scheduleMatched = false;
        $calendarSchedules = $this->getRelSchedules();
        foreach ($calendarSchedules as $calendarSchedule) {
            $schedule = $calendarSchedule->getSchedule();

            $scheduleMatched = $schedule
                ->isOnSchedule($now);

            if ($scheduleMatched) {
                break;
            }
        }

        return !$scheduleMatched;
    }
}
