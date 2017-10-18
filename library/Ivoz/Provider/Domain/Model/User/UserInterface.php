<?php

namespace Ivoz\Provider\Domain\Model\User;

use Ivoz\Core\Domain\Model\EntityInterface;
use Doctrine\Common\Collections\Collection;

interface UserInterface extends EntityInterface
{
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
     * @todo this is probably dead code
     * @return string or null
     */
    public function getDomain();

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
     * returns company language if wmpty
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    public function getLanguage();

    /**
     * Get User language code.
     * If not set, get the company language code
     * @return string
     */
    public function getLanguageCode();

    /**
     * Get User country
     * return company country if empty
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getCountry();

    /**
     * Convert a user dialed number to E164 form
     *
     * @param string $prefNumber
     * @return string number in E164
     */
    public function preferredToE164($prefNumber);

    /**
     * Convert a received number to User prefered format
     *
     * @param string $number
     */
    public function E164ToPreferred($e164number);

    /**
     * Gets user Area Code. returns company area code if empty
     *
     * @return string
     */
    public function getAreaCodeValue();

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
     * Set lastname
     *
     * @param string $lastname
     *
     * @return self
     */
    public function setLastname($lastname);

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname();

    /**
     * Set email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email = null);

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set pass
     *
     * @param string $pass
     *
     * @return self
     */
    public function setPass($pass = null);

    /**
     * Get pass
     *
     * @return string
     */
    public function getPass();

    /**
     * Set doNotDisturb
     *
     * @param boolean $doNotDisturb
     *
     * @return self
     */
    public function setDoNotDisturb($doNotDisturb);

    /**
     * Get doNotDisturb
     *
     * @return boolean
     */
    public function getDoNotDisturb();

    /**
     * Set isBoss
     *
     * @param boolean $isBoss
     *
     * @return self
     */
    public function setIsBoss($isBoss);

    /**
     * Get isBoss
     *
     * @return boolean
     */
    public function getIsBoss();

    /**
     * Set exceptionBoosAssistantRegExp
     *
     * @param string $exceptionBoosAssistantRegExp
     *
     * @return self
     */
    public function setExceptionBoosAssistantRegExp($exceptionBoosAssistantRegExp = null);

    /**
     * Get exceptionBoosAssistantRegExp
     *
     * @return string
     */
    public function getExceptionBoosAssistantRegExp();

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return self
     */
    public function setActive($active);

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive();

    /**
     * Set maxCalls
     *
     * @param integer $maxCalls
     *
     * @return self
     */
    public function setMaxCalls($maxCalls);

    /**
     * Get maxCalls
     *
     * @return integer
     */
    public function getMaxCalls();

    /**
     * Set externalIpCalls
     *
     * @param boolean $externalIpCalls
     *
     * @return self
     */
    public function setExternalIpCalls($externalIpCalls);

    /**
     * Get externalIpCalls
     *
     * @return boolean
     */
    public function getExternalIpCalls();

    /**
     * Set voicemailEnabled
     *
     * @param boolean $voicemailEnabled
     *
     * @return self
     */
    public function setVoicemailEnabled($voicemailEnabled);

    /**
     * Get voicemailEnabled
     *
     * @return boolean
     */
    public function getVoicemailEnabled();

    /**
     * Set voicemailSendMail
     *
     * @param boolean $voicemailSendMail
     *
     * @return self
     */
    public function setVoicemailSendMail($voicemailSendMail);

    /**
     * Get voicemailSendMail
     *
     * @return boolean
     */
    public function getVoicemailSendMail();

    /**
     * Set voicemailAttachSound
     *
     * @param boolean $voicemailAttachSound
     *
     * @return self
     */
    public function setVoicemailAttachSound($voicemailAttachSound);

    /**
     * Get voicemailAttachSound
     *
     * @return boolean
     */
    public function getVoicemailAttachSound();

    /**
     * Set tokenKey
     *
     * @param string $tokenKey
     *
     * @return self
     */
    public function setTokenKey($tokenKey = null);

    /**
     * Get tokenKey
     *
     * @return string
     */
    public function getTokenKey();

    /**
     * Set areaCode
     *
     * @param string $areaCode
     *
     * @return self
     */
    public function setAreaCode($areaCode = null);

    /**
     * Get areaCode
     *
     * @return string
     */
    public function getAreaCode();

    /**
     * Set gsQRCode
     *
     * @param boolean $gsQRCode
     *
     * @return self
     */
    public function setGsQRCode($gsQRCode);

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
     * @param UserInterface $bossAssistant
     *
     * @return self
     */
    public function setBossAssistant(\Ivoz\Provider\Domain\Model\User\UserInterface $bossAssistant = null);

    /**
     * Get bossAssistant
     *
     * @return UserInterface
     */
    public function getBossAssistant();

    /**
     * Set country
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $country
     *
     * @return self
     */
    public function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $country = null);

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
     * Get timezone
     *
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getTimezone();

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
     * @return array
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
     * @return array
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
     * @return array
     */
    public function getCallForwardSettings(\Doctrine\Common\Collections\Criteria $criteria = null);

}

