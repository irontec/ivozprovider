<?php

namespace Ivoz\Provider\Domain\Model\Extension;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

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

    public function setUser(?UserInterface $user = null): static;

    /**
     * {@inheritDoc}
     */
    public function setNumber(string $number): static;

    /**
     * {@inheritDoc}
     */
    public function setNumberValue(?string $numberValue = null): static;

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

    public function getNumber(): string;

    public function getRouteType(): ?string;

    public function getNumberValue(): ?string;

    public function getFriendValue(): ?string;

    public function setCompany(CompanyInterface $company): static;

    public function getCompany(): CompanyInterface;

    public function getIvr(): ?IvrInterface;

    public function getHuntGroup(): ?HuntGroupInterface;

    public function getConferenceRoom(): ?ConferenceRoomInterface;

    public function getUser(): ?UserInterface;

    public function getQueue(): ?QueueInterface;

    public function getConditionalRoute(): ?ConditionalRouteInterface;

    public function getNumberCountry(): ?CountryInterface;

    public function isInitialized(): bool;

    public function addUser(UserInterface $user): ExtensionInterface;

    public function removeUser(UserInterface $user): ExtensionInterface;

    public function replaceUsers(ArrayCollection $users): ExtensionInterface;

    public function getUsers(?Criteria $criteria = null): array;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
