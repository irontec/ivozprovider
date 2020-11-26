<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* ExternalCallFilterInterface
*/
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
    public function getName(): string;

    /**
     * Get holidayTargetType
     *
     * @return string | null
     */
    public function getHolidayTargetType(): ?string;

    /**
     * Get holidayNumberValue
     *
     * @return string | null
     */
    public function getHolidayNumberValue(): ?string;

    /**
     * Get outOfScheduleTargetType
     *
     * @return string | null
     */
    public function getOutOfScheduleTargetType(): ?string;

    /**
     * Get outOfScheduleNumberValue
     *
     * @return string | null
     */
    public function getOutOfScheduleNumberValue(): ?string;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * Get welcomeLocution
     *
     * @return LocutionInterface | null
     */
    public function getWelcomeLocution(): ?LocutionInterface;

    /**
     * Get holidayLocution
     *
     * @return LocutionInterface | null
     */
    public function getHolidayLocution(): ?LocutionInterface;

    /**
     * Get outOfScheduleLocution
     *
     * @return LocutionInterface | null
     */
    public function getOutOfScheduleLocution(): ?LocutionInterface;

    /**
     * Get holidayExtension
     *
     * @return ExtensionInterface | null
     */
    public function getHolidayExtension(): ?ExtensionInterface;

    /**
     * Get outOfScheduleExtension
     *
     * @return ExtensionInterface | null
     */
    public function getOutOfScheduleExtension(): ?ExtensionInterface;

    /**
     * Get holidayVoiceMailUser
     *
     * @return UserInterface | null
     */
    public function getHolidayVoiceMailUser(): ?UserInterface;

    /**
     * Get outOfScheduleVoiceMailUser
     *
     * @return UserInterface | null
     */
    public function getOutOfScheduleVoiceMailUser(): ?UserInterface;

    /**
     * Get holidayNumberCountry
     *
     * @return CountryInterface | null
     */
    public function getHolidayNumberCountry(): ?CountryInterface;

    /**
     * Get outOfScheduleNumberCountry
     *
     * @return CountryInterface | null
     */
    public function getOutOfScheduleNumberCountry(): ?CountryInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add calendar
     *
     * @param ExternalCallFilterRelCalendarInterface $calendar
     *
     * @return static
     */
    public function addCalendar(ExternalCallFilterRelCalendarInterface $calendar): ExternalCallFilterInterface;

    /**
     * Remove calendar
     *
     * @param ExternalCallFilterRelCalendarInterface $calendar
     *
     * @return static
     */
    public function removeCalendar(ExternalCallFilterRelCalendarInterface $calendar): ExternalCallFilterInterface;

    /**
     * Replace calendars
     *
     * @param ArrayCollection $calendars of ExternalCallFilterRelCalendarInterface
     *
     * @return static
     */
    public function replaceCalendars(ArrayCollection $calendars): ExternalCallFilterInterface;

    /**
     * Get calendars
     * @param Criteria | null $criteria
     * @return ExternalCallFilterRelCalendarInterface[]
     */
    public function getCalendars(?Criteria $criteria = null): array;

    /**
     * Add blackList
     *
     * @param ExternalCallFilterBlackListInterface $blackList
     *
     * @return static
     */
    public function addBlackList(ExternalCallFilterBlackListInterface $blackList): ExternalCallFilterInterface;

    /**
     * Remove blackList
     *
     * @param ExternalCallFilterBlackListInterface $blackList
     *
     * @return static
     */
    public function removeBlackList(ExternalCallFilterBlackListInterface $blackList): ExternalCallFilterInterface;

    /**
     * Replace blackLists
     *
     * @param ArrayCollection $blackLists of ExternalCallFilterBlackListInterface
     *
     * @return static
     */
    public function replaceBlackLists(ArrayCollection $blackLists): ExternalCallFilterInterface;

    /**
     * Get blackLists
     * @param Criteria | null $criteria
     * @return ExternalCallFilterBlackListInterface[]
     */
    public function getBlackLists(?Criteria $criteria = null): array;

    /**
     * Add whiteList
     *
     * @param ExternalCallFilterWhiteListInterface $whiteList
     *
     * @return static
     */
    public function addWhiteList(ExternalCallFilterWhiteListInterface $whiteList): ExternalCallFilterInterface;

    /**
     * Remove whiteList
     *
     * @param ExternalCallFilterWhiteListInterface $whiteList
     *
     * @return static
     */
    public function removeWhiteList(ExternalCallFilterWhiteListInterface $whiteList): ExternalCallFilterInterface;

    /**
     * Replace whiteLists
     *
     * @param ArrayCollection $whiteLists of ExternalCallFilterWhiteListInterface
     *
     * @return static
     */
    public function replaceWhiteLists(ArrayCollection $whiteLists): ExternalCallFilterInterface;

    /**
     * Get whiteLists
     * @param Criteria | null $criteria
     * @return ExternalCallFilterWhiteListInterface[]
     */
    public function getWhiteLists(?Criteria $criteria = null): array;

    /**
     * Add schedule
     *
     * @param ExternalCallFilterRelScheduleInterface $schedule
     *
     * @return static
     */
    public function addSchedule(ExternalCallFilterRelScheduleInterface $schedule): ExternalCallFilterInterface;

    /**
     * Remove schedule
     *
     * @param ExternalCallFilterRelScheduleInterface $schedule
     *
     * @return static
     */
    public function removeSchedule(ExternalCallFilterRelScheduleInterface $schedule): ExternalCallFilterInterface;

    /**
     * Replace schedules
     *
     * @param ArrayCollection $schedules of ExternalCallFilterRelScheduleInterface
     *
     * @return static
     */
    public function replaceSchedules(ArrayCollection $schedules): ExternalCallFilterInterface;

    /**
     * Get schedules
     * @param Criteria | null $criteria
     * @return ExternalCallFilterRelScheduleInterface[]
     */
    public function getSchedules(?Criteria $criteria = null): array;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');

}
