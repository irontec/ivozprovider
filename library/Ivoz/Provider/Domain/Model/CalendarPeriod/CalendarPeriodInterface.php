<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriod;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @return \DateTime
     */
    public function getStartDate();

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate();

    /**
     * Get routeType
     *
     * @return string | null
     */
    public function getRouteType();

    /**
     * Get numberValue
     *
     * @return string | null
     */
    public function getNumberValue();

    /**
     * Set calendar
     *
     * @param \Ivoz\Provider\Domain\Model\Calendar\CalendarInterface $calendar
     *
     * @return static
     */
    public function setCalendar(\Ivoz\Provider\Domain\Model\Calendar\CalendarInterface $calendar = null);

    /**
     * Get calendar
     *
     * @return \Ivoz\Provider\Domain\Model\Calendar\CalendarInterface
     */
    public function getCalendar();

    /**
     * Set locution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $locution | null
     *
     * @return static
     */
    public function setLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $locution = null);

    /**
     * Get locution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getLocution();

    /**
     * Set extension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension | null
     *
     * @return static
     */
    public function setExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension = null);

    /**
     * Get extension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getExtension();

    /**
     * Set voiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $voiceMailUser | null
     *
     * @return static
     */
    public function setVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $voiceMailUser = null);

    /**
     * Get voiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getVoiceMailUser();

    /**
     * Set numberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $numberCountry | null
     *
     * @return static
     */
    public function setNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $numberCountry = null);

    /**
     * Get numberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getNumberCountry();

    /**
     * Add relSchedule
     *
     * @param \Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule\CalendarPeriodsRelScheduleInterface $relSchedule
     *
     * @return static
     */
    public function addRelSchedule(\Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule\CalendarPeriodsRelScheduleInterface $relSchedule);

    /**
     * Remove relSchedule
     *
     * @param \Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule\CalendarPeriodsRelScheduleInterface $relSchedule
     */
    public function removeRelSchedule(\Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule\CalendarPeriodsRelScheduleInterface $relSchedule);

    /**
     * Replace relSchedules
     *
     * @param ArrayCollection $relSchedules of Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule\CalendarPeriodsRelScheduleInterface
     * @return static
     */
    public function replaceRelSchedules(ArrayCollection $relSchedules);

    /**
     * Get relSchedules
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule\CalendarPeriodsRelScheduleInterface[]
     */
    public function getRelSchedules(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
