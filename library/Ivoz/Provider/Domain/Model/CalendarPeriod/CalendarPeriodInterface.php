<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriod;

use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule\CalendarPeriodsRelScheduleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* CalendarPeriodInterface
*/
interface CalendarPeriodInterface extends LoggableEntityInterface
{
    const ROUTETYPE_NUMBER = 'number';

    const ROUTETYPE_EXTENSION = 'extension';

    const ROUTETYPE_VOICEMAIL = 'voicemail';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164();

    public function isOutOfSchedule();

    /**
     * Get startDate
     *
     * @return \DateTimeInterface
     */
    public function getStartDate(): \DateTimeInterface;

    /**
     * Get endDate
     *
     * @return \DateTimeInterface
     */
    public function getEndDate(): \DateTimeInterface;

    /**
     * Get routeType
     *
     * @return string | null
     */
    public function getRouteType(): ?string;

    /**
     * Get numberValue
     *
     * @return string | null
     */
    public function getNumberValue(): ?string;

    /**
     * Set calendar
     *
     * @param CalendarInterface
     *
     * @return static
     */
    public function setCalendar(CalendarInterface $calendar): CalendarPeriodInterface;

    /**
     * Get calendar
     *
     * @return CalendarInterface
     */
    public function getCalendar(): CalendarInterface;

    /**
     * Get locution
     *
     * @return LocutionInterface | null
     */
    public function getLocution(): ?LocutionInterface;

    /**
     * Get extension
     *
     * @return ExtensionInterface | null
     */
    public function getExtension(): ?ExtensionInterface;

    /**
     * Get voiceMailUser
     *
     * @return UserInterface | null
     */
    public function getVoiceMailUser(): ?UserInterface;

    /**
     * Get numberCountry
     *
     * @return CountryInterface | null
     */
    public function getNumberCountry(): ?CountryInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add relSchedule
     *
     * @param CalendarPeriodsRelScheduleInterface $relSchedule
     *
     * @return static
     */
    public function addRelSchedule(CalendarPeriodsRelScheduleInterface $relSchedule): CalendarPeriodInterface;

    /**
     * Remove relSchedule
     *
     * @param CalendarPeriodsRelScheduleInterface $relSchedule
     *
     * @return static
     */
    public function removeRelSchedule(CalendarPeriodsRelScheduleInterface $relSchedule): CalendarPeriodInterface;

    /**
     * Replace relSchedules
     *
     * @param ArrayCollection $relSchedules of CalendarPeriodsRelScheduleInterface
     *
     * @return static
     */
    public function replaceRelSchedules(ArrayCollection $relSchedules): CalendarPeriodInterface;

    /**
     * Get relSchedules
     * @param Criteria | null $criteria
     * @return CalendarPeriodsRelScheduleInterface[]
     */
    public function getRelSchedules(?Criteria $criteria = null): array;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');

}
