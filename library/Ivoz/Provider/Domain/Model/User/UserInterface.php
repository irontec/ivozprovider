<?php

namespace Ivoz\Provider\Domain\Model\User;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;

/**
* UserInterface
*/
interface UserInterface extends LoggableEntityInterface
{
    public const EXTERNALIPCALLS_0 = '0';

    public const EXTERNALIPCALLS_1 = '1';

    public const EXTERNALIPCALLS_2 = '2';

    public const EXTERNALIPCALLS_3 = '3';

    public const REJECTCALLMETHOD_RFC = 'rfc';

    public const REJECTCALLMETHOD_486 = '486';

    public const REJECTCALLMETHOD_600 = '600';

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public function serialize(): string;

    public function unserialize($serialized);

    /**
     * @inheritdoc
     */
    public function setPass(?string $pass = null): static;

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
     * @return string | null
     */
    public function getOutgoingDdiNumber();

    /**
     * Get User outgoingDdi
     * If no Ddi is assigned, retrieve company's default Ddi
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getOutgoingDdi(): ?DdiInterface;

    public function setOutgoingDdi(?DdiInterface $outgoingDdi = null): static;

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
     * @return (\Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface|null)[]
     *
     * @psalm-return array<array-key, \Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface|null>
     */
    public function getPickUpGroups(): array;

    /**
     * @return string comma separated pickup group ids
     */
    public function getPickUpGroupsIds(): string;

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
     * returns company language if empty
     */
    public function getLanguage(): LanguageInterface;

    /**
     * Get User language code.
     * If not set, get the company language code
     * @return string
     */
    public function getLanguageCode();

    public function setEmail(?string $email = null): static;

    /**
     * @return string
     */
    public function getFullNameExtension(): string;

    public static function createDto(string|int|null $id = null): UserDto;

    /**
     * @internal use EntityTools instead
     * @param null|UserInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UserDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UserDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UserDto;

    public function getName(): string;

    public function getLastname(): string;

    public function getEmail(): ?string;

    public function getPass(): ?string;

    public function getDoNotDisturb(): bool;

    public function getIsBoss(): bool;

    public function getActive(): bool;

    public function getMaxCalls(): int;

    public function getExternalIpCalls(): string;

    public function getRejectCallMethod(): string;

    public function getMultiContact(): bool;

    public function getGsQRCode(): bool;

    public function getCompany(): CompanyInterface;

    public function getCallAcl(): ?CallAclInterface;

    public function getBossAssistant(): ?UserInterface;

    public function getBossAssistantWhiteList(): ?MatchListInterface;

    public function getTransformationRuleSet(): ?TransformationRuleSetInterface;

    public function setTerminal(?TerminalInterface $terminal = null): static;

    public function getTerminal(): ?TerminalInterface;

    public function setExtension(?ExtensionInterface $extension = null): static;

    public function getExtension(): ?ExtensionInterface;

    public function getTimezone(): ?TimezoneInterface;

    public function isInitialized(): bool;

    public function setVoicemail(VoicemailInterface $voicemail): static;

    public function getVoicemail(): ?VoicemailInterface;

    public function addPickUpRelUser(PickUpRelUserInterface $pickUpRelUser): UserInterface;

    public function removePickUpRelUser(PickUpRelUserInterface $pickUpRelUser): UserInterface;

    /**
     * @param Collection<array-key, PickUpRelUserInterface> $pickUpRelUsers
     */
    public function replacePickUpRelUsers(Collection $pickUpRelUsers): UserInterface;

    public function getPickUpRelUsers(?Criteria $criteria = null): array;

    public function addQueueMember(QueueMemberInterface $queueMember): UserInterface;

    public function removeQueueMember(QueueMemberInterface $queueMember): UserInterface;

    /**
     * @param Collection<array-key, QueueMemberInterface> $queueMembers
     */
    public function replaceQueueMembers(Collection $queueMembers): UserInterface;

    public function getQueueMembers(?Criteria $criteria = null): array;

    public function addCallForwardSetting(CallForwardSettingInterface $callForwardSetting): UserInterface;

    public function removeCallForwardSetting(CallForwardSettingInterface $callForwardSetting): UserInterface;

    /**
     * @param Collection<array-key, CallForwardSettingInterface> $callForwardSettings
     */
    public function replaceCallForwardSettings(Collection $callForwardSettings): UserInterface;

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
