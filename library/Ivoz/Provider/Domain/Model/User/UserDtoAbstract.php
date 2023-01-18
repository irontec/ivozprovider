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
    private $doNotDisturb = false;

    /**
     * @var boolean
     */
    private $isBoss = false;

    /**
     * @var boolean
     */
    private $active = false;

    /**
     * @var integer
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
     * @var boolean
     */
    private $voicemailEnabled = true;

    /**
     * @var boolean
     */
    private $voicemailSendMail = false;

    /**
     * @var boolean
     */
    private $voicemailAttachSound = true;

    /**
     * @var boolean
     */
    private $multiContact = true;

    /**
     * @var boolean
     */
    private $gsQRCode = false;

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
     * @var \Ivoz\Provider\Domain\Model\Location\LocationDto | null
     */
    private $location;

    /**
     * @var \Ivoz\Provider\Domain\Model\Contact\ContactDto | null
     */
    private $contact;

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
            'voicemailLocutionId' => 'voicemailLocution',
            'locationId' => 'location',
            'contactId' => 'contact'
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
            'location' => $this->getLocation(),
            'contact' => $this->getContact(),
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
     * @return string | null
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
     * @return string | null
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
     * @return string | null
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
     * @return string | null
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
     * @return boolean | null
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
     * @return boolean | null
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
     * @return boolean | null
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
     * @return integer | null
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
     * @return string | null
     */
    public function getExternalIpCalls()
    {
        return $this->externalIpCalls;
    }

    /**
     * @param string $rejectCallMethod
     *
     * @return static
     */
    public function setRejectCallMethod($rejectCallMethod = null)
    {
        $this->rejectCallMethod = $rejectCallMethod;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRejectCallMethod()
    {
        return $this->rejectCallMethod;
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
     * @return boolean | null
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
     * @return boolean | null
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
     * @return boolean | null
     */
    public function getVoicemailAttachSound()
    {
        return $this->voicemailAttachSound;
    }

    /**
     * @param boolean $multiContact
     *
     * @return static
     */
    public function setMultiContact($multiContact = null)
    {
        $this->multiContact = $multiContact;

        return $this;
    }

    /**
     * @return boolean | null
     */
    public function getMultiContact()
    {
        return $this->multiContact;
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
     * @return boolean | null
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
     * @return integer | null
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
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed | null $id
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
     * @return \Ivoz\Provider\Domain\Model\CallAcl\CallAclDto | null
     */
    public function getCallAcl()
    {
        return $this->callAcl;
    }

    /**
     * @param mixed | null $id
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
     * @return \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    public function getBossAssistant()
    {
        return $this->bossAssistant;
    }

    /**
     * @param mixed | null $id
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
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListDto | null
     */
    public function getBossAssistantWhiteList()
    {
        return $this->bossAssistantWhiteList;
    }

    /**
     * @param mixed | null $id
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
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto | null
     */
    public function getTransformationRuleSet()
    {
        return $this->transformationRuleSet;
    }

    /**
     * @param mixed | null $id
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
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageDto | null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed | null $id
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
     * @return \Ivoz\Provider\Domain\Model\Terminal\TerminalDto | null
     */
    public function getTerminal()
    {
        return $this->terminal;
    }

    /**
     * @param mixed | null $id
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
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionDto | null
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param mixed | null $id
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
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneDto | null
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param mixed | null $id
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
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiDto | null
     */
    public function getOutgoingDdi()
    {
        return $this->outgoingDdi;
    }

    /**
     * @param mixed | null $id
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
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto | null
     */
    public function getOutgoingDdiRule()
    {
        return $this->outgoingDdiRule;
    }

    /**
     * @param mixed | null $id
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
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionDto | null
     */
    public function getVoicemailLocution()
    {
        return $this->voicemailLocution;
    }

    /**
     * @param mixed | null $id
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
     * @param \Ivoz\Provider\Domain\Model\Location\LocationDto $location
     *
     * @return static
     */
    public function setLocation(\Ivoz\Provider\Domain\Model\Location\LocationDto $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Location\LocationDto | null
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setLocationId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Location\LocationDto($id)
            : null;

        return $this->setLocation($value);
    }

    /**
     * @return mixed | null
     */
    public function getLocationId()
    {
        if ($dto = $this->getLocation()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Contact\ContactDto $contact
     *
     * @return static
     */
    public function setContact(\Ivoz\Provider\Domain\Model\Contact\ContactDto $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Contact\ContactDto | null
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setContactId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Contact\ContactDto($id)
            : null;

        return $this->setContact($value);
    }

    /**
     * @return mixed | null
     */
    public function getContactId()
    {
        if ($dto = $this->getContact()) {
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
     * @return array | null
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
     * @return array | null
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
     * @return array | null
     */
    public function getCallForwardSettings()
    {
        return $this->callForwardSettings;
    }
}
