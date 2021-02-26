<?php

namespace Ivoz\Provider\Domain\Model\HolidayDate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;

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

    public function getName(): string;

    public function getEventDate(): \DateTime;

    public function getWholeDayEvent(): bool;

    public function getTimeIn(): ?\DateTime;

    public function getTimeOut(): ?\DateTime;

    public function getRouteType(): ?string;

    public function getNumberValue(): ?string;

    public function setCalendar(CalendarInterface $calendar): static;

    public function getCalendar(): CalendarInterface;

    public function getLocution(): ?LocutionInterface;

    public function getExtension(): ?ExtensionInterface;

    public function getVoiceMailUser(): ?UserInterface;

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
