<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoute;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* ConditionalRouteInterface
*/
interface ConditionalRouteInterface extends LoggableEntityInterface
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
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get routetype
     *
     * @return string | null
     */
    public function getRoutetype(): ?string;

    /**
     * Get numbervalue
     *
     * @return string | null
     */
    public function getNumbervalue(): ?string;

    /**
     * Get friendvalue
     *
     * @return string | null
     */
    public function getFriendvalue(): ?string;

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
     * Add condition
     *
     * @param ConditionalRoutesConditionInterface $condition
     *
     * @return static
     */
    public function addCondition(ConditionalRoutesConditionInterface $condition): ConditionalRouteInterface;

    /**
     * Remove condition
     *
     * @param ConditionalRoutesConditionInterface $condition
     *
     * @return static
     */
    public function removeCondition(ConditionalRoutesConditionInterface $condition): ConditionalRouteInterface;

    /**
     * Replace conditions
     *
     * @param ArrayCollection $conditions of ConditionalRoutesConditionInterface
     *
     * @return static
     */
    public function replaceConditions(ArrayCollection $conditions): ConditionalRouteInterface;

    /**
     * Get conditions
     * @param Criteria | null $criteria
     * @return ConditionalRoutesConditionInterface[]
     */
    public function getConditions(?Criteria $criteria = null): array;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');

}
