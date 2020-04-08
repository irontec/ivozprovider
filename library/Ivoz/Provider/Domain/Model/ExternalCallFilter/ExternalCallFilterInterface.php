<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

interface ExternalCallFilterInterface extends LoggableEntityInterface
{
    const HOLIDAYTARGETTYPE_NUMBER = 'number';
    const HOLIDAYTARGETTYPE_EXTENSION = 'extension';
    const HOLIDAYTARGETTYPE_VOICEMAIL = 'voicemail';


    const OUTOFSCHEDULETARGETTYPE_NUMBER = 'number';
    const OUTOFSCHEDULETARGETTYPE_EXTENSION = 'extension';
    const OUTOFSCHEDULETARGETTYPE_VOICEMAIL = 'voicemail';


    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Check if the given number matches External Filter black list
     * @param string $origin in E164 form
     * @return bool true if number matches, false otherwise
     */
    public function isBlackListed($origin);

    /**
     * Check if the given number matches External Filter white list
     * @param string $origin in E164 form
     * @return bool true if number matches, false otherwise
     */
    public function isWhitelisted($origin);

    /**
     * @return null | \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface
     */
    public function getHolidayDateForToday();

    public function getCalendarPeriodForToday();

    /**
     * @return bool scheduleMatched
     */
    public function isOutOfSchedule();

    /**
     * Get the holiday numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getHolidayNumberValueE164();

    /**
     * Get the out of schedule numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getOutOfScheduleNumberValueE164();

    /**
     * Get Target destination for Holidays
     *
     * @return null|string
     */
    public function getHolidayTarget();

    /**
     * Alias for getHolidayTargetType
     *
     * @todo rename holidayTagetType field to holidayRouteType
     */
    public function getHolidayRouteType();

    /**
     * Get Target destination for Out of schedule
     *
     * @return null|string
     */
    public function getOutOfScheduleTarget();

    /**
     * Alias for getOutOfScheduleTargetType
     *
     * @todo rename outOfScheduleTargetType field to outOfScheduleRouteType
     */
    public function getOutOfScheduleRouteType();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get holidayTargetType
     *
     * @return string | null
     */
    public function getHolidayTargetType();

    /**
     * Get holidayNumberValue
     *
     * @return string | null
     */
    public function getHolidayNumberValue();

    /**
     * Get outOfScheduleTargetType
     *
     * @return string | null
     */
    public function getOutOfScheduleTargetType();

    /**
     * Get outOfScheduleNumberValue
     *
     * @return string | null
     */
    public function getOutOfScheduleNumberValue();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Get welcomeLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getWelcomeLocution();

    /**
     * Get holidayLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getHolidayLocution();

    /**
     * Get outOfScheduleLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getOutOfScheduleLocution();

    /**
     * Get holidayExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getHolidayExtension();

    /**
     * Get outOfScheduleExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getOutOfScheduleExtension();

    /**
     * Get holidayVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getHolidayVoiceMailUser();

    /**
     * Get outOfScheduleVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getOutOfScheduleVoiceMailUser();

    /**
     * Get holidayNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getHolidayNumberCountry();

    /**
     * Get outOfScheduleNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getOutOfScheduleNumberCountry();

    /**
     * Add calendar
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface $calendar
     *
     * @return static
     */
    public function addCalendar(\Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface $calendar);

    /**
     * Remove calendar
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface $calendar
     */
    public function removeCalendar(\Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface $calendar);

    /**
     * Replace calendars
     *
     * @param ArrayCollection $calendars of Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface
     * @return static
     */
    public function replaceCalendars(ArrayCollection $calendars);

    /**
     * Get calendars
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface[]
     */
    public function getCalendars(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add blackList
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface $blackList
     *
     * @return static
     */
    public function addBlackList(\Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface $blackList);

    /**
     * Remove blackList
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface $blackList
     */
    public function removeBlackList(\Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface $blackList);

    /**
     * Replace blackLists
     *
     * @param ArrayCollection $blackLists of Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface
     * @return static
     */
    public function replaceBlackLists(ArrayCollection $blackLists);

    /**
     * Get blackLists
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface[]
     */
    public function getBlackLists(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add whiteList
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface $whiteList
     *
     * @return static
     */
    public function addWhiteList(\Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface $whiteList);

    /**
     * Remove whiteList
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface $whiteList
     */
    public function removeWhiteList(\Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface $whiteList);

    /**
     * Replace whiteLists
     *
     * @param ArrayCollection $whiteLists of Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface
     * @return static
     */
    public function replaceWhiteLists(ArrayCollection $whiteLists);

    /**
     * Get whiteLists
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface[]
     */
    public function getWhiteLists(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add schedule
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface $schedule
     *
     * @return static
     */
    public function addSchedule(\Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface $schedule);

    /**
     * Remove schedule
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface $schedule
     */
    public function removeSchedule(\Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface $schedule);

    /**
     * Replace schedules
     *
     * @param ArrayCollection $schedules of Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface
     * @return static
     */
    public function replaceSchedules(ArrayCollection $schedules);

    /**
     * Get schedules
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface[]
     */
    public function getSchedules(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
