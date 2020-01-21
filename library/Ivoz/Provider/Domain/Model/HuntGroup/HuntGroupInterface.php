<?php

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

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
     * Set ringAllTimeout
     *
     * @param integer $ringAllTimeout
     *
     * @return self
     */
    public function setRingAllTimeout($ringAllTimeout);

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
    public function getName();

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get strategy
     *
     * @return string
     */
    public function getStrategy();

    /**
     * Get ringAllTimeout
     *
     * @return integer
     */
    public function getRingAllTimeout();

    /**
     * Get noAnswerTargetType
     *
     * @return string | null
     */
    public function getNoAnswerTargetType();

    /**
     * Get noAnswerNumberValue
     *
     * @return string | null
     */
    public function getNoAnswerNumberValue();

    /**
     * Get preventMissedCalls
     *
     * @return integer
     */
    public function getPreventMissedCalls();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set noAnswerLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $noAnswerLocution | null
     *
     * @return static
     */
    public function setNoAnswerLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $noAnswerLocution = null);

    /**
     * Get noAnswerLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getNoAnswerLocution();

    /**
     * Set noAnswerExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $noAnswerExtension | null
     *
     * @return static
     */
    public function setNoAnswerExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $noAnswerExtension = null);

    /**
     * Get noAnswerExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getNoAnswerExtension();

    /**
     * Set noAnswerVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $noAnswerVoiceMailUser | null
     *
     * @return static
     */
    public function setNoAnswerVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $noAnswerVoiceMailUser = null);

    /**
     * Get noAnswerVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getNoAnswerVoiceMailUser();

    /**
     * Set noAnswerNumberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $noAnswerNumberCountry | null
     *
     * @return static
     */
    public function setNoAnswerNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $noAnswerNumberCountry = null);

    /**
     * Get noAnswerNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getNoAnswerNumberCountry();

    /**
     * Add huntGroupsRelUser
     *
     * @param \Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface $huntGroupsRelUser
     *
     * @return static
     */
    public function addHuntGroupsRelUser(\Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface $huntGroupsRelUser);

    /**
     * Remove huntGroupsRelUser
     *
     * @param \Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface $huntGroupsRelUser
     */
    public function removeHuntGroupsRelUser(\Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface $huntGroupsRelUser);

    /**
     * Replace huntGroupsRelUsers
     *
     * @param ArrayCollection $huntGroupsRelUsers of Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface
     * @return static
     */
    public function replaceHuntGroupsRelUsers(ArrayCollection $huntGroupsRelUsers);

    /**
     * Get huntGroupsRelUsers
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface[]
     */
    public function getHuntGroupsRelUsers(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * @param string $prefix
     * @return null|string
     */
    public function getTarget(string $prefix = '');
}
