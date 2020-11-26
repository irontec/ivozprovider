<?php

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* HuntGroupInterface
*/
interface HuntGroupInterface extends LoggableEntityInterface
{
    const STRATEGY_RINGALL = 'ringAll';

    const STRATEGY_LINEAR = 'linear';

    const STRATEGY_ROUNDROBIN = 'roundRobin';

    const STRATEGY_RANDOM = 'random';

    const NOANSWERTARGETTYPE_NUMBER = 'number';

    const NOANSWERTARGETTYPE_EXTENSION = 'extension';

    const NOANSWERTARGETTYPE_VOICEMAIL = 'voicemail';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get this Hungroup related users
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface[]
     */
    public function getHuntGroupUsersArray();

    /**
     * @return string
     */
    public function getNoAnswerRouteType();

    /**
     * Get the timeout numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNoAnswerNumberValueE164();

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Get strategy
     *
     * @return string
     */
    public function getStrategy(): string;

    /**
     * Get ringAllTimeout
     *
     * @return int | null
     */
    public function getRingAllTimeout(): ?int;

    /**
     * Get noAnswerTargetType
     *
     * @return string | null
     */
    public function getNoAnswerTargetType(): ?string;

    /**
     * Get noAnswerNumberValue
     *
     * @return string | null
     */
    public function getNoAnswerNumberValue(): ?string;

    /**
     * Get preventMissedCalls
     *
     * @return int
     */
    public function getPreventMissedCalls(): int;

    /**
     * Get allowCallForwards
     *
     * @return int
     */
    public function getAllowCallForwards(): int;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * Get noAnswerLocution
     *
     * @return LocutionInterface | null
     */
    public function getNoAnswerLocution(): ?LocutionInterface;

    /**
     * Get noAnswerExtension
     *
     * @return ExtensionInterface | null
     */
    public function getNoAnswerExtension(): ?ExtensionInterface;

    /**
     * Get noAnswerVoiceMailUser
     *
     * @return UserInterface | null
     */
    public function getNoAnswerVoiceMailUser(): ?UserInterface;

    /**
     * Get noAnswerNumberCountry
     *
     * @return CountryInterface | null
     */
    public function getNoAnswerNumberCountry(): ?CountryInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add huntGroupsRelUser
     *
     * @param HuntGroupsRelUserInterface $huntGroupsRelUser
     *
     * @return static
     */
    public function addHuntGroupsRelUser(HuntGroupsRelUserInterface $huntGroupsRelUser): HuntGroupInterface;

    /**
     * Remove huntGroupsRelUser
     *
     * @param HuntGroupsRelUserInterface $huntGroupsRelUser
     *
     * @return static
     */
    public function removeHuntGroupsRelUser(HuntGroupsRelUserInterface $huntGroupsRelUser): HuntGroupInterface;

    /**
     * Replace huntGroupsRelUsers
     *
     * @param ArrayCollection $huntGroupsRelUsers of HuntGroupsRelUserInterface
     *
     * @return static
     */
    public function replaceHuntGroupsRelUsers(ArrayCollection $huntGroupsRelUsers): HuntGroupInterface;

    /**
     * Get huntGroupsRelUsers
     * @param Criteria | null $criteria
     * @return HuntGroupsRelUserInterface[]
     */
    public function getHuntGroupsRelUsers(?Criteria $criteria = null): array;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');

}
