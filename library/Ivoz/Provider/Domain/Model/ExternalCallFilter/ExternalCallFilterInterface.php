<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface ExternalCallFilterInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Check if the given number matches External Filter black list
     * @param string $origin in E164 form
     * @return true if number matches, false otherwise
     */
    public function isBlackListed($origin);

    /**
     * Check if the given number matches External Filter white list
     * @param string $origin in E164 form
     * @return true if number matches, false otherwise
     */
    public function isWhitelisted($origin);

    /**
     * @return Null | HolidayDateInterface
     */
    public function getHolidayDateForToday();

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
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set welcomeLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $welcomeLocution
     *
     * @return self
     */
    public function setWelcomeLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $welcomeLocution = null);

    /**
     * Get welcomeLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getWelcomeLocution();

    /**
     * Set holidayLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $holidayLocution
     *
     * @return self
     */
    public function setHolidayLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $holidayLocution = null);

    /**
     * Get holidayLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getHolidayLocution();

    /**
     * Set outOfScheduleLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $outOfScheduleLocution
     *
     * @return self
     */
    public function setOutOfScheduleLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $outOfScheduleLocution = null);

    /**
     * Get outOfScheduleLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getOutOfScheduleLocution();

    /**
     * Set holidayExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $holidayExtension
     *
     * @return self
     */
    public function setHolidayExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $holidayExtension = null);

    /**
     * Get holidayExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getHolidayExtension();

    /**
     * Set outOfScheduleExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $outOfScheduleExtension
     *
     * @return self
     */
    public function setOutOfScheduleExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $outOfScheduleExtension = null);

    /**
     * Get outOfScheduleExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getOutOfScheduleExtension();

    /**
     * Set holidayVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $holidayVoiceMailUser
     *
     * @return self
     */
    public function setHolidayVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $holidayVoiceMailUser = null);

    /**
     * Get holidayVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getHolidayVoiceMailUser();

    /**
     * Set outOfScheduleVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $outOfScheduleVoiceMailUser
     *
     * @return self
     */
    public function setOutOfScheduleVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $outOfScheduleVoiceMailUser = null);

    /**
     * Get outOfScheduleVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getOutOfScheduleVoiceMailUser();

    /**
     * Set holidayNumberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $holidayNumberCountry
     *
     * @return self
     */
    public function setHolidayNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $holidayNumberCountry = null);

    /**
     * Get holidayNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getHolidayNumberCountry();

    /**
     * Set outOfScheduleNumberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $outOfScheduleNumberCountry
     *
     * @return self
     */
    public function setOutOfScheduleNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $outOfScheduleNumberCountry = null);

    /**
     * Get outOfScheduleNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getOutOfScheduleNumberCountry();

    /**
     * Add calendar
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface $calendar
     *
     * @return ExternalCallFilterTrait
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
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface[] $calendars
     * @return self
     */
    public function replaceCalendars(Collection $calendars);

    /**
     * Get calendars
     *
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface[]
     */
    public function getCalendars(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add blackList
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface $blackList
     *
     * @return ExternalCallFilterTrait
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
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface[] $blackLists
     * @return self
     */
    public function replaceBlackLists(Collection $blackLists);

    /**
     * Get blackLists
     *
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface[]
     */
    public function getBlackLists(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add whiteList
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface $whiteList
     *
     * @return ExternalCallFilterTrait
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
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface[] $whiteLists
     * @return self
     */
    public function replaceWhiteLists(Collection $whiteLists);

    /**
     * Get whiteLists
     *
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface[]
     */
    public function getWhiteLists(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add schedule
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface $schedule
     *
     * @return ExternalCallFilterTrait
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
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface[] $schedules
     * @return self
     */
    public function replaceSchedules(Collection $schedules);

    /**
     * Get schedules
     *
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface[]
     */
    public function getSchedules(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
