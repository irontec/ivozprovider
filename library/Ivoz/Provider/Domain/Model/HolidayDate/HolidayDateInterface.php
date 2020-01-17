<?php

namespace Ivoz\Provider\Domain\Model\HolidayDate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface HolidayDateInterface extends LoggableEntityInterface
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

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get eventDate
     *
     * @return \DateTime
     */
    public function getEventDate();

    /**
     * Get wholeDayEvent
     *
     * @return boolean
     */
    public function getWholeDayEvent();

    /**
     * Get timeIn
     *
     * @return \DateTime | null
     */
    public function getTimeIn();

    /**
     * Get timeOut
     *
     * @return \DateTime | null
     */
    public function getTimeOut();

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
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
