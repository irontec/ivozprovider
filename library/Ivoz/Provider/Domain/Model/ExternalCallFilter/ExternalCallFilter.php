<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Ivoz\Provider\Domain\Model\Calendar\Calendar;
use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackList;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendar;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelSchedule;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchList;
use Doctrine\Common\Collections\Criteria;

/**
 * ExternalCallFilter
 */
class ExternalCallFilter extends ExternalCallFilterAbstract implements ExternalCallFilterInterface
{
    use ExternalCallFilterTrait;

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
     * Return string representation of this entity
     * @return string
     */
    public function __toString()
    {
        return sprintf("%s [ddi%d]",
            $this->getName(),
            $this->getId()
        );
    }

    protected function sanitizeValues()
    {
        $this->sanitizeHolidayTargetType();
        $this->sanitizeOutOfScheduleTargetType();
    }

    protected function sanitizeHolidayTargetType()
    {
        $holidayNullableFields = [
            'number'    => 'holidayNumberValue',
            'extension' => 'holidayExtension',
            'voicemail' => 'holidayVoiceMailUser',
        ];

        $holidayTargetType = $this->getHolidayTargetType();
        foreach ($holidayNullableFields as $type => $fieldName) {
            if ($holidayTargetType == $type) {
                continue;
            }

            $setter = 'set'.ucfirst($fieldName);
            $this->{$setter}(null);
        }
    }

    protected function sanitizeOutOfScheduleTargetType()
    {
        $scheduleNullableFields = [
            'number'    => 'outOfScheduleNumberValue',
            'extension' => 'outOfScheduleExtension',
            'voicemail' => 'outOfScheduleVoiceMailUser',
        ];
        $schedulerouteType = $this->getOutOfScheduleTargetType();

        foreach ($scheduleNullableFields as $type => $fieldName) {
            if ($schedulerouteType == $type) {
                continue;
            }

            $setter = 'set' . ucfirst($fieldName);
            $this->{$setter}(null);
        }
    }

    /**
     * Check if the given number matches External Filter black list
     * @param string $origin in E164 form
     * @return true if number matches, false otherwise
     */
    public function isBlackListed($origin)
    {
        $blackLists = $this->getBlackLists();

        /**
         * @var ExternalCallFilterBlackList $list
         */
        foreach ($blackLists as $list) {
            /**
             * @var MatchList $matchList
             */
            $matchList = $list->getMatchList();
            if ($matchList->numberMatches($origin)) {

                return true;
            }
        }

        return false;
    }

    /**
     * Check if the given number matches External Filter white list
     * @param string $origin in E164 form
     * @return true if number matches, false otherwise
     */
    public function isWhitelisted($origin)
    {
        $whiteLists = $this->getWhiteLists();
        foreach ($whiteLists as $list) {
            /**
             * @var MatchList $matchList
             */
            $matchList = $list->getMatchList();
            if ($matchList->numberMatches($origin)) {

                return true;
            }
        }

        return false;
    }

    /**
     * @return Null | HolidayDateInterface
     */
    public function getHolidayDateForToday()
    {
        $externalCallFilterRelCalendars = $this->getCalendars();
        if(empty($externalCallFilterRelCalendars)) {

            return null;
        }

        $datetime = new \DateTime('now');
        $date = $datetime->format('Y-m-d');

        /**
         * @var ExternalCallFilterRelCalendar $externalCallFilterRelCalendar
         */
        foreach($externalCallFilterRelCalendars as $externalCallFilterRelCalendar) {

            /**
             * @var Calendar $calendar
             */
            $calendar = $externalCallFilterRelCalendar->getCalendar();

            $expressionBuilder = Criteria::expr();
            $holidayDateCriteria = Criteria::create()
                ->where(
                    $expressionBuilder->eq(
                        'eventDate',
                        $date
                    )
                );

            $holidayDates = $calendar->getHolidayDates($holidayDateCriteria);
            if(!empty($holidayDates)) {

                return $holidayDates[0];
            }
        }

        return null;
    }

    /**
     * @return bool scheduleMatched
     */
    public function isOutOfSchedule()
    {
        $externalCallFilterRelSchedules = $this->getSchedules();
        if (empty($externalCallFilterRelSchedules)) {

            return true;
        }

        $scheduleMatched = false;
        $time = new \DateTime('now');

        /**
         * @var ExternalCallFilterRelSchedule $externalCallFilterRelSchedule
         */
        foreach($externalCallFilterRelSchedules as $externalCallFilterRelSchedule) {

            $schedule = $externalCallFilterRelSchedule->getSchedule();
            $company = $schedule->getCompany();
            $timezones = $company->getDefaultTimezone();

            $scheduleMatched = $schedule
                ->checkIsOnTimeRange(
                    $time->format('l'),
                    $time,
                    new \DateTimeZone($timezone = $timezones->getTz())
                );

            if ($scheduleMatched) {

                break;
            }
        }

        return $scheduleMatched;
    }

    /**
     * Get the holiday numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getHolidayNumberValueE164()
    {
        return
            $this->getHolidayNumberCountry()->getCountryCode() .
            $this->getHolidayNumberValue();
    }

    /**
     * Get the out of schedule numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getOutOfScheduleNumberValueE164()
    {
        return
            $this->getOutOfScheduleNumberCountry()->getCountryCode() .
            $this->getOutOfScheduleNumberValue();
    }
}

