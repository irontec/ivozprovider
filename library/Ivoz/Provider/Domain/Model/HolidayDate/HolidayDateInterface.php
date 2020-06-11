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
    public function getName(): string;

    /**
     * Get eventDate
     *
     * @return \DateTime
     */
    public function getEventDate(): \DateTime;

    /**
     * Get wholeDayEvent
     *
     * @return boolean
     */
    public function getWholeDayEvent(): bool;

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
    public function setCalendar(\Ivoz\Provider\Domain\Model\Calendar\CalendarInterface $calendar);

    /**
     * Get calendar
     *
     * @return \Ivoz\Provider\Domain\Model\Calendar\CalendarInterface
     */
    public function getCalendar();

    /**
     * Get locution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getLocution();

    /**
     * Get extension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getExtension();

    /**
     * Get voiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getVoiceMailUser();

    /**
     * Get numberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getNumberCountry();

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
