<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

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
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority(): int;

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
     * Get friendValue
     *
     * @return string | null
     */
    public function getFriendValue(): ?string;

    /**
     * Set conditionalRoute
     *
     * @param ConditionalRouteInterface
     *
     * @return static
     */
    public function setConditionalRoute(ConditionalRouteInterface $conditionalRoute): ConditionalRoutesConditionInterface;

    /**
     * Get conditionalRoute
     *
     * @return ConditionalRouteInterface
     */
    public function getConditionalRoute(): ConditionalRouteInterface;

    /**
     * Get ivr
     *
     * @return IvrInterface | null
     */
    public function getIvr(): ?IvrInterface;

    /**
     * Get huntGroup
     *
     * @return HuntGroupInterface | null
     */
    public function getHuntGroup(): ?HuntGroupInterface;

    /**
     * Get voicemailUser
     *
     * @return UserInterface | null
     */
    public function getVoicemailUser(): ?UserInterface;

    /**
     * Get user
     *
     * @return UserInterface | null
     */
    public function getUser(): ?UserInterface;

    /**
     * Get queue
     *
     * @return QueueInterface | null
     */
    public function getQueue(): ?QueueInterface;

    /**
     * Get locution
     *
     * @return LocutionInterface | null
     */
    public function getLocution(): ?LocutionInterface;

    /**
     * Get conferenceRoom
     *
     * @return ConferenceRoomInterface | null
     */
    public function getConferenceRoom(): ?ConferenceRoomInterface;

    /**
     * Get extension
     *
     * @return ExtensionInterface | null
     */
    public function getExtension(): ?ExtensionInterface;

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
     * Add relMatchlist
     *
     * @param ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist
     *
     * @return static
     */
    public function addRelMatchlist(ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist): ConditionalRoutesConditionInterface;

    /**
     * Remove relMatchlist
     *
     * @param ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist
     *
     * @return static
     */
    public function removeRelMatchlist(ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist): ConditionalRoutesConditionInterface;

    /**
     * Replace relMatchlists
     *
     * @param ArrayCollection $relMatchlists of ConditionalRoutesConditionsRelMatchlistInterface
     *
     * @return static
     */
    public function replaceRelMatchlists(ArrayCollection $relMatchlists): ConditionalRoutesConditionInterface;

    /**
     * Get relMatchlists
     * @param Criteria | null $criteria
     * @return ConditionalRoutesConditionsRelMatchlistInterface[]
     */
    public function getRelMatchlists(?Criteria $criteria = null): array;

    /**
     * Add relSchedule
     *
     * @param ConditionalRoutesConditionsRelScheduleInterface $relSchedule
     *
     * @return static
     */
    public function addRelSchedule(ConditionalRoutesConditionsRelScheduleInterface $relSchedule): ConditionalRoutesConditionInterface;

    /**
     * Remove relSchedule
     *
     * @param ConditionalRoutesConditionsRelScheduleInterface $relSchedule
     *
     * @return static
     */
    public function removeRelSchedule(ConditionalRoutesConditionsRelScheduleInterface $relSchedule): ConditionalRoutesConditionInterface;

    /**
     * Replace relSchedules
     *
     * @param ArrayCollection $relSchedules of ConditionalRoutesConditionsRelScheduleInterface
     *
     * @return static
     */
    public function replaceRelSchedules(ArrayCollection $relSchedules): ConditionalRoutesConditionInterface;

    /**
     * Get relSchedules
     * @param Criteria | null $criteria
     * @return ConditionalRoutesConditionsRelScheduleInterface[]
     */
    public function getRelSchedules(?Criteria $criteria = null): array;

    /**
     * Add relCalendar
     *
     * @param ConditionalRoutesConditionsRelCalendarInterface $relCalendar
     *
     * @return static
     */
    public function addRelCalendar(ConditionalRoutesConditionsRelCalendarInterface $relCalendar): ConditionalRoutesConditionInterface;

    /**
     * Remove relCalendar
     *
     * @param ConditionalRoutesConditionsRelCalendarInterface $relCalendar
     *
     * @return static
     */
    public function removeRelCalendar(ConditionalRoutesConditionsRelCalendarInterface $relCalendar): ConditionalRoutesConditionInterface;

    /**
     * Replace relCalendars
     *
     * @param ArrayCollection $relCalendars of ConditionalRoutesConditionsRelCalendarInterface
     *
     * @return static
     */
    public function replaceRelCalendars(ArrayCollection $relCalendars): ConditionalRoutesConditionInterface;

    /**
     * Get relCalendars
     * @param Criteria | null $criteria
     * @return ConditionalRoutesConditionsRelCalendarInterface[]
     */
    public function getRelCalendars(?Criteria $criteria = null): array;

    /**
     * Add relRouteLock
     *
     * @param ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock
     *
     * @return static
     */
    public function addRelRouteLock(ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock): ConditionalRoutesConditionInterface;

    /**
     * Remove relRouteLock
     *
     * @param ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock
     *
     * @return static
     */
    public function removeRelRouteLock(ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock): ConditionalRoutesConditionInterface;

    /**
     * Replace relRouteLocks
     *
     * @param ArrayCollection $relRouteLocks of ConditionalRoutesConditionsRelRouteLockInterface
     *
     * @return static
     */
    public function replaceRelRouteLocks(ArrayCollection $relRouteLocks): ConditionalRoutesConditionInterface;

    /**
     * Get relRouteLocks
     * @param Criteria | null $criteria
     * @return ConditionalRoutesConditionsRelRouteLockInterface[]
     */
    public function getRelRouteLocks(?Criteria $criteria = null): array;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');

}
