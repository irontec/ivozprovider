<?php

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Ivoz\Core\Domain\Model\EntityInterface;
use Doctrine\Common\Collections\Collection;

interface HuntGroupInterface extends EntityInterface
{
    /**
     * Get this Hungroup related users
     * @return User[]
     */
    public function getHuntGroupUsersArray();

    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set strategy
     *
     * @param string $strategy
     *
     * @return self
     */
    public function setStrategy($strategy);

    /**
     * Get strategy
     *
     * @return string
     */
    public function getStrategy();

    /**
     * Set ringAllTimeout
     *
     * @param integer $ringAllTimeout
     *
     * @return self
     */
    public function setRingAllTimeout($ringAllTimeout);

    /**
     * Get ringAllTimeout
     *
     * @return integer
     */
    public function getRingAllTimeout();

    /**
     * Set nextUserPosition
     *
     * @param integer $nextUserPosition
     *
     * @return self
     */
    public function setNextUserPosition($nextUserPosition = null);

    /**
     * Get nextUserPosition
     *
     * @return integer
     */
    public function getNextUserPosition();

    /**
     * Set noAnswerTargetType
     *
     * @param string $noAnswerTargetType
     *
     * @return self
     */
    public function setNoAnswerTargetType($noAnswerTargetType = null);

    /**
     * Get noAnswerTargetType
     *
     * @return string
     */
    public function getNoAnswerTargetType();

    /**
     * Set noAnswerNumberValue
     *
     * @param string $noAnswerNumberValue
     *
     * @return self
     */
    public function setNoAnswerNumberValue($noAnswerNumberValue = null);

    /**
     * Get noAnswerNumberValue
     *
     * @return string
     */
    public function getNoAnswerNumberValue();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
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
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $noAnswerLocution
     *
     * @return self
     */
    public function setNoAnswerLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $noAnswerLocution = null);

    /**
     * Get noAnswerLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getNoAnswerLocution();

    /**
     * Set noAnswerExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $noAnswerExtension
     *
     * @return self
     */
    public function setNoAnswerExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $noAnswerExtension = null);

    /**
     * Get noAnswerExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getNoAnswerExtension();

    /**
     * Set noAnswerVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $noAnswerVoiceMailUser
     *
     * @return self
     */
    public function setNoAnswerVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $noAnswerVoiceMailUser = null);

    /**
     * Get noAnswerVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getNoAnswerVoiceMailUser();

    /**
     * Add huntGroupsRelUser
     *
     * @param \Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface $huntGroupsRelUser
     *
     * @return HuntGroupTrait
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
     * @param \Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface[] $huntGroupsRelUsers
     * @return self
     */
    public function replaceHuntGroupsRelUsers(Collection $huntGroupsRelUsers);

    /**
     * Get huntGroupsRelUsers
     *
     * @return array
     */
    public function getHuntGroupsRelUsers(\Doctrine\Common\Collections\Criteria $criteria = null);

}

