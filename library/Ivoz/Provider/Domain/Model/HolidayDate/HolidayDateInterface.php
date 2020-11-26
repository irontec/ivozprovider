<?php

namespace Ivoz\Provider\Domain\Model\HolidayDate;

use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* HolidayDateInterface
*/
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
     * @return \DateTimeInterface
     */
    public function getEventDate(): \DateTimeInterface;

    /**
     * Get wholeDayEvent
     *
     * @return bool
     */
    public function getWholeDayEvent(): bool;

    /**
     * Get timeIn
     *
     * @return \DateTimeInterface | null
     */
    public function getTimeIn(): ?\DateTimeInterface;

    /**
     * Get timeOut
     *
     * @return \DateTimeInterface | null
     */
    public function getTimeOut(): ?\DateTimeInterface;

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
    public function setCalendar(CalendarInterface $calendar): HolidayDateInterface;

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
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');

}
