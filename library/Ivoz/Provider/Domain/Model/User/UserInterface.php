<?php

namespace Ivoz\Provider\Domain\Model\User;

use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* UserInterface
*/
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
    public function setPass(string $pass = null): UserInterface;

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
    public function getOutgoingDdi(): ?DdiInterface;

    public function setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi = null);

    /**
     * Get User outgoingDdiRule
     * If no OutgoingDdiRule is assigned, retrieve company's default OutgoingDdiRule
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface|null
     */
    public function getOutgoingDdiRule(): ?OutgoingDdiRuleInterface;

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
    public function getLanguage(): ?LanguageInterface;

    /**
     * Get User language code.
     * If not set, get the company language code
     * @return string
     */
    public function getLanguageCode();

    public function setEmail(string $email = null): UserInterface;

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
    public function getEmail(): ?string;

    /**
     * Get pass
     *
     * @return string | null
     */
    public function getPass(): ?string;

    /**
     * Get doNotDisturb
     *
     * @return bool
     */
    public function getDoNotDisturb(): bool;

    /**
     * Get isBoss
     *
     * @return bool
     */
    public function getIsBoss(): bool;

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive(): bool;

    /**
     * Get maxCalls
     *
     * @return int
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
     * @return bool
     */
    public function getVoicemailEnabled(): bool;

    /**
     * Get voicemailSendMail
     *
     * @return bool
     */
    public function getVoicemailSendMail(): bool;

    /**
     * Get voicemailAttachSound
     *
     * @return bool
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
     * @return bool
     */
    public function getGsQRCode(): bool;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * Get callAcl
     *
     * @return CallAclInterface | null
     */
    public function getCallAcl(): ?CallAclInterface;

    /**
     * Get bossAssistant
     *
     * @return UserInterface | null
     */
    public function getBossAssistant(): ?UserInterface;

    /**
     * Get bossAssistantWhiteList
     *
     * @return MatchListInterface | null
     */
    public function getBossAssistantWhiteList(): ?MatchListInterface;

    /**
     * Get transformationRuleSet
     *
     * @return TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet(): ?TransformationRuleSetInterface;

    /**
     * Set terminal
     *
     * @param TerminalInterface | null
     *
     * @return static
     */
    public function setTerminal(?TerminalInterface $terminal = null): UserInterface;

    /**
     * Get terminal
     *
     * @return TerminalInterface | null
     */
    public function getTerminal(): ?TerminalInterface;

    /**
     * Set extension
     *
     * @param ExtensionInterface | null
     *
     * @return static
     */
    public function setExtension(?ExtensionInterface $extension = null): UserInterface;

    /**
     * Get extension
     *
     * @return ExtensionInterface | null
     */
    public function getExtension(): ?ExtensionInterface;

    /**
     * Get timezone
     *
     * @return TimezoneInterface | null
     */
    public function getTimezone(): ?TimezoneInterface;

    /**
     * Get voicemailLocution
     *
     * @return LocutionInterface | null
     */
    public function getVoicemailLocution(): ?LocutionInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add pickUpRelUser
     *
     * @param PickUpRelUserInterface $pickUpRelUser
     *
     * @return static
     */
    public function addPickUpRelUser(PickUpRelUserInterface $pickUpRelUser): UserInterface;

    /**
     * Remove pickUpRelUser
     *
     * @param PickUpRelUserInterface $pickUpRelUser
     *
     * @return static
     */
    public function removePickUpRelUser(PickUpRelUserInterface $pickUpRelUser): UserInterface;

    /**
     * Replace pickUpRelUsers
     *
     * @param ArrayCollection $pickUpRelUsers of PickUpRelUserInterface
     *
     * @return static
     */
    public function replacePickUpRelUsers(ArrayCollection $pickUpRelUsers): UserInterface;

    /**
     * Get pickUpRelUsers
     * @param Criteria | null $criteria
     * @return PickUpRelUserInterface[]
     */
    public function getPickUpRelUsers(?Criteria $criteria = null): array;

    /**
     * Add queueMember
     *
     * @param QueueMemberInterface $queueMember
     *
     * @return static
     */
    public function addQueueMember(QueueMemberInterface $queueMember): UserInterface;

    /**
     * Remove queueMember
     *
     * @param QueueMemberInterface $queueMember
     *
     * @return static
     */
    public function removeQueueMember(QueueMemberInterface $queueMember): UserInterface;

    /**
     * Replace queueMembers
     *
     * @param ArrayCollection $queueMembers of QueueMemberInterface
     *
     * @return static
     */
    public function replaceQueueMembers(ArrayCollection $queueMembers): UserInterface;

    /**
     * Get queueMembers
     * @param Criteria | null $criteria
     * @return QueueMemberInterface[]
     */
    public function getQueueMembers(?Criteria $criteria = null): array;

    /**
     * Add callForwardSetting
     *
     * @param CallForwardSettingInterface $callForwardSetting
     *
     * @return static
     */
    public function addCallForwardSetting(CallForwardSettingInterface $callForwardSetting): UserInterface;

    /**
     * Remove callForwardSetting
     *
     * @param CallForwardSettingInterface $callForwardSetting
     *
     * @return static
     */
    public function removeCallForwardSetting(CallForwardSettingInterface $callForwardSetting): UserInterface;

    /**
     * Replace callForwardSettings
     *
     * @param ArrayCollection $callForwardSettings of CallForwardSettingInterface
     *
     * @return static
     */
    public function replaceCallForwardSettings(ArrayCollection $callForwardSettings): UserInterface;

    /**
     * Get callForwardSettings
     * @param Criteria | null $criteria
     * @return CallForwardSettingInterface[]
     */
    public function getCallForwardSettings(?Criteria $criteria = null): array;

    /**
     * @see UserInterface::getRoles()
     */
    public function getRoles(): array;

    /**
     * @see UserInterface::getUsername()
     */
    public function getUsername(): string;

    /**
     * @see UserInterface::getPassword()
     */
    public function getPassword(): string;

    public function isEnabled(): bool;

    /**
     * @see UserInterface::getSalt()
     */
    public function getSalt(): string;

    /**
     * @see UserInterface::eraseCredentials()
     */
    public function eraseCredentials();

}
