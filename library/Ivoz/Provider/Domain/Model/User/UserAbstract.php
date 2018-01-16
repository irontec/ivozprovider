<?php

namespace Ivoz\Provider\Domain\Model\User;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * UserAbstract
 * @codeCoverageIgnore
 */
abstract class UserAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $email;

    /**
     * @comment password
     * @var string
     */
    protected $pass;

    /**
     * @var boolean
     */
    protected $doNotDisturb = '0';

    /**
     * @var boolean
     */
    protected $isBoss = '0';

    /**
     * @var boolean
     */
    protected $active = '0';

    /**
     * @var integer
     */
    protected $maxCalls = '0';

    /**
     * @comment enum:0|1|2|3
     * @var string
     */
    protected $externalIpCalls = '0';

    /**
     * @var boolean
     */
    protected $voicemailEnabled = '1';

    /**
     * @var boolean
     */
    protected $voicemailSendMail = '0';

    /**
     * @var boolean
     */
    protected $voicemailAttachSound = '1';

    /**
     * @var string
     */
    protected $tokenKey;

    /**
     * @var boolean
     */
    protected $gsQRCode = '0';

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface
     */
    protected $callAcl;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $bossAssistant;

    /**
     * @var \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    protected $bossAssistantWhiteList;

    /**
     * @var \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface
     */
    protected $transformationRuleSet;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    protected $language;

    /**
     * @var \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface
     */
    protected $terminal;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    protected $extension;

    /**
     * @var \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    protected $timezone;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    protected $outgoingDdi;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface
     */
    protected $outgoingDdiRule;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    protected $voicemailLocution;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        $lastname,
        $doNotDisturb,
        $isBoss,
        $active,
        $maxCalls,
        $externalIpCalls,
        $voicemailEnabled,
        $voicemailSendMail,
        $voicemailAttachSound,
        $gsQRCode
    ) {
        $this->setName($name);
        $this->setLastname($lastname);
        $this->setDoNotDisturb($doNotDisturb);
        $this->setIsBoss($isBoss);
        $this->setActive($active);
        $this->setMaxCalls($maxCalls);
        $this->setExternalIpCalls($externalIpCalls);
        $this->setVoicemailEnabled($voicemailEnabled);
        $this->setVoicemailSendMail($voicemailSendMail);
        $this->setVoicemailAttachSound($voicemailAttachSound);
        $this->setGsQRCode($gsQRCode);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "User",
            $this->getId()
        );
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$dbFieldName] != $this->_initialValues[$dbFieldName];
    }

    public function getInitialValue($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }

        return $this->_initialValues[$dbFieldName];
    }

    /**
     * @return array
     */
    protected function getChangeSet()
    {
        $changes = [];
        $currentValues = $this->__toArray();
        foreach ($currentValues as $key => $value) {

            if ($this->_initialValues[$key] == $currentValues[$key]) {
                continue;
            }

            $value = $currentValues[$key];
            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }

            $changes[$key] = $value;
        }

        return $changes;
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @return UserDTO
     */
    public static function createDTO()
    {
        return new UserDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UserDTO
         */
        Assertion::isInstanceOf($dto, UserDTO::class);

        $self = new static(
            $dto->getName(),
            $dto->getLastname(),
            $dto->getDoNotDisturb(),
            $dto->getIsBoss(),
            $dto->getActive(),
            $dto->getMaxCalls(),
            $dto->getExternalIpCalls(),
            $dto->getVoicemailEnabled(),
            $dto->getVoicemailSendMail(),
            $dto->getVoicemailAttachSound(),
            $dto->getGsQRCode());

        $self
            ->setEmail($dto->getEmail())
            ->setPass($dto->getPass())
            ->setTokenKey($dto->getTokenKey())
            ->setCompany($dto->getCompany())
            ->setCallAcl($dto->getCallAcl())
            ->setBossAssistant($dto->getBossAssistant())
            ->setBossAssistantWhiteList($dto->getBossAssistantWhiteList())
            ->setTransformationRuleSet($dto->getTransformationRuleSet())
            ->setLanguage($dto->getLanguage())
            ->setTerminal($dto->getTerminal())
            ->setExtension($dto->getExtension())
            ->setTimezone($dto->getTimezone())
            ->setOutgoingDdi($dto->getOutgoingDdi())
            ->setOutgoingDdiRule($dto->getOutgoingDdiRule())
            ->setVoicemailLocution($dto->getVoicemailLocution())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UserDTO
         */
        Assertion::isInstanceOf($dto, UserDTO::class);

        $this
            ->setName($dto->getName())
            ->setLastname($dto->getLastname())
            ->setEmail($dto->getEmail())
            ->setPass($dto->getPass())
            ->setDoNotDisturb($dto->getDoNotDisturb())
            ->setIsBoss($dto->getIsBoss())
            ->setActive($dto->getActive())
            ->setMaxCalls($dto->getMaxCalls())
            ->setExternalIpCalls($dto->getExternalIpCalls())
            ->setVoicemailEnabled($dto->getVoicemailEnabled())
            ->setVoicemailSendMail($dto->getVoicemailSendMail())
            ->setVoicemailAttachSound($dto->getVoicemailAttachSound())
            ->setTokenKey($dto->getTokenKey())
            ->setGsQRCode($dto->getGsQRCode())
            ->setCompany($dto->getCompany())
            ->setCallAcl($dto->getCallAcl())
            ->setBossAssistant($dto->getBossAssistant())
            ->setBossAssistantWhiteList($dto->getBossAssistantWhiteList())
            ->setTransformationRuleSet($dto->getTransformationRuleSet())
            ->setLanguage($dto->getLanguage())
            ->setTerminal($dto->getTerminal())
            ->setExtension($dto->getExtension())
            ->setTimezone($dto->getTimezone())
            ->setOutgoingDdi($dto->getOutgoingDdi())
            ->setOutgoingDdiRule($dto->getOutgoingDdiRule())
            ->setVoicemailLocution($dto->getVoicemailLocution());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @return UserDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setName($this->getName())
            ->setLastname($this->getLastname())
            ->setEmail($this->getEmail())
            ->setPass($this->getPass())
            ->setDoNotDisturb($this->getDoNotDisturb())
            ->setIsBoss($this->getIsBoss())
            ->setActive($this->getActive())
            ->setMaxCalls($this->getMaxCalls())
            ->setExternalIpCalls($this->getExternalIpCalls())
            ->setVoicemailEnabled($this->getVoicemailEnabled())
            ->setVoicemailSendMail($this->getVoicemailSendMail())
            ->setVoicemailAttachSound($this->getVoicemailAttachSound())
            ->setTokenKey($this->getTokenKey())
            ->setGsQRCode($this->getGsQRCode())
            ->setCompanyId($this->getCompany() ? $this->getCompany()->getId() : null)
            ->setCallAclId($this->getCallAcl() ? $this->getCallAcl()->getId() : null)
            ->setBossAssistantId($this->getBossAssistant() ? $this->getBossAssistant()->getId() : null)
            ->setBossAssistantWhiteListId($this->getBossAssistantWhiteList() ? $this->getBossAssistantWhiteList()->getId() : null)
            ->setTransformationRuleSetId($this->getTransformationRuleSet() ? $this->getTransformationRuleSet()->getId() : null)
            ->setLanguageId($this->getLanguage() ? $this->getLanguage()->getId() : null)
            ->setTerminalId($this->getTerminal() ? $this->getTerminal()->getId() : null)
            ->setExtensionId($this->getExtension() ? $this->getExtension()->getId() : null)
            ->setTimezoneId($this->getTimezone() ? $this->getTimezone()->getId() : null)
            ->setOutgoingDdiId($this->getOutgoingDdi() ? $this->getOutgoingDdi()->getId() : null)
            ->setOutgoingDdiRuleId($this->getOutgoingDdiRule() ? $this->getOutgoingDdiRule()->getId() : null)
            ->setVoicemailLocutionId($this->getVoicemailLocution() ? $this->getVoicemailLocution()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'lastname' => self::getLastname(),
            'email' => self::getEmail(),
            'pass' => self::getPass(),
            'doNotDisturb' => self::getDoNotDisturb(),
            'isBoss' => self::getIsBoss(),
            'active' => self::getActive(),
            'maxCalls' => self::getMaxCalls(),
            'externalIpCalls' => self::getExternalIpCalls(),
            'voicemailEnabled' => self::getVoicemailEnabled(),
            'voicemailSendMail' => self::getVoicemailSendMail(),
            'voicemailAttachSound' => self::getVoicemailAttachSound(),
            'tokenKey' => self::getTokenKey(),
            'gsQRCode' => self::getGsQRCode(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'callAclId' => self::getCallAcl() ? self::getCallAcl()->getId() : null,
            'bossAssistantId' => self::getBossAssistant() ? self::getBossAssistant()->getId() : null,
            'bossAssistantWhiteListId' => self::getBossAssistantWhiteList() ? self::getBossAssistantWhiteList()->getId() : null,
            'transformationRuleSetId' => self::getTransformationRuleSet() ? self::getTransformationRuleSet()->getId() : null,
            'languageId' => self::getLanguage() ? self::getLanguage()->getId() : null,
            'terminalId' => self::getTerminal() ? self::getTerminal()->getId() : null,
            'extensionId' => self::getExtension() ? self::getExtension()->getId() : null,
            'timezoneId' => self::getTimezone() ? self::getTimezone()->getId() : null,
            'outgoingDdiId' => self::getOutgoingDdi() ? self::getOutgoingDdi()->getId() : null,
            'outgoingDdiRuleId' => self::getOutgoingDdiRule() ? self::getOutgoingDdiRule()->getId() : null,
            'voicemailLocutionId' => self::getVoicemailLocution() ? self::getVoicemailLocution()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return self
     */
    public function setLastname($lastname)
    {
        Assertion::notNull($lastname, 'lastname value "%s" is null, but non null value was expected.');
        Assertion::maxLength($lastname, 100, 'lastname value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email = null)
    {
        if (!is_null($email)) {
            Assertion::maxLength($email, 100, 'email value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set pass
     *
     * @param string $pass
     *
     * @return self
     */
    public function setPass($pass = null)
    {
        if (!is_null($pass)) {
            Assertion::maxLength($pass, 80, 'pass value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->pass = $pass;

        return $this;
    }

    /**
     * Get pass
     *
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set doNotDisturb
     *
     * @param boolean $doNotDisturb
     *
     * @return self
     */
    public function setDoNotDisturb($doNotDisturb)
    {
        Assertion::notNull($doNotDisturb, 'doNotDisturb value "%s" is null, but non null value was expected.');
        Assertion::between(intval($doNotDisturb), 0, 1, 'doNotDisturb provided "%s" is not a valid boolean value.');

        $this->doNotDisturb = $doNotDisturb;

        return $this;
    }

    /**
     * Get doNotDisturb
     *
     * @return boolean
     */
    public function getDoNotDisturb()
    {
        return $this->doNotDisturb;
    }

    /**
     * Set isBoss
     *
     * @param boolean $isBoss
     *
     * @return self
     */
    public function setIsBoss($isBoss)
    {
        Assertion::notNull($isBoss, 'isBoss value "%s" is null, but non null value was expected.');
        Assertion::between(intval($isBoss), 0, 1, 'isBoss provided "%s" is not a valid boolean value.');

        $this->isBoss = $isBoss;

        return $this;
    }

    /**
     * Get isBoss
     *
     * @return boolean
     */
    public function getIsBoss()
    {
        return $this->isBoss;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return self
     */
    public function setActive($active)
    {
        Assertion::notNull($active, 'active value "%s" is null, but non null value was expected.');
        Assertion::between(intval($active), 0, 1, 'active provided "%s" is not a valid boolean value.');

        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set maxCalls
     *
     * @param integer $maxCalls
     *
     * @return self
     */
    public function setMaxCalls($maxCalls)
    {
        Assertion::notNull($maxCalls, 'maxCalls value "%s" is null, but non null value was expected.');
        Assertion::integerish($maxCalls, 'maxCalls value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($maxCalls, 0, 'maxCalls provided "%s" is not greater or equal than "%s".');

        $this->maxCalls = $maxCalls;

        return $this;
    }

    /**
     * Get maxCalls
     *
     * @return integer
     */
    public function getMaxCalls()
    {
        return $this->maxCalls;
    }

    /**
     * Set externalIpCalls
     *
     * @param string $externalIpCalls
     *
     * @return self
     */
    public function setExternalIpCalls($externalIpCalls)
    {
        Assertion::notNull($externalIpCalls, 'externalIpCalls value "%s" is null, but non null value was expected.');
        Assertion::maxLength($externalIpCalls, 1, 'externalIpCalls value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($externalIpCalls, array (
          0 => '0',
          1 => '1',
          2 => '2',
          3 => '3',
        ), 'externalIpCallsvalue "%s" is not an element of the valid values: %s');

        $this->externalIpCalls = $externalIpCalls;

        return $this;
    }

    /**
     * Get externalIpCalls
     *
     * @return string
     */
    public function getExternalIpCalls()
    {
        return $this->externalIpCalls;
    }

    /**
     * Set voicemailEnabled
     *
     * @param boolean $voicemailEnabled
     *
     * @return self
     */
    public function setVoicemailEnabled($voicemailEnabled)
    {
        Assertion::notNull($voicemailEnabled, 'voicemailEnabled value "%s" is null, but non null value was expected.');
        Assertion::between(intval($voicemailEnabled), 0, 1, 'voicemailEnabled provided "%s" is not a valid boolean value.');

        $this->voicemailEnabled = $voicemailEnabled;

        return $this;
    }

    /**
     * Get voicemailEnabled
     *
     * @return boolean
     */
    public function getVoicemailEnabled()
    {
        return $this->voicemailEnabled;
    }

    /**
     * Set voicemailSendMail
     *
     * @param boolean $voicemailSendMail
     *
     * @return self
     */
    public function setVoicemailSendMail($voicemailSendMail)
    {
        Assertion::notNull($voicemailSendMail, 'voicemailSendMail value "%s" is null, but non null value was expected.');
        Assertion::between(intval($voicemailSendMail), 0, 1, 'voicemailSendMail provided "%s" is not a valid boolean value.');

        $this->voicemailSendMail = $voicemailSendMail;

        return $this;
    }

    /**
     * Get voicemailSendMail
     *
     * @return boolean
     */
    public function getVoicemailSendMail()
    {
        return $this->voicemailSendMail;
    }

    /**
     * Set voicemailAttachSound
     *
     * @param boolean $voicemailAttachSound
     *
     * @return self
     */
    public function setVoicemailAttachSound($voicemailAttachSound)
    {
        Assertion::notNull($voicemailAttachSound, 'voicemailAttachSound value "%s" is null, but non null value was expected.');
        Assertion::between(intval($voicemailAttachSound), 0, 1, 'voicemailAttachSound provided "%s" is not a valid boolean value.');

        $this->voicemailAttachSound = $voicemailAttachSound;

        return $this;
    }

    /**
     * Get voicemailAttachSound
     *
     * @return boolean
     */
    public function getVoicemailAttachSound()
    {
        return $this->voicemailAttachSound;
    }

    /**
     * Set tokenKey
     *
     * @param string $tokenKey
     *
     * @return self
     */
    public function setTokenKey($tokenKey = null)
    {
        if (!is_null($tokenKey)) {
            Assertion::maxLength($tokenKey, 125, 'tokenKey value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->tokenKey = $tokenKey;

        return $this;
    }

    /**
     * Get tokenKey
     *
     * @return string
     */
    public function getTokenKey()
    {
        return $this->tokenKey;
    }

    /**
     * Set gsQRCode
     *
     * @param boolean $gsQRCode
     *
     * @return self
     */
    public function setGsQRCode($gsQRCode)
    {
        Assertion::notNull($gsQRCode, 'gsQRCode value "%s" is null, but non null value was expected.');
        Assertion::between(intval($gsQRCode), 0, 1, 'gsQRCode provided "%s" is not a valid boolean value.');

        $this->gsQRCode = $gsQRCode;

        return $this;
    }

    /**
     * Get gsQRCode
     *
     * @return boolean
     */
    public function getGsQRCode()
    {
        return $this->gsQRCode;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set callAcl
     *
     * @param \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface $callAcl
     *
     * @return self
     */
    public function setCallAcl(\Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface $callAcl = null)
    {
        $this->callAcl = $callAcl;

        return $this;
    }

    /**
     * Get callAcl
     *
     * @return \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface
     */
    public function getCallAcl()
    {
        return $this->callAcl;
    }

    /**
     * Set bossAssistant
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $bossAssistant
     *
     * @return self
     */
    public function setBossAssistant(UserInterface $bossAssistant = null)
    {
        $this->bossAssistant = $bossAssistant;

        return $this;
    }

    /**
     * Get bossAssistant
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getBossAssistant()
    {
        return $this->bossAssistant;
    }

    /**
     * Set bossAssistantWhiteList
     *
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $bossAssistantWhiteList
     *
     * @return self
     */
    public function setBossAssistantWhiteList(\Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $bossAssistantWhiteList = null)
    {
        $this->bossAssistantWhiteList = $bossAssistantWhiteList;

        return $this;
    }

    /**
     * Get bossAssistantWhiteList
     *
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    public function getBossAssistantWhiteList()
    {
        return $this->bossAssistantWhiteList;
    }

    /**
     * Set transformationRuleSet
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet
     *
     * @return self
     */
    public function setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet = null)
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * Get transformationRuleSet
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface
     */
    public function getTransformationRuleSet()
    {
        return $this->transformationRuleSet;
    }

    /**
     * Set language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language
     *
     * @return self
     */
    public function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageInterface $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set terminal
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal
     *
     * @return self
     */
    public function setTerminal(\Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal = null)
    {
        $this->terminal = $terminal;

        return $this;
    }

    /**
     * Get terminal
     *
     * @return \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface
     */
    public function getTerminal()
    {
        return $this->terminal;
    }

    /**
     * Set extension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension
     *
     * @return self
     */
    public function setExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension = null)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set timezone
     *
     * @param \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $timezone
     *
     * @return self
     */
    public function setTimezone(\Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $timezone = null)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Set outgoingDdi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi
     *
     * @return self
     */
    public function setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi = null)
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    /**
     * Get outgoingDdi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getOutgoingDdi()
    {
        return $this->outgoingDdi;
    }

    /**
     * Set outgoingDdiRule
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule
     *
     * @return self
     */
    public function setOutgoingDdiRule(\Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule = null)
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    /**
     * Get outgoingDdiRule
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface
     */
    public function getOutgoingDdiRule()
    {
        return $this->outgoingDdiRule;
    }

    /**
     * Set voicemailLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $voicemailLocution
     *
     * @return self
     */
    public function setVoicemailLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $voicemailLocution = null)
    {
        $this->voicemailLocution = $voicemailLocution;

        return $this;
    }

    /**
     * Get voicemailLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getVoicemailLocution()
    {
        return $this->voicemailLocution;
    }



    // @codeCoverageIgnoreEnd
}

