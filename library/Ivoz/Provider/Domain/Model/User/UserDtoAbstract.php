<?php

namespace Ivoz\Provider\Domain\Model\User;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\CallAcl\CallAclDto;
use Ivoz\Provider\Domain\Model\MatchList\MatchListDto;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto;
use Ivoz\Provider\Domain\Model\Language\LanguageDto;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto;
use Ivoz\Provider\Domain\Model\Location\LocationDto;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailDto;
use Ivoz\Provider\Domain\Model\VoicemailRelUser\VoicemailRelUserDto;
use Ivoz\Provider\Domain\Model\Contact\ContactDto;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserDto;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberDto;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingDto;
use Ivoz\Provider\Domain\Model\FaxesRelUser\FaxesRelUserDto;
use Ivoz\Provider\Domain\Model\Recording\RecordingDto;

/**
* UserDtoAbstract
* @codeCoverageIgnore
*/
abstract class UserDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $lastname = null;

    /**
     * @var string|null
     */
    private $email = null;

    /**
     * @var string|null
     */
    private $pass = null;

    /**
     * @var bool|null
     */
    private $doNotDisturb = false;

    /**
     * @var bool|null
     */
    private $isBoss = false;

    /**
     * @var bool|null
     */
    private $active = false;

    /**
     * @var int|null
     */
    private $maxCalls = 0;

    /**
     * @var string|null
     */
    private $externalIpCalls = '0';

    /**
     * @var string|null
     */
    private $rejectCallMethod = 'rfc';

    /**
     * @var bool|null
     */
    private $multiContact = true;

    /**
     * @var bool|null
     */
    private $gsQRCode = false;

    /**
     * @var bool|null
     */
    private $useDefaultLocation = true;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    /**
     * @var CallAclDto | null
     */
    private $callAcl = null;

    /**
     * @var UserDto | null
     */
    private $bossAssistant = null;

    /**
     * @var MatchListDto | null
     */
    private $bossAssistantWhiteList = null;

    /**
     * @var TransformationRuleSetDto | null
     */
    private $transformationRuleSet = null;

    /**
     * @var LanguageDto | null
     */
    private $language = null;

    /**
     * @var TerminalDto | null
     */
    private $terminal = null;

    /**
     * @var ExtensionDto | null
     */
    private $extension = null;

    /**
     * @var TimezoneDto | null
     */
    private $timezone = null;

    /**
     * @var DdiDto | null
     */
    private $outgoingDdi = null;

    /**
     * @var OutgoingDdiRuleDto | null
     */
    private $outgoingDdiRule = null;

    /**
     * @var LocationDto | null
     */
    private $location = null;

    /**
     * @var VoicemailDto | null
     */
    private $voicemail = null;

    /**
     * @var VoicemailRelUserDto[] | null
     */
    private $voicemailRelUsers = null;

    /**
     * @var ContactDto | null
     */
    private $contact = null;

    /**
     * @var PickUpRelUserDto[] | null
     */
    private $pickUpRelUsers = null;

    /**
     * @var QueueMemberDto[] | null
     */
    private $queueMembers = null;

    /**
     * @var CallForwardSettingDto[] | null
     */
    private $callForwardSettings = null;

    /**
     * @var FaxesRelUserDto[] | null
     */
    private $faxesRelUsers = null;

    /**
     * @var RecordingDto[] | null
     */
    private $recordings = null;

    public function __construct(?int $id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'name' => 'name',
            'lastname' => 'lastname',
            'email' => 'email',
            'pass' => 'pass',
            'doNotDisturb' => 'doNotDisturb',
            'isBoss' => 'isBoss',
            'active' => 'active',
            'maxCalls' => 'maxCalls',
            'externalIpCalls' => 'externalIpCalls',
            'rejectCallMethod' => 'rejectCallMethod',
            'multiContact' => 'multiContact',
            'gsQRCode' => 'gsQRCode',
            'useDefaultLocation' => 'useDefaultLocation',
            'id' => 'id',
            'companyId' => 'company',
            'callAclId' => 'callAcl',
            'bossAssistantId' => 'bossAssistant',
            'bossAssistantWhiteListId' => 'bossAssistantWhiteList',
            'transformationRuleSetId' => 'transformationRuleSet',
            'languageId' => 'language',
            'terminalId' => 'terminal',
            'extensionId' => 'extension',
            'timezoneId' => 'timezone',
            'outgoingDdiId' => 'outgoingDdi',
            'outgoingDdiRuleId' => 'outgoingDdiRule',
            'locationId' => 'location',
            'voicemailId' => 'voicemail',
            'contactId' => 'contact'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'name' => $this->getName(),
            'lastname' => $this->getLastname(),
            'email' => $this->getEmail(),
            'pass' => $this->getPass(),
            'doNotDisturb' => $this->getDoNotDisturb(),
            'isBoss' => $this->getIsBoss(),
            'active' => $this->getActive(),
            'maxCalls' => $this->getMaxCalls(),
            'externalIpCalls' => $this->getExternalIpCalls(),
            'rejectCallMethod' => $this->getRejectCallMethod(),
            'multiContact' => $this->getMultiContact(),
            'gsQRCode' => $this->getGsQRCode(),
            'useDefaultLocation' => $this->getUseDefaultLocation(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'callAcl' => $this->getCallAcl(),
            'bossAssistant' => $this->getBossAssistant(),
            'bossAssistantWhiteList' => $this->getBossAssistantWhiteList(),
            'transformationRuleSet' => $this->getTransformationRuleSet(),
            'language' => $this->getLanguage(),
            'terminal' => $this->getTerminal(),
            'extension' => $this->getExtension(),
            'timezone' => $this->getTimezone(),
            'outgoingDdi' => $this->getOutgoingDdi(),
            'outgoingDdiRule' => $this->getOutgoingDdiRule(),
            'location' => $this->getLocation(),
            'voicemail' => $this->getVoicemail(),
            'voicemailRelUsers' => $this->getVoicemailRelUsers(),
            'contact' => $this->getContact(),
            'pickUpRelUsers' => $this->getPickUpRelUsers(),
            'queueMembers' => $this->getQueueMembers(),
            'callForwardSettings' => $this->getCallForwardSettings(),
            'faxesRelUsers' => $this->getFaxesRelUsers(),
            'recordings' => $this->getRecordings()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setPass(?string $pass): static
    {
        $this->pass = $pass;

        return $this;
    }

    public function getPass(): ?string
    {
        return $this->pass;
    }

    public function setDoNotDisturb(bool $doNotDisturb): static
    {
        $this->doNotDisturb = $doNotDisturb;

        return $this;
    }

    public function getDoNotDisturb(): ?bool
    {
        return $this->doNotDisturb;
    }

    public function setIsBoss(bool $isBoss): static
    {
        $this->isBoss = $isBoss;

        return $this;
    }

    public function getIsBoss(): ?bool
    {
        return $this->isBoss;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setMaxCalls(int $maxCalls): static
    {
        $this->maxCalls = $maxCalls;

        return $this;
    }

    public function getMaxCalls(): ?int
    {
        return $this->maxCalls;
    }

    public function setExternalIpCalls(string $externalIpCalls): static
    {
        $this->externalIpCalls = $externalIpCalls;

        return $this;
    }

    public function getExternalIpCalls(): ?string
    {
        return $this->externalIpCalls;
    }

    public function setRejectCallMethod(string $rejectCallMethod): static
    {
        $this->rejectCallMethod = $rejectCallMethod;

        return $this;
    }

    public function getRejectCallMethod(): ?string
    {
        return $this->rejectCallMethod;
    }

    public function setMultiContact(bool $multiContact): static
    {
        $this->multiContact = $multiContact;

        return $this;
    }

    public function getMultiContact(): ?bool
    {
        return $this->multiContact;
    }

    public function setGsQRCode(bool $gsQRCode): static
    {
        $this->gsQRCode = $gsQRCode;

        return $this;
    }

    public function getGsQRCode(): ?bool
    {
        return $this->gsQRCode;
    }

    public function setUseDefaultLocation(bool $useDefaultLocation): static
    {
        $this->useDefaultLocation = $useDefaultLocation;

        return $this;
    }

    public function getUseDefaultLocation(): ?bool
    {
        return $this->useDefaultLocation;
    }

    /**
     * @param int|null $id
     */
    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId(?int $id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId(): ?int
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCallAcl(?CallAclDto $callAcl): static
    {
        $this->callAcl = $callAcl;

        return $this;
    }

    public function getCallAcl(): ?CallAclDto
    {
        return $this->callAcl;
    }

    public function setCallAclId(?int $id): static
    {
        $value = !is_null($id)
            ? new CallAclDto($id)
            : null;

        return $this->setCallAcl($value);
    }

    public function getCallAclId(): ?int
    {
        if ($dto = $this->getCallAcl()) {
            return $dto->getId();
        }

        return null;
    }

    public function setBossAssistant(?UserDto $bossAssistant): static
    {
        $this->bossAssistant = $bossAssistant;

        return $this;
    }

    public function getBossAssistant(): ?UserDto
    {
        return $this->bossAssistant;
    }

    public function setBossAssistantId(?int $id): static
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setBossAssistant($value);
    }

    public function getBossAssistantId(): ?int
    {
        if ($dto = $this->getBossAssistant()) {
            return $dto->getId();
        }

        return null;
    }

    public function setBossAssistantWhiteList(?MatchListDto $bossAssistantWhiteList): static
    {
        $this->bossAssistantWhiteList = $bossAssistantWhiteList;

        return $this;
    }

    public function getBossAssistantWhiteList(): ?MatchListDto
    {
        return $this->bossAssistantWhiteList;
    }

    public function setBossAssistantWhiteListId(?int $id): static
    {
        $value = !is_null($id)
            ? new MatchListDto($id)
            : null;

        return $this->setBossAssistantWhiteList($value);
    }

    public function getBossAssistantWhiteListId(): ?int
    {
        if ($dto = $this->getBossAssistantWhiteList()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTransformationRuleSet(?TransformationRuleSetDto $transformationRuleSet): static
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    public function getTransformationRuleSet(): ?TransformationRuleSetDto
    {
        return $this->transformationRuleSet;
    }

    public function setTransformationRuleSetId(?int $id): static
    {
        $value = !is_null($id)
            ? new TransformationRuleSetDto($id)
            : null;

        return $this->setTransformationRuleSet($value);
    }

    public function getTransformationRuleSetId(): ?int
    {
        if ($dto = $this->getTransformationRuleSet()) {
            return $dto->getId();
        }

        return null;
    }

    public function setLanguage(?LanguageDto $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getLanguage(): ?LanguageDto
    {
        return $this->language;
    }

    public function setLanguageId(?int $id): static
    {
        $value = !is_null($id)
            ? new LanguageDto($id)
            : null;

        return $this->setLanguage($value);
    }

    public function getLanguageId(): ?int
    {
        if ($dto = $this->getLanguage()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTerminal(?TerminalDto $terminal): static
    {
        $this->terminal = $terminal;

        return $this;
    }

    public function getTerminal(): ?TerminalDto
    {
        return $this->terminal;
    }

    public function setTerminalId(?int $id): static
    {
        $value = !is_null($id)
            ? new TerminalDto($id)
            : null;

        return $this->setTerminal($value);
    }

    public function getTerminalId(): ?int
    {
        if ($dto = $this->getTerminal()) {
            return $dto->getId();
        }

        return null;
    }

    public function setExtension(?ExtensionDto $extension): static
    {
        $this->extension = $extension;

        return $this;
    }

    public function getExtension(): ?ExtensionDto
    {
        return $this->extension;
    }

    public function setExtensionId(?int $id): static
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setExtension($value);
    }

    public function getExtensionId(): ?int
    {
        if ($dto = $this->getExtension()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTimezone(?TimezoneDto $timezone): static
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function getTimezone(): ?TimezoneDto
    {
        return $this->timezone;
    }

    public function setTimezoneId(?int $id): static
    {
        $value = !is_null($id)
            ? new TimezoneDto($id)
            : null;

        return $this->setTimezone($value);
    }

    public function getTimezoneId(): ?int
    {
        if ($dto = $this->getTimezone()) {
            return $dto->getId();
        }

        return null;
    }

    public function setOutgoingDdi(?DdiDto $outgoingDdi): static
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    public function getOutgoingDdi(): ?DdiDto
    {
        return $this->outgoingDdi;
    }

    public function setOutgoingDdiId(?int $id): static
    {
        $value = !is_null($id)
            ? new DdiDto($id)
            : null;

        return $this->setOutgoingDdi($value);
    }

    public function getOutgoingDdiId(): ?int
    {
        if ($dto = $this->getOutgoingDdi()) {
            return $dto->getId();
        }

        return null;
    }

    public function setOutgoingDdiRule(?OutgoingDdiRuleDto $outgoingDdiRule): static
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    public function getOutgoingDdiRule(): ?OutgoingDdiRuleDto
    {
        return $this->outgoingDdiRule;
    }

    public function setOutgoingDdiRuleId(?int $id): static
    {
        $value = !is_null($id)
            ? new OutgoingDdiRuleDto($id)
            : null;

        return $this->setOutgoingDdiRule($value);
    }

    public function getOutgoingDdiRuleId(): ?int
    {
        if ($dto = $this->getOutgoingDdiRule()) {
            return $dto->getId();
        }

        return null;
    }

    public function setLocation(?LocationDto $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getLocation(): ?LocationDto
    {
        return $this->location;
    }

    public function setLocationId(?int $id): static
    {
        $value = !is_null($id)
            ? new LocationDto($id)
            : null;

        return $this->setLocation($value);
    }

    public function getLocationId(): ?int
    {
        if ($dto = $this->getLocation()) {
            return $dto->getId();
        }

        return null;
    }

    public function setVoicemail(?VoicemailDto $voicemail): static
    {
        $this->voicemail = $voicemail;

        return $this;
    }

    public function getVoicemail(): ?VoicemailDto
    {
        return $this->voicemail;
    }

    public function setVoicemailId(?int $id): static
    {
        $value = !is_null($id)
            ? new VoicemailDto($id)
            : null;

        return $this->setVoicemail($value);
    }

    public function getVoicemailId(): ?int
    {
        if ($dto = $this->getVoicemail()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param VoicemailRelUserDto[] | null $voicemailRelUsers
     */
    public function setVoicemailRelUsers(?array $voicemailRelUsers): static
    {
        $this->voicemailRelUsers = $voicemailRelUsers;

        return $this;
    }

    /**
    * @return VoicemailRelUserDto[] | null
    */
    public function getVoicemailRelUsers(): ?array
    {
        return $this->voicemailRelUsers;
    }

    public function setContact(?ContactDto $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    public function getContact(): ?ContactDto
    {
        return $this->contact;
    }

    public function setContactId(?int $id): static
    {
        $value = !is_null($id)
            ? new ContactDto($id)
            : null;

        return $this->setContact($value);
    }

    public function getContactId(): ?int
    {
        if ($dto = $this->getContact()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param PickUpRelUserDto[] | null $pickUpRelUsers
     */
    public function setPickUpRelUsers(?array $pickUpRelUsers): static
    {
        $this->pickUpRelUsers = $pickUpRelUsers;

        return $this;
    }

    /**
    * @return PickUpRelUserDto[] | null
    */
    public function getPickUpRelUsers(): ?array
    {
        return $this->pickUpRelUsers;
    }

    /**
     * @param QueueMemberDto[] | null $queueMembers
     */
    public function setQueueMembers(?array $queueMembers): static
    {
        $this->queueMembers = $queueMembers;

        return $this;
    }

    /**
    * @return QueueMemberDto[] | null
    */
    public function getQueueMembers(): ?array
    {
        return $this->queueMembers;
    }

    /**
     * @param CallForwardSettingDto[] | null $callForwardSettings
     */
    public function setCallForwardSettings(?array $callForwardSettings): static
    {
        $this->callForwardSettings = $callForwardSettings;

        return $this;
    }

    /**
    * @return CallForwardSettingDto[] | null
    */
    public function getCallForwardSettings(): ?array
    {
        return $this->callForwardSettings;
    }

    /**
     * @param FaxesRelUserDto[] | null $faxesRelUsers
     */
    public function setFaxesRelUsers(?array $faxesRelUsers): static
    {
        $this->faxesRelUsers = $faxesRelUsers;

        return $this;
    }

    /**
    * @return FaxesRelUserDto[] | null
    */
    public function getFaxesRelUsers(): ?array
    {
        return $this->faxesRelUsers;
    }

    /**
     * @param RecordingDto[] | null $recordings
     */
    public function setRecordings(?array $recordings): static
    {
        $this->recordings = $recordings;

        return $this;
    }

    /**
    * @return RecordingDto[] | null
    */
    public function getRecordings(): ?array
    {
        return $this->recordings;
    }
}
