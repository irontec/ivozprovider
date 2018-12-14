<?php

namespace Ivoz\Provider\Domain\Model\User;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface UserInterface extends LoggableEntityInterface
{
    /**
     * @return array
     */
    public function getChangeSet();

    public function serialize();

    public function unserialize($serialized);

    /**
     * @inheritdoc
     */
    public function setPass($pass = null);

    /**
     * return associated endpoint with the user
     *
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface
     */
    public function getEndpoint();

    /**
     * @return string or null
     */
    public function getUserTerminalInterface();

    /**
     * @return string with the voicemail
     */
    public function getVoiceMail();

    /**
     * @return string with the voicemail user
     */
    public function getVoiceMailUser();

    /**
     * @return string with the voicemail context
     */
    public function getVoiceMailContext();

    /**
     * @return string
     */
    public function getOutgoingDdiNumber();

    /**
     * Get User outgoingDdi
     * If no Ddi is assigned, retrieve company's default Ddi
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getOutgoingDdi();

    /**
     * Get User outgoingDdiRule
     * If no OutgoingDdiRule is assigned, retrieve company's default OutgoingDdiRule
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface or null
     */
    public function getOutgoingDdiRule();

    /**
     * @return string
     */
    public function getExtensionNumber();

    /**
     * @param string $exten
     * @return bool canCall
     */
    public function isAllowedToCall($exten);

    /**
     * @return \Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface[]
     */
    public function getPickUpGroups();

    /**
     * @return string comma separated pickup group ids
     */
    public function getPickUpGroupsIds();

    /**
     * @return string
     */
    public function getFullName();

    /**
     * @return array
     */
    public function toArrayPortalForm();

    /**
     * @return bool
     */
    public function canBeCalled();

    /**
     * Get user language
     * returns company language if empty
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    public function getLanguage();

    /**
     * Get User language code.
     * If not set, get the company language code
     * @return string
     */
    public function getLanguageCode();

    public function setEmail($email = null);

    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getTimezone();

    /**
     * @return string
     */
    public function getFullNameExtension();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname();

    /**
     * Get email
     *
     * @return string | null
     */
    public function getEmail();

    /**
     * Get pass
     *
     * @return string | null
     */
    public function getPass();

    /**
     * Get doNotDisturb
     *
     * @return boolean
     */
    public function getDoNotDisturb();

    /**
     * Get isBoss
     *
     * @return boolean
     */
    public function getIsBoss();

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive();

    /**
     * Get maxCalls
     *
     * @return integer
     */
    public function getMaxCalls();

    /**
     * Get externalIpCalls
     *
     * @return string
     */
    public function getExternalIpCalls();

    /**
     * Get voicemailEnabled
     *
     * @return boolean
     */
    public function getVoicemailEnabled();

    /**
     * Get voicemailSendMail
     *
     * @return boolean
     */
    public function getVoicemailSendMail();

    /**
     * Get voicemailAttachSound
     *
     * @return boolean
     */
    public function getVoicemailAttachSound();

    /**
     * Get tokenKey
     *
     * @return string | null
     */
    public function getTokenKey();

    /**
     * Get gsQRCode
     *
     * @return boolean
     */
    public function getGsQRCode();

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
     * Set callAcl
     *
     * @param \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface $callAcl
     *
     * @return self
     */
    public function setCallAcl(\Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface $callAcl = null);

    /**
     * Get callAcl
     *
     * @return \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface
     */
    public function getCallAcl();

    /**
     * Set bossAssistant
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $bossAssistant
     *
     * @return self
     */
    public function setBossAssistant(\Ivoz\Provider\Domain\Model\User\UserInterface $bossAssistant = null);

    /**
     * Get bossAssistant
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getBossAssistant();

    /**
     * Set bossAssistantWhiteList
     *
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $bossAssistantWhiteList
     *
     * @return self
     */
    public function setBossAssistantWhiteList(\Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $bossAssistantWhiteList = null);

