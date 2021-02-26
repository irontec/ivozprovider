<?php

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

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

    public function getName(): string;

    public function getDescription(): string;

    public function getStrategy(): string;

    public function getRingAllTimeout(): ?int;

    public function getNoAnswerTargetType(): ?string;

    public function getNoAnswerNumberValue(): ?string;

    public function getPreventMissedCalls(): int;

    public function getAllowCallForwards(): int;

    public function getCompany(): CompanyInterface;

    public function getNoAnswerLocution(): ?LocutionInterface;

    public function getNoAnswerExtension(): ?ExtensionInterface;

    public function getNoAnswerVoiceMailUser(): ?UserInterface;

    public function getNoAnswerNumberCountry(): ?CountryInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    public function addHuntGroupsRelUser(HuntGroupsRelUserInterface $huntGroupsRelUser): HuntGroupInterface;

    public function removeHuntGroupsRelUser(HuntGroupsRelUserInterface $huntGroupsRelUser): HuntGroupInterface;

    public function replaceHuntGroupsRelUsers(ArrayCollection $huntGroupsRelUsers): HuntGroupInterface;

    public function getHuntGroupsRelUsers(?Criteria $criteria = null): array;

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');

}
