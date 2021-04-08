<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriod;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule\CalendarPeriodsRelScheduleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

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

    public function getStartDate(): \DateTime;

    public function getEndDate(): \DateTime;

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

    public function addRelSchedule(CalendarPeriodsRelScheduleInterface $relSchedule): CalendarPeriodInterface;

    public function removeRelSchedule(CalendarPeriodsRelScheduleInterface $relSchedule): CalendarPeriodInterface;

    public function replaceRelSchedules(ArrayCollection $relSchedules): CalendarPeriodInterface;

    public function getRelSchedules(?Criteria $criteria = null): array;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
