<?php

namespace Ivoz\Provider\Domain\Model\Extension;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

interface ExtensionInterface extends LoggableEntityInterface
{
    const ROUTETYPE_USER = 'user';
    const ROUTETYPE_NUMBER = 'number';
    const ROUTETYPE_IVR = 'ivr';
    const ROUTETYPE_HUNTGROUP = 'huntGroup';
    const ROUTETYPE_CONFERENCEROOM = 'conferenceRoom';
    const ROUTETYPE_FRIEND = 'friend';
    const ROUTETYPE_QUEUE = 'queue';
    const ROUTETYPE_CONDITIONAL = 'conditional';


    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setNumber($number);

    /**
     * {@inheritDoc}
     */
    public function setNumberValue($numberValue = null);

    public function toArrayPortal();

    /**
     * Get User using this Extension as ScreenExtension
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface|null
     */
    public function getScreenUser();

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164();

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber();

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
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

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
     * Set conditionalRoute
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface $conditionalRoute | null
     *
     * @return static
     */
    public function setConditionalRoute(\Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface $conditionalRoute = null);

    /**
     * Get conditionalRoute
     *
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface | null
     */
    public function getConditionalRoute();

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
     * Add user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     *
     * @return static
     */
    public function addUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user);

    /**
     * Remove user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     */
    public function removeUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user);

    /**
     * Replace users
     *
     * @param ArrayCollection $users of Ivoz\Provider\Domain\Model\User\UserInterface
     * @return static
     */
    public function replaceUsers(ArrayCollection $users);

    /**
     * Get users
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface[]
     */
    public function getUsers(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
