<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface ConditionalRoutesConditionInterface extends LoggableEntityInterface
{
    public function getChangeSet();

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164();

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return self
     */
    public function setPriority($priority);

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority();

    /**
     * Set routeType
     *
     * @param string $routeType
     *
     * @return self
     */
    public function setRouteType($routeType = null);

    /**
     * Get routeType
     *
     * @return string
     */
    public function getRouteType();

    /**
     * Set numberValue
     *
     * @param string $numberValue
     *
     * @return self
     */
    public function setNumberValue($numberValue = null);

    /**
     * Get numberValue
     *
     * @return string
     */
    public function getNumberValue();

    /**
     * Set friendValue
     *
     * @param string $friendValue
     *
     * @return self
     */
    public function setFriendValue($friendValue = null);

    /**
     * Get friendValue
     *
     * @return string
     */
    public function getFriendValue();

    /**
     * Set conditionalRoute
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface $conditionalRoute
     *
     * @return self
     */
    public function setConditionalRoute(\Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface $conditionalRoute);

    /**
     * Get conditionalRoute
     *
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface
     */
    public function getConditionalRoute();

    /**
     * Set ivr
     *
     * @param \Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr
     *
     * @return self
     */
    public function setIvr(\Ivoz\Provider\Domain\Model\Ivr\IvrInterface $ivr = null);

    /**
     * Get ivr
     *
     * @return \Ivoz\Provider\Domain\Model\Ivr\IvrInterface
     */
    public function getIvr();

    /**
     * Set huntGroup
     *
     * @param \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntGroup
     *
     * @return self
     */
    public function setHuntGroup(\Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntGroup = null);

    /**
     * Get huntGroup
     *
     * @return \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface
     */
    public function getHuntGroup();

    /**
     * Set voicemailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $voicemailUser
     *
     * @return self
     */
    public function setVoicemailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $voicemailUser = null);

    /**
     * Get voicemailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getVoicemailUser();

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     *
     * @return self
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user = null);

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getUser();

    /**
     * Set queue
     *
     * @param \Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue
     *
     * @return self
     */
    public function setQueue(\Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue = null);

    /**
     * Get queue
     *
     * @return \Ivoz\Provider\Domain\Model\Queue\QueueInterface
     */
    public function getQueue();

    /**
     * Set locution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $locution
     *
     * @return self
     */
    public function setLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $locution = null);

    /**
     * Get locution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getLocution();

    /**
     * Set conferenceRoom
     *
     * @param \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface $conferenceRoom
     *
     * @return self
     */
    public function setConferenceRoom(\Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface $conferenceRoom = null);

    /**
     * Get conferenceRoom
     *
     * @return \Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface
     */
    public function getConferenceRoom();

    /**
     * Set extension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension
     *
     * @return self
     */
    public function setExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension = null);

    /**
     * Get extension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getExtension();

    /**
     * Set numberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $numberCountry
     *
     * @return self
     */
    public function setNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $numberCountry = null);

    /**
     * Get numberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getNumberCountry();

    /**
     * Add matchlist
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface $matchlist
     *
     * @return ConditionalRoutesConditionTrait
     */
    public function addMatchlist(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface $matchlist);

    /**
     * Remove matchlist
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface $matchlist
     */
    public function removeMatchlist(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface $matchlist);

    /**
     * Replace matchlists
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface[] $matchlists
     * @return self
     */
    public function replaceMatchlists(Collection $matchlists);

    /**
     * Get matchlists
     *
     * @return array
     */
    public function getMatchlists(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add schedule
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface $schedule
     *
     * @return ConditionalRoutesConditionTrait
     */
    public function addSchedule(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface $schedule);

    /**
     * Remove schedule
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface $schedule
     */
    public function removeSchedule(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface $schedule);

    /**
     * Replace schedules
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface[] $schedules
     * @return self
     */
    public function replaceSchedules(Collection $schedules);

    /**
     * Get schedules
     *
     * @return array
     */
    public function getSchedules(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add calendar
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface $calendar
     *
     * @return ConditionalRoutesConditionTrait
     */
    public function addCalendar(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface $calendar);

    /**
     * Remove calendar
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface $calendar
     */
    public function removeCalendar(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface $calendar);

    /**
     * Replace calendars
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface[] $calendars
     * @return self
     */
    public function replaceCalendars(Collection $calendars);

    /**
     * Get calendars
     *
     * @return array
     */
    public function getCalendars(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');

}

