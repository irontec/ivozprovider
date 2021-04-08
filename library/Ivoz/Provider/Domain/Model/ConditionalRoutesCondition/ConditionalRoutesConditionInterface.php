<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockInterface;

/**
* ConditionalRoutesConditionInterface
*/
interface ConditionalRoutesConditionInterface extends LoggableEntityInterface
{
    const ROUTETYPE_USER = 'user';

    const ROUTETYPE_NUMBER = 'number';

    const ROUTETYPE_IVR = 'ivr';

    const ROUTETYPE_HUNTGROUP = 'huntGroup';

    const ROUTETYPE_VOICEMAIL = 'voicemail';

    const ROUTETYPE_FRIEND = 'friend';

    const ROUTETYPE_QUEUE = 'queue';

    const ROUTETYPE_CONFERENCEROOM = 'conferenceRoom';

    const ROUTETYPE_EXTENSION = 'extension';

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
     * Return MatchLists associated with this condition
     *
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface[]
     */
    public function getMatchLists();

    /**
     * Return Schedules associated with this condition
     *
     * @return \Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface[]
     */
    public function getSchedules();

    /**
     * Return Calendars associated with this condition
     *
     * @return \Ivoz\Provider\Domain\Model\Calendar\CalendarInterface[]
     */
    public function getCalendars();

    /**
     * Return Route Locks associated with this condition
     *
     * @return \Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface[]
     */
    public function getRouteLocks();

    /**
     * Checks if this condition mathes the given origin
     *
     * @param string $number in E.164 format
     * @return bool true if condition matches
     */
    public function matchesOrigin($number);

    /**
     * Checks if current time in Company's timezone matches condition schedules
     *
     * @return bool true if condition matches
     */
    public function matchesSchedule();

    /**
     * Checks if today is holiday in condition calendars
     *
     * @return bool true if condition matches
     */
    public function matchesCalendar();

    /**
     * Checks if any of the Locks is open
     *
     * @return bool true if condition matches
     */
    public function matchesRouteLock();

    /**
     * Return a string representation of matching conditions
     *
     * @return string
     */
    public function getMatchData();

    public function getPriority(): int;

    public function getRouteType(): ?string;

    public function getNumberValue(): ?string;

    public function getFriendValue(): ?string;

    public function setConditionalRoute(ConditionalRouteInterface $conditionalRoute): static;

    public function getConditionalRoute(): ConditionalRouteInterface;

    public function getIvr(): ?IvrInterface;

    public function getHuntGroup(): ?HuntGroupInterface;

    public function getVoicemailUser(): ?UserInterface;

    public function getUser(): ?UserInterface;

    public function getQueue(): ?QueueInterface;

    public function getLocution(): ?LocutionInterface;

    public function getConferenceRoom(): ?ConferenceRoomInterface;

    public function getExtension(): ?ExtensionInterface;

    public function getNumberCountry(): ?CountryInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    public function addRelMatchlist(ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist): ConditionalRoutesConditionInterface;

    public function removeRelMatchlist(ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist): ConditionalRoutesConditionInterface;

    public function replaceRelMatchlists(ArrayCollection $relMatchlists): ConditionalRoutesConditionInterface;

    public function getRelMatchlists(?Criteria $criteria = null): array;

    public function addRelSchedule(ConditionalRoutesConditionsRelScheduleInterface $relSchedule): ConditionalRoutesConditionInterface;

    public function removeRelSchedule(ConditionalRoutesConditionsRelScheduleInterface $relSchedule): ConditionalRoutesConditionInterface;

    public function replaceRelSchedules(ArrayCollection $relSchedules): ConditionalRoutesConditionInterface;

    public function getRelSchedules(?Criteria $criteria = null): array;

    public function addRelCalendar(ConditionalRoutesConditionsRelCalendarInterface $relCalendar): ConditionalRoutesConditionInterface;

    public function removeRelCalendar(ConditionalRoutesConditionsRelCalendarInterface $relCalendar): ConditionalRoutesConditionInterface;

    public function replaceRelCalendars(ArrayCollection $relCalendars): ConditionalRoutesConditionInterface;

    public function getRelCalendars(?Criteria $criteria = null): array;

    public function addRelRouteLock(ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock): ConditionalRoutesConditionInterface;

    public function removeRelRouteLock(ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock): ConditionalRoutesConditionInterface;

    public function replaceRelRouteLocks(ArrayCollection $relRouteLocks): ConditionalRoutesConditionInterface;

    public function getRelRouteLocks(?Criteria $criteria = null): array;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
