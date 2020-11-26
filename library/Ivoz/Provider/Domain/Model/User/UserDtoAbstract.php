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
     * @var string | null
     */
    private $email;

    /**
     * @var string | null
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
            'voicemailEnabled' => 'voicemailEnabled',
            'voicemailSendMail' => 'voicemailSendMail',
            'voicemailAttachSound' => 'voicemailAttachSound',
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
            'voicemailEnabled' => $this->getVoicemailEnabled(),
            'voicemailSendMail' => $this->getVoicemailSendMail(),
            'voicemailAttachSound' => $this->getVoicemailAttachSound(),
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

    /**
     * @param string $name | null
     *
     * @return static
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $lastname | null
     *
     * @return static
     */
    public function setLastname(?string $lastname = null): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string $email | null
     *
     * @return static
     */
    public function setEmail(?string $email = null): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $pass | null
     *
     * @return static
     */
    public function setPass(?string $pass = null): self
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPass(): ?string
    {
        return $this->pass;
    }

    /**
     * @param bool $doNotDisturb | null
     *
     * @return static
     */
    public function setDoNotDisturb(?bool $doNotDisturb = null): self
    {
        $this->doNotDisturb = $doNotDisturb;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getDoNotDisturb(): ?bool
    {
        return $this->doNotDisturb;
    }

    /**
     * @param bool $isBoss | null
     *
     * @return static
     */
    public function setIsBoss(?bool $isBoss = null): self
    {
        $this->isBoss = $isBoss;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getIsBoss(): ?bool
    {
        return $this->isBoss;
    }

    /**
     * @param bool $active | null
     *
     * @return static
     */
    public function setActive(?bool $active = null): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param int $maxCalls | null
     *
     * @return static
     */
    public function setMaxCalls(?int $maxCalls = null): self
    {
        $this->maxCalls = $maxCalls;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getMaxCalls(): ?int
    {
        return $this->maxCalls;
    }

    /**
     * @param string $externalIpCalls | null
     *
     * @return static
     */
    public function setExternalIpCalls(?string $externalIpCalls = null): self
    {
        $this->externalIpCalls = $externalIpCalls;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getExternalIpCalls(): ?string
    {
        return $this->externalIpCalls;
    }

    /**
     * @param bool $voicemailEnabled | null
     *
     * @return static
     */
    public function setVoicemailEnabled(?bool $voicemailEnabled = null): self
    {
        $this->voicemailEnabled = $voicemailEnabled;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getVoicemailEnabled(): ?bool
    {
        return $this->voicemailEnabled;
    }

    /**
     * @param bool $voicemailSendMail | null
     *
     * @return static
     */
    public function setVoicemailSendMail(?bool $voicemailSendMail = null): self
    {
        $this->voicemailSendMail = $voicemailSendMail;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getVoicemailSendMail(): ?bool
    {
        return $this->voicemailSendMail;
    }

    /**
     * @param bool $voicemailAttachSound | null
     *
     * @return static
     */
    public function setVoicemailAttachSound(?bool $voicemailAttachSound = null): self
    {
        $this->voicemailAttachSound = $voicemailAttachSound;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getVoicemailAttachSound(): ?bool
    {
        return $this->voicemailAttachSound;
    }

    /**
     * @param bool $gsQRCode | null
     *
     * @return static
     */
    public function setGsQRCode(?bool $gsQRCode = null): self
    {
        $this->gsQRCode = $gsQRCode;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getGsQRCode(): ?bool
    {
        return $this->gsQRCode;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param CompanyDto | null
     *
     * @return static
     */
    public function setCompany(?CompanyDto $company = null): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return CompanyDto | null
     */
    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    /**
     * @return static
     */
    public function setCompanyId($id): self
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return mixed | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CallAclDto | null
     *
     * @return static
     */
    public function setCallAcl(?CallAclDto $callAcl = null): self
    {
        $this->callAcl = $callAcl;

        return $this;
    }

    /**
     * @return CallAclDto | null
     */
    public function getCallAcl(): ?CallAclDto
    {
        return $this->callAcl;
    }

    /**
     * @return static
     */
    public function setCallAclId($id): self
    {
        $value = !is_null($id)
            ? new CallAclDto($id)
            : null;

        return $this->setCallAcl($value);
    }

    /**
     * @return mixed | null
     */
    public function getCallAclId()
    {
        if ($dto = $this->getCallAcl()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param UserDto | null
     *
     * @return static
     */
    public function setBossAssistant(?UserDto $bossAssistant = null): self
    {
        $this->bossAssistant = $bossAssistant;

        return $this;
    }

    /**
     * @return UserDto | null
     */
    public function getBossAssistant(): ?UserDto
    {
        return $this->bossAssistant;
    }

    /**
     * @return static
     */
    public function setBossAssistantId($id): self
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setBossAssistant($value);
    }

    /**
     * @return mixed | null
     */
    public function getBossAssistantId()
    {
        if ($dto = $this->getBossAssistant()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param MatchListDto | null
     *
     * @return static
     */
    public function setBossAssistantWhiteList(?MatchListDto $bossAssistantWhiteList = null): self
    {
        $this->bossAssistantWhiteList = $bossAssistantWhiteList;

        return $this;
    }

    /**
     * @return MatchListDto | null
     */
    public function getBossAssistantWhiteList(): ?MatchListDto
    {
        return $this->bossAssistantWhiteList;
    }

    /**
     * @return static
     */
    public function setBossAssistantWhiteListId($id): self
    {
        $value = !is_null($id)
            ? new MatchListDto($id)
            : null;

        return $this->setBossAssistantWhiteList($value);
    }

    /**
     * @return mixed | null
     */
    public function getBossAssistantWhiteListId()
    {
        if ($dto = $this->getBossAssistantWhiteList()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param TransformationRuleSetDto | null
     *
     * @return static
     */
    public function setTransformationRuleSet(?TransformationRuleSetDto $transformationRuleSet = null): self
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * @return TransformationRuleSetDto | null
     */
    public function getTransformationRuleSet(): ?TransformationRuleSetDto
    {
        return $this->transformationRuleSet;
    }

    /**
     * @return static
     */
    public function setTransformationRuleSetId($id): self
    {
        $value = !is_null($id)
            ? new TransformationRuleSetDto($id)
            : null;

        return $this->setTransformationRuleSet($value);
    }

    /**
     * @return mixed | null
     */
    public function getTransformationRuleSetId()
    {
        if ($dto = $this->getTransformationRuleSet()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param LanguageDto | null
     *
     * @return static
     */
    public function setLanguage(?LanguageDto $language = null): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return LanguageDto | null
     */
    public function getLanguage(): ?LanguageDto
    {
        return $this->language;
    }

    /**
     * @return static
     */
    public function setLanguageId($id): self
    {
        $value = !is_null($id)
            ? new LanguageDto($id)
            : null;

        return $this->setLanguage($value);
    }

    /**
     * @return mixed | null
     */
    public function getLanguageId()
    {
        if ($dto = $this->getLanguage()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param TerminalDto | null
     *
     * @return static
     */
    public function setTerminal(?TerminalDto $terminal = null): self
    {
        $this->terminal = $terminal;

        return $this;
    }

    /**
     * @return TerminalDto | null
     */
    public function getTerminal(): ?TerminalDto
    {
        return $this->terminal;
    }

    /**
     * @return static
     */
    public function setTerminalId($id): self
    {
        $value = !is_null($id)
            ? new TerminalDto($id)
            : null;

        return $this->setTerminal($value);
    }

    /**
     * @return mixed | null
     */
    public function getTerminalId()
    {
        if ($dto = $this->getTerminal()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ExtensionDto | null
     *
     * @return static
     */
    public function setExtension(?ExtensionDto $extension = null): self
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * @return ExtensionDto | null
     */
    public function getExtension(): ?ExtensionDto
    {
        return $this->extension;
    }

    /**
     * @return static
     */
    public function setExtensionId($id): self
    {
        $value = !is_null($id)
            ? new ExtensionDto($id)
            : null;

        return $this->setExtension($value);
    }

    /**
     * @return mixed | null
     */
    public function getExtensionId()
    {
        if ($dto = $this->getExtension()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param TimezoneDto | null
     *
     * @return static
     */
    public function setTimezone(?TimezoneDto $timezone = null): self
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * @return TimezoneDto | null
     */
    public function getTimezone(): ?TimezoneDto
    {
        return $this->timezone;
    }

    /**
     * @return static
     */
    public function setTimezoneId($id): self
    {
        $value = !is_null($id)
            ? new TimezoneDto($id)
            : null;

        return $this->setTimezone($value);
    }

    /**
     * @return mixed | null
     */
    public function getTimezoneId()
    {
        if ($dto = $this->getTimezone()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param DdiDto | null
     *
     * @return static
     */
    public function setOutgoingDdi(?DdiDto $outgoingDdi = null): self
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    /**
     * @return DdiDto | null
     */
    public function getOutgoingDdi(): ?DdiDto
    {
        return $this->outgoingDdi;
    }

    /**
     * @return static
     */
    public function setOutgoingDdiId($id): self
    {
        $value = !is_null($id)
            ? new DdiDto($id)
            : null;

        return $this->setOutgoingDdi($value);
    }

    /**
     * @return mixed | null
     */
    public function getOutgoingDdiId()
    {
        if ($dto = $this->getOutgoingDdi()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param OutgoingDdiRuleDto | null
     *
     * @return static
     */
    public function setOutgoingDdiRule(?OutgoingDdiRuleDto $outgoingDdiRule = null): self
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    /**
     * @return OutgoingDdiRuleDto | null
     */
    public function getOutgoingDdiRule(): ?OutgoingDdiRuleDto
    {
        return $this->outgoingDdiRule;
    }

    /**
     * @return static
     */
    public function setOutgoingDdiRuleId($id): self
    {
        $value = !is_null($id)
            ? new OutgoingDdiRuleDto($id)
            : null;

        return $this->setOutgoingDdiRule($value);
    }

    /**
     * @return mixed | null
     */
    public function getOutgoingDdiRuleId()
    {
        if ($dto = $this->getOutgoingDdiRule()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param LocutionDto | null
     *
     * @return static
     */
    public function setVoicemailLocution(?LocutionDto $voicemailLocution = null): self
    {
        $this->voicemailLocution = $voicemailLocution;

        return $this;
    }

    /**
     * @return LocutionDto | null
     */
    public function getVoicemailLocution(): ?LocutionDto
    {
        return $this->voicemailLocution;
    }

    /**
     * @return static
     */
    public function setVoicemailLocutionId($id): self
    {
        $value = !is_null($id)
            ? new LocutionDto($id)
            : null;

        return $this->setVoicemailLocution($value);
    }

    /**
     * @return mixed | null
     */
    public function getVoicemailLocutionId()
    {
        if ($dto = $this->getVoicemailLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param PickUpRelUserDto[] | null
     *
     * @return static
     */
    public function setPickUpRelUsers(?array $pickUpRelUsers = null): self
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
     * @param QueueMemberDto[] | null
     *
     * @return static
     */
    public function setQueueMembers(?array $queueMembers = null): self
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
     * @param CallForwardSettingDto[] | null
     *
     * @return static
     */
    public function setCallForwardSettings(?array $callForwardSettings = null): self
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

}
