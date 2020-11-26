<?php

namespace Ivoz\Provider\Domain\Model\Extension;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* ExtensionInterface
*/
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
    public function setNumber(string $number): ExtensionInterface;

    /**
     * {@inheritDoc}
     */
    public function setNumberValue(string $numberValue = null): ExtensionInterface;

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
    public function getNumber(): string;

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
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    public function setCompany(CompanyInterface $company): ExtensionInterface;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

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
     * Get conferenceRoom
     *
     * @return ConferenceRoomInterface | null
     */
    public function getConferenceRoom(): ?ConferenceRoomInterface;

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
     * Get conditionalRoute
     *
     * @return ConditionalRouteInterface | null
     */
    public function getConditionalRoute(): ?ConditionalRouteInterface;

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
     * Add user
     *
     * @param UserInterface $user
     *
     * @return static
     */
    public function addUser(UserInterface $user): ExtensionInterface;

    /**
     * Remove user
     *
     * @param UserInterface $user
     *
     * @return static
     */
    public function removeUser(UserInterface $user): ExtensionInterface;

    /**
     * Replace users
     *
     * @param ArrayCollection $users of UserInterface
     *
     * @return static
     */
    public function replaceUsers(ArrayCollection $users): ExtensionInterface;

    /**
     * Get users
     * @param Criteria | null $criteria
     * @return UserInterface[]
     */
    public function getUsers(?Criteria $criteria = null): array;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');

}
