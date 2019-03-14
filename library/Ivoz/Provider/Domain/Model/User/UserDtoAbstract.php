<?php

namespace Ivoz\Provider\Domain\Model\User;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class UserDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $pass;

    /**
     * @var boolean
     */
    private $doNotDisturb = 0;

    /**
     * @var boolean
     */
    private $isBoss = 0;

    /**
     * @var boolean
     */
    private $active = '0';

    /**
     * @var integer
     */
    private $maxCalls = 0;

    /**
     * @var string
     */
    private $externalIpCalls = '0';

    /**
     * @var boolean
     */
    private $voicemailEnabled = '1';

    /**
     * @var boolean
     */
    private $voicemailSendMail = '0';

    /**
     * @var boolean
     */
    private $voicemailAttachSound = '1';

    /**
     * @var string
     */
    private $tokenKey;

    /**
     * @var boolean
     */
    private $gsQRCode = '0';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\CallAcl\CallAclDto | null
     */
    private $callAcl;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    private $bossAssistant;

    /**
     * @var \Ivoz\Provider\Domain\Model\MatchList\MatchListDto | null
     */
    private $bossAssistantWhiteList;

    /**
     * @var \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto | null
     */
    private $transformationRuleSet;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageDto | null
     */
    private $language;

    /**
     * @var \Ivoz\Provider\Domain\Model\Terminal\TerminalDto | null
     */
    private $terminal;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionDto | null
     */
    private $extension;

    /**
     * @var \Ivoz\Provider\Domain\Model\Timezone\TimezoneDto | null
     */
    private $timezone;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiDto | null
     */
    private $outgoingDdi;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto | null
     */
    private $outgoingDdiRule;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionDto | null
     */
    private $voicemailLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserDto[] | null
     */
    private $pickUpRelUsers = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\QueueMember\QueueMemberDto[] | null
     */
    private $queueMembers = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingDto[] | null
     */
    private $callForwardSettings = null;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
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
            'tokenKey' => 'tokenKey',
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
        return [
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
            'tokenKey' => $this->getTokenKey(),
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
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $lastname
     *
     * @return static
     */
    public function setLastname($lastname = null)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $email
     *
     * @return static
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $pass
     *
     * @return static
     */
    public function setPass($pass = null)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param boolean $doNotDisturb
     *
     * @return static
     */
    public function setDoNotDisturb($doNotDisturb = null)
    {
        $this->doNotDisturb = $doNotDisturb;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getDoNotDisturb()
    {
        return $this->doNotDisturb;
    }

    /**
     * @param boolean $isBoss
     *
     * @return static
     */
    public function setIsBoss($isBoss = null)
    {
        $this->isBoss = $isBoss;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsBoss()
    {
        return $this->isBoss;
    }

    /**
     * @param boolean $active
     *
     * @return static
     */
    public function setActive($active = null)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param integer $maxCalls
     *
     * @return static
     */
    public function setMaxCalls($maxCalls = null)
    {
        $this->maxCalls = $maxCalls;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMaxCalls()
    {
        return $this->maxCalls;
    }

    /**
     * @param string $externalIpCalls
     *
     * @return static
     */
    public function setExternalIpCalls($externalIpCalls = null)
    {
        $this->externalIpCalls = $externalIpCalls;

        return $this;
    }

    /**
     * @return string
     */
    public function getExternalIpCalls()
    {
        return $this->externalIpCalls;
    }

    /**
     * @param boolean $voicemailEnabled
     *
     * @return static
     */
    public function setVoicemailEnabled($voicemailEnabled = null)
    {
        $this->voicemailEnabled = $voicemailEnabled;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getVoicemailEnabled()
    {
        return $this->voicemailEnabled;
    }

    /**
     * @param boolean $voicemailSendMail
     *
     * @return static
     */
    public function setVoicemailSendMail($voicemailSendMail = null)
    {
        $this->voicemailSendMail = $voicemailSendMail;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getVoicemailSendMail()
    {
        return $this->voicemailSendMail;
    }

    /**
     * @param boolean $voicemailAttachSound
     *
     * @return static
     */
    public function setVoicemailAttachSound($voicemailAttachSound = null)
    {
        $this->voicemailAttachSound = $voicemailAttachSound;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getVoicemailAttachSound()
    {
        return $this->voicemailAttachSound;
    }

    /**
     * @param string $tokenKey
     *
     * @return static
     */
    public function setTokenKey($tokenKey = null)
    {
        $this->tokenKey = $tokenKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getTokenKey()
    {
        return $this->tokenKey;
    }

    /**
     * @param boolean $gsQRCode
     *
     * @return static
     */
    public function setGsQRCode($gsQRCode = null)
    {
        $this->gsQRCode = $gsQRCode;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getGsQRCode()
    {
        return $this->gsQRCode;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCompanyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return integer | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\CallAcl\CallAclDto $callAcl
     *
     * @return static
     */
    public function setCallAcl(\Ivoz\Provider\Domain\Model\CallAcl\CallAclDto $callAcl = null)
    {
        $this->callAcl = $callAcl;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\CallAcl\CallAclDto
     */
    public function getCallAcl()
    {
        return $this->callAcl;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCallAclId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\CallAcl\CallAclDto($id)
            : null;

        return $this->setCallAcl($value);
    }

    /**
     * @return integer | null
     */
    public function getCallAclId()
    {
        if ($dto = $this->getCallAcl()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\User\UserDto $bossAssistant
     *
     * @return static
     */
    public function setBossAssistant(UserDto $bossAssistant = null)
    {
        $this->bossAssistant = $bossAssistant;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\UserDto
     */
    public function getBossAssistant()
    {
        return $this->bossAssistant;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setBossAssistantId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\User\UserDto($id)
            : null;

        return $this->setBossAssistant($value);
    }

    /**
     * @return integer | null
     */
    public function getBossAssistantId()
    {
        if ($dto = $this->getBossAssistant()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListDto $bossAssistantWhiteList
     *
     * @return static
     */
    public function setBossAssistantWhiteList(\Ivoz\Provider\Domain\Model\MatchList\MatchListDto $bossAssistantWhiteList = null)
    {
        $this->bossAssistantWhiteList = $bossAssistantWhiteList;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListDto
     */
    public function getBossAssistantWhiteList()
    {
        return $this->bossAssistantWhiteList;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setBossAssistantWhiteListId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\MatchList\MatchListDto($id)
            : null;

        return $this->setBossAssistantWhiteList($value);
    }

    /**
     * @return integer | null
     */
    public function getBossAssistantWhiteListId()
    {
        if ($dto = $this->getBossAssistantWhiteList()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto $transformationRuleSet
     *
     * @return static
     */
    public function setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto $transformationRuleSet = null)
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto
     */
    public function getTransformationRuleSet()
    {
        return $this->transformationRuleSet;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTransformationRuleSetId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto($id)
            : null;

        return $this->setTransformationRuleSet($value);
    }

    /**
     * @return integer | null
     */
    public function getTransformationRuleSetId()
    {
        if ($dto = $this->getTransformationRuleSet()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageDto $language
     *
     * @return static
     */
    public function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageDto $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageDto
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setLanguageId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Language\LanguageDto($id)
            : null;

        return $this->setLanguage($value);
    }

    /**
     * @return integer | null
     */
    public function getLanguageId()
    {
        if ($dto = $this->getLanguage()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalDto $terminal
     *
     * @return static
     */
    public function setTerminal(\Ivoz\Provider\Domain\Model\Terminal\TerminalDto $terminal = null)
    {
        $this->terminal = $terminal;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Terminal\TerminalDto
     */
    public function getTerminal()
    {
        return $this->terminal;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTerminalId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Terminal\TerminalDto($id)
            : null;

        return $this->setTerminal($value);
    }

    /**
     * @return integer | null
     */
    public function getTerminalId()
    {
        if ($dto = $this->getTerminal()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionDto $extension
     *
     * @return static
     */
    public function setExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionDto $extension = null)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionDto
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setExtensionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Extension\ExtensionDto($id)
            : null;

        return $this->setExtension($value);
    }

    /**
     * @return integer | null
     */
    public function getExtensionId()
    {
        if ($dto = $this->getExtension()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Timezone\TimezoneDto $timezone
     *
     * @return static
     */
    public function setTimezone(\Ivoz\Provider\Domain\Model\Timezone\TimezoneDto $timezone = null)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneDto
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTimezoneId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Timezone\TimezoneDto($id)
            : null;

        return $this->setTimezone($value);
    }

    /**
     * @return integer | null
     */
    public function getTimezoneId()
    {
        if ($dto = $this->getTimezone()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiDto $outgoingDdi
     *
     * @return static
     */
    public function setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiDto $outgoingDdi = null)
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiDto
     */
    public function getOutgoingDdi()
    {
        return $this->outgoingDdi;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setOutgoingDdiId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Ddi\DdiDto($id)
            : null;

        return $this->setOutgoingDdi($value);
    }

    /**
     * @return integer | null
     */
    public function getOutgoingDdiId()
    {
        if ($dto = $this->getOutgoingDdi()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto $outgoingDdiRule
     *
     * @return static
     */
    public function setOutgoingDdiRule(\Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto $outgoingDdiRule = null)
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto
     */
    public function getOutgoingDdiRule()
    {
        return $this->outgoingDdiRule;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setOutgoingDdiRuleId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto($id)
            : null;

        return $this->setOutgoingDdiRule($value);
    }

    /**
     * @return integer | null
     */
    public function getOutgoingDdiRuleId()
    {
        if ($dto = $this->getOutgoingDdiRule()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionDto $voicemailLocution
     *
     * @return static
     */
    public function setVoicemailLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionDto $voicemailLocution = null)
    {
        $this->voicemailLocution = $voicemailLocution;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionDto
     */
    public function getVoicemailLocution()
    {
        return $this->voicemailLocution;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setVoicemailLocutionId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Locution\LocutionDto($id)
            : null;

        return $this->setVoicemailLocution($value);
    }

    /**
     * @return integer | null
     */
    public function getVoicemailLocutionId()
    {
        if ($dto = $this->getVoicemailLocution()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param array $pickUpRelUsers
     *
     * @return static
     */
    public function setPickUpRelUsers($pickUpRelUsers = null)
    {
        $this->pickUpRelUsers = $pickUpRelUsers;

        return $this;
    }

    /**
     * @return array
     */
    public function getPickUpRelUsers()
    {
        return $this->pickUpRelUsers;
    }

    /**
     * @param array $queueMembers
     *
     * @return static
     */
    public function setQueueMembers($queueMembers = null)
    {
        $this->queueMembers = $queueMembers;

        return $this;
    }

    /**
     * @return array
     */
    public function getQueueMembers()
    {
        return $this->queueMembers;
    }

    /**
     * @param array $callForwardSettings
     *
     * @return static
     */
    public function setCallForwardSettings($callForwardSettings = null)
    {
        $this->callForwardSettings = $callForwardSettings;

        return $this;
    }

    /**
     * @return array
     */
    public function getCallForwardSettings()
    {
        return $this->callForwardSettings;
    }
}
