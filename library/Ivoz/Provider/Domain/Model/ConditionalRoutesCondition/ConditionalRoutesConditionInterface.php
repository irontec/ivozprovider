<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @return integer
     */
    public function getPriority();

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
     * Get friendValue
     *
     * @return string | null
     */
    public function getFriendValue();

    /**
     * Set conditionalRoute
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface $conditionalRoute
     *
     * @return static
     */
    public function setConditionalRoute(\Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface $conditionalRoute = null);

    /**
     * Get conditionalRoute
     *
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface
     */
    public function getConditionalRoute();

    /**
     * Set ivr
     *
     * @param \Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr | null
     *
     * @return static
     */
    public function setIvr(\Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr = null);

    /**
     * Get ivr
     *
     * @return \Ivoz\Provider\Domain\Model\Ivr\IvrInterface | null
     */
    public function getIvr();

    /**
     * Set huntGroup
     *
     * @param \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntGroup | null
     *
     * @return static
     */
    public function setHuntGroup(\Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntGroup = null);

    /**
     * Get huntGroup
     *
     * @return \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface | null
     */
    public function getHuntGroup();

    /**
     * Set voicemailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $voicemailUser | null
     *
     * @return static
     */
    public function setVoicemailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $voicemailUser = null);

    /**
     * Get voicemailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getVoicemailUser();

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user | null
     *
     * @return static
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user = null);

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getUser();

    /**
     * Set queue
     *
     * @param \Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue | null
     *
     * @return static
     */
    public function setQueue(\Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue = null);

    /**
     * Get queue
     *
     * @return \Ivoz\Provider\Domain\Model\Queue\QueueInterface | null
     */
    public function getQueue();

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
     * Set conferenceRoom
     *
     * @param \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface $conferenceRoom | null
     *
     * @return static
     */
    public function setConferenceRoom(\Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface $conferenceRoom = null);

    /**
     * Get conferenceRoom
     *
     * @return \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface | null
     */
    public function getConferenceRoom();

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
     * Add relMatchlist
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist
     *
     * @return static
     */
    public function addRelMatchlist(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist);

    /**
     * Remove relMatchlist
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist
     */
    public function removeRelMatchlist(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist);

    /**
     * Replace relMatchlists
     *
     * @param ArrayCollection $relMatchlists of Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface
     * @return static
     */
    public function replaceRelMatchlists(ArrayCollection $relMatchlists);

    /**
     * Get relMatchlists
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface[]
     */
    public function getRelMatchlists(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add relSchedule
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface $relSchedule
     *
     * @return static
     */
    public function addRelSchedule(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface $relSchedule);

    /**
     * Remove relSchedule
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface $relSchedule
     */
    public function removeRelSchedule(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface $relSchedule);

    /**
     * Replace relSchedules
     *
     * @param ArrayCollection $relSchedules of Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface
     * @return static
     */
    public function replaceRelSchedules(ArrayCollection $relSchedules);

    /**
     * Get relSchedules
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface[]
     */
    public function getRelSchedules(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add relCalendar
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface $relCalendar
     *
     * @return static
     */
    public function addRelCalendar(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface $relCalendar);

    /**
     * Remove relCalendar
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface $relCalendar
     */
    public function removeRelCalendar(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface $relCalendar);

    /**
     * Replace relCalendars
     *
     * @param ArrayCollection $relCalendars of Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface
     * @return static
     */
    public function replaceRelCalendars(ArrayCollection $relCalendars);

    /**
     * Get relCalendars
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface[]
     */
    public function getRelCalendars(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add relRouteLock
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock
     *
     * @return static
     */
    public function addRelRouteLock(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock);

    /**
     * Remove relRouteLock
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock
     */
    public function removeRelRouteLock(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock);

    /**
     * Replace relRouteLocks
     *
     * @param ArrayCollection $relRouteLocks of Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockInterface
     * @return static
     */
    public function replaceRelRouteLocks(ArrayCollection $relRouteLocks);

    /**
     * Get relRouteLocks
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockInterface[]
     */
    public function getRelRouteLocks(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
