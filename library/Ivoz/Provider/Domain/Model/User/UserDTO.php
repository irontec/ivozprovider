<?php

namespace Ivoz\Provider\Domain\Model\User;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class UserDTO implements DataTransferObjectInterface
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
    private $doNotDisturb = '0';

    /**
     * @var boolean
     */
    private $isBoss = '0';

    /**
     * @var boolean
     */
    private $active = '0';

    /**
     * @var integer
     */
    private $maxCalls = '0';

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
     * @var mixed
     */
    private $companyId;

    /**
     * @var mixed
     */
    private $callAclId;

    /**
     * @var mixed
     */
    private $bossAssistantId;

    /**
     * @var mixed
     */
    private $bossAssistantWhiteListId;

    /**
     * @var mixed
     */
    private $transformationRuleSetId;

    /**
     * @var mixed
     */
    private $languageId;

    /**
     * @var mixed
     */
    private $terminalId;

    /**
     * @var mixed
     */
    private $extensionId;

    /**
     * @var mixed
     */
    private $timezoneId;

    /**
     * @var mixed
     */
    private $outgoingDdiId;

    /**
     * @var mixed
     */
    private $outgoingDdiRuleId;

    /**
     * @var mixed
     */
    private $voicemailLocutionId;

    /**
     * @var mixed
     */
    private $company;

    /**
     * @var mixed
     */
    private $callAcl;

    /**
     * @var mixed
     */
    private $bossAssistant;

    /**
     * @var mixed
     */
    private $bossAssistantWhiteList;

    /**
     * @var mixed
     */
    private $transformationRuleSet;

    /**
     * @var mixed
     */
    private $language;

    /**
     * @var mixed
     */
    private $terminal;

    /**
     * @var mixed
     */
    private $extension;

    /**
     * @var mixed
     */
    private $timezone;

    /**
     * @var mixed
     */
    private $outgoingDdi;

    /**
     * @var mixed
     */
    private $outgoingDdiRule;

    /**
     * @var mixed
     */
    private $voicemailLocution;

    /**
     * @var array|null
     */
    private $pickUpRelUsers = null;

    /**
     * @var array|null
     */
    private $queueMembers = null;

    /**
     * @var array|null
     */
    private $callForwardSettings = null;

    /**
     * @return array
     */
    public function __toArray()
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
            'companyId' => $this->getCompanyId(),
            'callAclId' => $this->getCallAclId(),
            'bossAssistantId' => $this->getBossAssistantId(),
            'bossAssistantWhiteListId' => $this->getBossAssistantWhiteListId(),
            'transformationRuleSetId' => $this->getTransformationRuleSetId(),
            'languageId' => $this->getLanguageId(),
            'terminalId' => $this->getTerminalId(),
            'extensionId' => $this->getExtensionId(),
            'timezoneId' => $this->getTimezoneId(),
            'outgoingDdiId' => $this->getOutgoingDdiId(),
            'outgoingDdiRuleId' => $this->getOutgoingDdiRuleId(),
            'voicemailLocutionId' => $this->getVoicemailLocutionId(),
            'pickUpRelUsers' => $this->getPickUpRelUsers(),
            'queueMembers' => $this->getQueueMembers(),
            'callForwardSettings' => $this->getCallForwardSettings()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        $this->callAcl = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\CallAcl\\CallAcl', $this->getCallAclId());
        $this->bossAssistant = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\User\\User', $this->getBossAssistantId());
        $this->bossAssistantWhiteList = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\MatchList\\MatchList', $this->getBossAssistantWhiteListId());
        $this->transformationRuleSet = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\TransformationRuleSet\\TransformationRuleSet', $this->getTransformationRuleSetId());
        $this->language = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Language\\Language', $this->getLanguageId());
        $this->terminal = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Terminal\\Terminal', $this->getTerminalId());
        $this->extension = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Extension\\Extension', $this->getExtensionId());
        $this->timezone = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Timezone\\Timezone', $this->getTimezoneId());
        $this->outgoingDdi = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Ddi\\Ddi', $this->getOutgoingDdiId());
        $this->outgoingDdiRule = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\OutgoingDdiRule\\OutgoingDdiRule', $this->getOutgoingDdiRuleId());
        $this->voicemailLocution = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Locution\\Locution', $this->getVoicemailLocutionId());
        if (!is_null($this->pickUpRelUsers)) {
            $items = $this->getPickUpRelUsers();
            $this->pickUpRelUsers = [];
            foreach ($items as $item) {
                $this->pickUpRelUsers[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\PickUpRelUser\\PickUpRelUser',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->queueMembers)) {
            $items = $this->getQueueMembers();
            $this->queueMembers = [];
            foreach ($items as $item) {
                $this->queueMembers[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\QueueMember\\QueueMember',
                    $item->getId() ?? $item
                );
            }
        }

        if (!is_null($this->callForwardSettings)) {
            $items = $this->getCallForwardSettings();
            $this->callForwardSettings = [];
            foreach ($items as $item) {
                $this->callForwardSettings[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\CallForwardSetting\\CallForwardSetting',
                    $item->getId() ?? $item
                );
            }
        }

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {
        $this->pickUpRelUsers = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\PickUpRelUser\\PickUpRelUser',
            $this->pickUpRelUsers
        );
        $this->queueMembers = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\QueueMember\\QueueMember',
            $this->queueMembers
        );
        $this->callForwardSettings = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\CallForwardSetting\\CallForwardSetting',
            $this->callForwardSettings
        );
    }

    /**
     * @param string $name
     *
     * @return UserDTO
     */
    public function setName($name)
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
     * @return UserDTO
     */
    public function setLastname($lastname)
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
     * @return UserDTO
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
     * @return UserDTO
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
     * @return UserDTO
     */
    public function setDoNotDisturb($doNotDisturb)
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
     * @return UserDTO
     */
    public function setIsBoss($isBoss)
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
     * @return UserDTO
     */
    public function setActive($active)
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
     * @return UserDTO
     */
    public function setMaxCalls($maxCalls)
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
     * @return UserDTO
     */
    public function setExternalIpCalls($externalIpCalls)
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
     * @return UserDTO
     */
    public function setVoicemailEnabled($voicemailEnabled)
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
     * @return UserDTO
     */
    public function setVoicemailSendMail($voicemailSendMail)
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
     * @return UserDTO
     */
    public function setVoicemailAttachSound($voicemailAttachSound)
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
     * @return UserDTO
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
     * @return UserDTO
     */
    public function setGsQRCode($gsQRCode)
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
     * @return UserDTO
     */
    public function setId($id)
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
     * @param integer $companyId
     *
     * @return UserDTO
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param integer $callAclId
     *
     * @return UserDTO
     */
    public function setCallAclId($callAclId)
    {
        $this->callAclId = $callAclId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCallAclId()
    {
        return $this->callAclId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\CallAcl\CallAcl
     */
    public function getCallAcl()
    {
        return $this->callAcl;
    }

    /**
     * @param integer $bossAssistantId
     *
     * @return UserDTO
     */
    public function setBossAssistantId($bossAssistantId)
    {
        $this->bossAssistantId = $bossAssistantId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getBossAssistantId()
    {
        return $this->bossAssistantId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\User
     */
    public function getBossAssistant()
    {
        return $this->bossAssistant;
    }

    /**
     * @param integer $bossAssistantWhiteListId
     *
     * @return UserDTO
     */
    public function setBossAssistantWhiteListId($bossAssistantWhiteListId)
    {
        $this->bossAssistantWhiteListId = $bossAssistantWhiteListId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getBossAssistantWhiteListId()
    {
        return $this->bossAssistantWhiteListId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchList
     */
    public function getBossAssistantWhiteList()
    {
        return $this->bossAssistantWhiteList;
    }

    /**
     * @param integer $transformationRuleSetId
     *
     * @return UserDTO
     */
    public function setTransformationRuleSetId($transformationRuleSetId)
    {
        $this->transformationRuleSetId = $transformationRuleSetId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTransformationRuleSetId()
    {
        return $this->transformationRuleSetId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet
     */
    public function getTransformationRuleSet()
    {
        return $this->transformationRuleSet;
    }

    /**
     * @param integer $languageId
     *
     * @return UserDTO
     */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Language\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param integer $terminalId
     *
     * @return UserDTO
     */
    public function setTerminalId($terminalId)
    {
        $this->terminalId = $terminalId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTerminalId()
    {
        return $this->terminalId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Terminal\Terminal
     */
    public function getTerminal()
    {
        return $this->terminal;
    }

    /**
     * @param integer $extensionId
     *
     * @return UserDTO
     */
    public function setExtensionId($extensionId)
    {
        $this->extensionId = $extensionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getExtensionId()
    {
        return $this->extensionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Extension\Extension
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param integer $timezoneId
     *
     * @return UserDTO
     */
    public function setTimezoneId($timezoneId)
    {
        $this->timezoneId = $timezoneId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTimezoneId()
    {
        return $this->timezoneId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Timezone\Timezone
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param integer $outgoingDdiId
     *
     * @return UserDTO
     */
    public function setOutgoingDdiId($outgoingDdiId)
    {
        $this->outgoingDdiId = $outgoingDdiId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOutgoingDdiId()
    {
        return $this->outgoingDdiId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Ddi\Ddi
     */
    public function getOutgoingDdi()
    {
        return $this->outgoingDdi;
    }

    /**
     * @param integer $outgoingDdiRuleId
     *
     * @return UserDTO
     */
    public function setOutgoingDdiRuleId($outgoingDdiRuleId)
    {
        $this->outgoingDdiRuleId = $outgoingDdiRuleId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getOutgoingDdiRuleId()
    {
        return $this->outgoingDdiRuleId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRule
     */
    public function getOutgoingDdiRule()
    {
        return $this->outgoingDdiRule;
    }

    /**
     * @param integer $voicemailLocutionId
     *
     * @return UserDTO
     */
    public function setVoicemailLocutionId($voicemailLocutionId)
    {
        $this->voicemailLocutionId = $voicemailLocutionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getVoicemailLocutionId()
    {
        return $this->voicemailLocutionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Locution\Locution
     */
    public function getVoicemailLocution()
    {
        return $this->voicemailLocution;
    }

    /**
     * @param array $pickUpRelUsers
     *
     * @return UserDTO
     */
    public function setPickUpRelUsers($pickUpRelUsers)
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
     * @return UserDTO
     */
    public function setQueueMembers($queueMembers)
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
     * @return UserDTO
     */
    public function setCallForwardSettings($callForwardSettings)
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


