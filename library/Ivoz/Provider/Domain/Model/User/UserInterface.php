<?php

namespace Ivoz\Provider\Domain\Model\User;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

interface UserInterface extends LoggableEntityInterface
{
    const EXTERNALIPCALLS_0 = '0';
    const EXTERNALIPCALLS_1 = '1';
    const EXTERNALIPCALLS_2 = '2';
    const EXTERNALIPCALLS_3 = '3';


    const REJECTCALLMETHOD_RFC = 'rfc';
    const REJECTCALLMETHOD_486 = '486';
    const REJECTCALLMETHOD_600 = '600';


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
     * @return \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface | null
     */
    public function getEndpoint();

    /**
     * @return string | null
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
     * @return string | null
     */
    public function getOutgoingDdiNumber();

    /**
     * Get User outgoingDdi
     * If no Ddi is assigned, retrieve company's default Ddi
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getOutgoingDdi();

    public function setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi = null);

    /**
     * Get User outgoingDdiRule
     * If no OutgoingDdiRule is assigned, retrieve company's default OutgoingDdiRule
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface|null
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
     * @return string
     */
    public function getFullNameExtension();

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname(): string;

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
    public function getDoNotDisturb(): bool;

    /**
     * Get isBoss
     *
     * @return boolean
     */
    public function getIsBoss(): bool;

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive(): bool;

    /**
     * Get maxCalls
     *
     * @return integer
     */
    public function getMaxCalls(): int;

    /**
     * Get externalIpCalls
     *
     * @return string
     */
    public function getExternalIpCalls(): string;

    /**
     * Get rejectCallMethod
     *
     * @return string
     */
    public function getRejectCallMethod(): string;

    /**
     * Get voicemailEnabled
     *
     * @return boolean
     */
    public function getVoicemailEnabled(): bool;

    /**
     * Get voicemailSendMail
     *
     * @return boolean
     */
    public function getVoicemailSendMail(): bool;

    /**
     * Get voicemailAttachSound
     *
     * @return boolean
     */
    public function getVoicemailAttachSound(): bool;

    /**
     * Get multiContact
     *
     * @return boolean
     */
    public function getMultiContact(): bool;

    /**
     * Get gsQRCode
     *
     * @return boolean
     */
    public function getGsQRCode(): bool;

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Get callAcl
     *
     * @return \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface | null
     */
    public function getCallAcl();

    /**
     * Get bossAssistant
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getBossAssistant();

    /**
     * Get bossAssistantWhiteList
     *
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface | null
     */
    public function getBossAssistantWhiteList();

    /**
     * Get transformationRuleSet
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet();

    /**
     * Set terminal
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal | null
     *
     * @return static
     */
    public function setTerminal(\Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal = null);

    /**
     * Get terminal
     *
     * @return \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface | null
     */
    public function getTerminal();

    /**
     * Set extension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension | null
     *
     * @return static
     */
    public function setExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension = null);

    /**
     * Get extension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getExtension();

    /**
     * Get timezone
     *
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface | null
     */
    public function getTimezone();

    /**
     * Get voicemailLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getVoicemailLocution();

    /**
     * Set location
     *
     * @param \Ivoz\Provider\Domain\Model\Location\LocationInterface $location | null
     *
     * @return static
     */
    public function setLocation(\Ivoz\Provider\Domain\Model\Location\LocationInterface $location = null);

    /**
     * Get location
     *
     * @return \Ivoz\Provider\Domain\Model\Location\LocationInterface | null
     */
    public function getLocation();

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add pickUpRelUser
     *
     * @param \Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface $pickUpRelUser
     *
     * @return static
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
     * @param ArrayCollection $pickUpRelUsers of Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface
     * @return static
     */
    public function replacePickUpRelUsers(ArrayCollection $pickUpRelUsers);

    /**
     * Get pickUpRelUsers
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface[]
     */
    public function getPickUpRelUsers(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add queueMember
     *
     * @param \Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface $queueMember
     *
     * @return static
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
     * @param ArrayCollection $queueMembers of Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface
     * @return static
     */
    public function replaceQueueMembers(ArrayCollection $queueMembers);

    /**
     * Get queueMembers
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface[]
     */
    public function getQueueMembers(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * Add callForwardSetting
     *
     * @param \Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface $callForwardSetting
     *
     * @return static
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
     * @param ArrayCollection $callForwardSettings of Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface
     * @return static
     */
    public function replaceCallForwardSettings(ArrayCollection $callForwardSettings);

    /**
     * Get callForwardSettings
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface[]
     */
    public function getCallForwardSettings(\Doctrine\Common\Collections\Criteria $criteria = null);

    /**
     * @see AdvancedUserInterface::getRoles()
     */
    public function getRoles(): array;

    /**
     * @see AdvancedUserInterface::getUsername()
     */
    public function getUsername(): string;

    /**
     * @see AdvancedUserInterface::getPassword()
     */
    public function getPassword(): string;

    /**
     * @see AdvancedUserInterface::isAccountNonExpired()
     */
    public function isAccountNonExpired(): bool;

    /**
     * @see AdvancedUserInterface::isAccountNonLocked()
     */
    public function isAccountNonLocked(): bool;

    /**
     * @see AdvancedUserInterface::isCredentialsNonExpired()
     */
    public function isCredentialsNonExpired(): bool;

    /**
     * @see AdvancedUserInterface::isEnabled()
     */
    public function isEnabled(): bool;

    /**
     * @see AdvancedUserInterface::getSalt()
     */
    public function getSalt(): string;

    /**
     * @see AdvancedUserInterface::eraseCredentials()
     */
    public function eraseCredentials();
}
