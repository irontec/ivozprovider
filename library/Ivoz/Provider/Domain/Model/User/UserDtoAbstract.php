<?php

namespace Ivoz\Provider\Domain\Model\User;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
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
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserDto;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberDto;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingDto;

/**
* UserDtoAbstract
* @codeCoverageIgnore
*/
abstract class UserDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string|null
     */
    private $email;

    /**
     * @var string|null
     */
    private $pass;

    /**
     * @var bool
     */
    private $doNotDisturb = false;

    /**
     * @var bool
     */
    private $isBoss = false;

    /**
     * @var bool
     */
    private $active = false;

    /**
     * @var int
     */
    private $maxCalls = 0;

    /**
     * @var string
     */
    private $externalIpCalls = '0';

    /**
     * @var string
     */
    private $rejectCallMethod = 'rfc';

    /**
     * @var bool
     */
    private $voicemailEnabled = true;

    /**
     * @var bool
     */
    private $voicemailSendMail = false;

    /**
     * @var bool
     */
    private $voicemailAttachSound = true;

    /**
     * @var bool
     */
    private $multiContact = true;

    /**
     * @var bool
     */
    private $gsQRCode = false;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var CallAclDto | null
     */
    private $callAcl;

    /**
     * @var UserDto | null
     */
    private $bossAssistant;

    /**
     * @var MatchListDto | null
     */
    private $bossAssistantWhiteList;

    /**
     * @var TransformationRuleSetDto | null
     */
    private $transformationRuleSet;

    /**
     * @var LanguageDto | null
     */
    private $language;

    /**
     * @var TerminalDto | null
     */
    private $terminal;

    /**
     * @var ExtensionDto | null
     */
    private $extension;

    /**
     * @var TimezoneDto | null
     */
    private $timezone;

    /**
     * @var DdiDto | null
     */
    private $outgoingDdi;

    /**
     * @var OutgoingDdiRuleDto | null
     */
    private $outgoingDdiRule;

    /**
     * @var LocutionDto | null
     */
    private $voicemailLocution;

    /**
     * @var PickUpRelUserDto[] | null
     */
    private $pickUpRelUsers;

    /**
     * @var QueueMemberDto[] | null
     */
    private $queueMembers;

    /**
     * @var CallForwardSettingDto[] | null
     */
    private $callForwardSettings;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
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
            'voicemailEnabled' => 'voicemailEnabled',
            'voicemailSendMail' => 'voicemailSendMail',
            'voicemailAttachSound' => 'voicemailAttachSound',
            'multiContact' => 'multiContact',
            'gsQRCode' => 'gsQRCode',
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
            'voicemailLocutionId' => 'voicemailLocution'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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
            'voicemailEnabled' => $this->getVoicemailEnabled(),
            'voicemailSendMail' => $this->getVoicemailSendMail(),
            'voicemailAttachSound' => $this->getVoicemailAttachSound(),
            'multiContact' => $this->getMultiContact(),
            'gsQRCode' => $this->getGsQRCode(),
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
            'voicemailLocution' => $this->getVoicemailLocution(),
            'pickUpRelUsers' => $this->getPickUpRelUsers(),
            'queueMembers' => $this->getQueueMembers(),
            'callForwardSettings' => $this->getCallForwardSettings()
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

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setLastname(?string $lastname): static
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

    public function setDoNotDisturb(?bool $doNotDisturb): static
    {
        $this->doNotDisturb = $doNotDisturb;

        return $this;
    }

    public function getDoNotDisturb(): ?bool
    {
        return $this->doNotDisturb;
    }

    public function setIsBoss(?bool $isBoss): static
    {
        $this->isBoss = $isBoss;

        return $this;
    }

    public function getIsBoss(): ?bool
    {
        return $this->isBoss;
    }

    public function setActive(?bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setMaxCalls(?int $maxCalls): static
    {
        $this->maxCalls = $maxCalls;

        return $this;
    }

    public function getMaxCalls(): ?int
    {
        return $this->maxCalls;
    }

    public function setExternalIpCalls(?string $externalIpCalls): static
    {
        $this->externalIpCalls = $externalIpCalls;

        return $this;
    }

    public function getExternalIpCalls(): ?string
    {
        return $this->externalIpCalls;
    }

    public function setRejectCallMethod(?string $rejectCallMethod): static
    {
        $this->rejectCallMethod = $rejectCallMethod;

        return $this;
    }

    public function getRejectCallMethod(): ?string
    {
        return $this->rejectCallMethod;
    }

    public function setVoicemailEnabled(?bool $voicemailEnabled): static
    {
        $this->voicemailEnabled = $voicemailEnabled;

        return $this;
    }

    public function getVoicemailEnabled(): ?bool
    {
        return $this->voicemailEnabled;
    }

    public function setVoicemailSendMail(?bool $voicemailSendMail): static
    {
        $this->voicemailSendMail = $voicemailSendMail;

        return $this;
    }

    public function getVoicemailSendMail(): ?bool
    {
        return $this->voicemailSendMail;
    }

    public function setVoicemailAttachSound(?bool $voicemailAttachSound): static
    {
        $this->voicemailAttachSound = $voicemailAttachSound;

        return $this;
    }

    public function getVoicemailAttachSound(): ?bool
    {
        return $this->voicemailAttachSound;
    }

    public function setMultiContact(?bool $multiContact): static
    {
        $this->multiContact = $multiContact;

        return $this;
    }

    public function getMultiContact(): ?bool
    {
        return $this->multiContact;
    }

    public function setGsQRCode(?bool $gsQRCode): static
    {
        $this->gsQRCode = $gsQRCode;

        return $this;
    }

    public function getGsQRCode(): ?bool
    {
        return $this->gsQRCode;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
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

    public function setCompanyId($id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId()
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

    public function setCallAclId($id): static
    {
        $value = !is_null($id)
            ? new CallAclDto($id)
            : null;

        return $this->setCallAcl($value);
    }

    public function getCallAclId()
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

    public function setBossAssistantId($id): static
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setBossAssistant($value);
    }

    public function getBossAssistantId()
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

    public function setBossAssistantWhiteListId($id): static
    {
        $value = !is_null($id)
            ? new MatchListDto($id)
            : null;

        return $this->setBossAssistantWhiteList($value);
    }

    public function getBossAssistantWhiteListId()
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

    public function setTransformationRuleSetId($id): static
    {
        $value = !is_null($id)
            ? new TransformationRuleSetDto($id)
            : null;

        return $this->setTransformationRuleSet($value);
    }

    public function getTransformationRuleSetId()
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

    public function setLanguageId($id): static
    {
        $value = !is_null($id)
            ? new LanguageDto($id)
            : null;

        return $this->setLanguage($value);
    }

    public function getLanguageId()
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

    public function setTerminalId($id): static
    {
        $value = !is_null($id)
            ? new TerminalDto($id)
            : null;

        return $this->setTerminal($value);
    }

    public function getTerminalId()
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

    public function setExtensionId($id): static
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setExtension($value);
    }

    public function getExtensionId()
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

    public function setTimezoneId($id): static
    {
        $value = !is_null($id)
            ? new TimezoneDto($id)
            : null;

        return $this->setTimezone($value);
    }

    public function getTimezoneId()
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

    public function setOutgoingDdiId($id): static
    {
        $value = !is_null($id)
            ? new DdiDto($id)
            : null;

        return $this->setOutgoingDdi($value);
    }

    public function getOutgoingDdiId()
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

    public function setOutgoingDdiRuleId($id): static
    {
        $value = !is_null($id)
            ? new OutgoingDdiRuleDto($id)
            : null;

        return $this->setOutgoingDdiRule($value);
    }

    public function getOutgoingDdiRuleId()
    {
        if ($dto = $this->getOutgoingDdiRule()) {
            return $dto->getId();
        }

        return null;
    }

    public function setVoicemailLocution(?LocutionDto $voicemailLocution): static
    {
        $this->voicemailLocution = $voicemailLocution;

        return $this;
    }

    public function getVoicemailLocution(): ?LocutionDto
    {
        return $this->voicemailLocution;
    }

    public function setVoicemailLocutionId($id): static
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setVoicemailLocution($value);
    }

    public function getVoicemailLocutionId()
    {
        if ($dto = $this->getVoicemailLocution()) {
            return $dto->getId();
        }

        return null;
    }

    public function setPickUpRelUsers(?array $pickUpRelUsers): static
    {
        $this->pickUpRelUsers = $pickUpRelUsers;

        return $this;
    }

    public function getPickUpRelUsers(): ?array
    {
        return $this->pickUpRelUsers;
    }

    public function setQueueMembers(?array $queueMembers): static
    {
        $this->queueMembers = $queueMembers;

        return $this;
    }

    public function getQueueMembers(): ?array
    {
        return $this->queueMembers;
    }

    public function setCallForwardSettings(?array $callForwardSettings): static
    {
        $this->callForwardSettings = $callForwardSettings;

        return $this;
    }

    public function getCallForwardSettings(): ?array
    {
        return $this->callForwardSettings;
    }
}