    /**
     * Get bossAssistantWhiteList
     *
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    public function getBossAssistantWhiteList();

    /**
     * Set transformationRuleSet
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet
     *
     * @return self
     */
    public function setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet = null);

    /**
     * Get transformationRuleSet
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface
     */
    public function getTransformationRuleSet();

    /**
     * Set language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language
     *
     * @return self
     */
    public function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageInterface $language = null);

    /**
     * Set terminal
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal
     *
     * @return self
     */
    public function setTerminal(\Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal = null);

    /**
     * Get terminal
     *
     * @return \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface
     */
    public function getTerminal();

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
     * Set timezone
     *
     * @param \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $timezone
     *
     * @return self
     */
    public function setTimezone(\Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $timezone = null);

    /**
     * Set outgoingDdi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi
     *
     * @return self
     */
    public function setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi = null);

    /**
     * Set outgoingDdiRule
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule
     *
     * @return self
     */
    public function setOutgoingDdiRule(\Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule = null);

    /**
     * Set voicemailLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $voicemailLocution
     *
     * @return self
     */
    public function setVoicemailLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $voicemailLocution = null);

    /**
     * Get voicemailLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getVoicemailLocution();

    /**
     * Add pickUpRelUser
     *
     * @param \Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface $pickUpRelUser
     *
     * @return UserTrait
     */
    public function addPickUpRelUser(\Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface $pickUpRelUser);

    /**
     * Remove pickUpRelUser
     *
     * @param \Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface $pickUpRelUser
     */
    public function removePickUpRelUser(\Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface $pickUpRelUser);

    /**
     * Replace pickUpRelUsers
     *
     * @param \Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface[] $pickUpRelUsers
     * @return self
     */
    public function replacePickUpRelUsers(Collection $pickUpRelUsers);

    /**
     * Get pickUpRelUsers
     *
     * @return \Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface[]
     */
    public function getPickUpRelUsers(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add queueMember
     *
     * @param \Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface $queueMember
     *
     * @return UserTrait
     */
    public function addQueueMember(\Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface $queueMember);

    /**
     * Remove queueMember
     *
     * @param \Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface $queueMember
     */
    public function removeQueueMember(\Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface $queueMember);

    /**
     * Replace queueMembers
     *
     * @param \Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface[] $queueMembers
     * @return self
     */
    public function replaceQueueMembers(Collection $queueMembers);

    /**
     * Get queueMembers
     *
     * @return \Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface[]
     */
    public function getQueueMembers(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add callForwardSetting
     *
     * @param \Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface $callForwardSetting
     *
     * @return UserTrait
     */
    public function addCallForwardSetting(\Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface $callForwardSetting);

    /**
     * Remove callForwardSetting
     *
     * @param \Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface $callForwardSetting
     */
    public function removeCallForwardSetting(\Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface $callForwardSetting);

    /**
     * Replace callForwardSettings
     *
     * @param \Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface[] $callForwardSettings
     * @return self
     */
    public function replaceCallForwardSettings(Collection $callForwardSettings);

    /**
     * Get callForwardSettings
     *
     * @return \Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface[]
     */
    public function getCallForwardSettings(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * @see AdvancedUserInterface::getRoles()
     */
    public function getRoles();

    /**
     * @see AdvancedUserInterface::getUsername()
     */
    public function getUsername();

    /**
     * @see AdvancedUserInterface::getPassword()
     */
    public function getPassword();

    /**
     * @see AdvancedUserInterface::isAccountNonExpired()
     */
    public function isAccountNonExpired();

    /**
     * @see AdvancedUserInterface::isAccountNonLocked()
     */
    public function isAccountNonLocked();

    /**
     * @see AdvancedUserInterface::isCredentialsNonExpired()
     */
    public function isCredentialsNonExpired();

    /**
     * @see AdvancedUserInterface::isEnabled()
     */
    public function isEnabled();

    /**
     * @see AdvancedUserInterface::getSalt()
     */
    public function getSalt();

    /**
     * @see AdvancedUserInterface::eraseCredentials()
     */
    public function eraseCredentials();
}
