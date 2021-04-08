<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoute;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
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

    public function getName(): string;

    public function getRoutetype(): ?string;

    public function getNumbervalue(): ?string;

    public function getFriendvalue(): ?string;

    public function getCompany(): CompanyInterface;

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

    public function addCondition(ConditionalRoutesConditionInterface $condition): ConditionalRouteInterface;

    public function removeCondition(ConditionalRoutesConditionInterface $condition): ConditionalRouteInterface;

    public function replaceConditions(ArrayCollection $conditions): ConditionalRouteInterface;

    public function getConditions(?Criteria $criteria = null): array;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
