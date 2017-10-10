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
     * @var string
     */
    protected $exceptionBoosAssistantRegExp;

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
     * @var boolean
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
     * @var string
     */
    protected $areaCode;

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
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    protected $country;

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
    public function __construct(
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

        $this->initChangelog();
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
    public function hasChanged($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$fieldName] != $this->_initialValues[$fieldName];
    }

    public function getInitialValue($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }

        return $this->_initialValues[$fieldName];
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

        return $self
            ->setEmail($dto->getEmail())
            ->setPass($dto->getPass())
            ->setExceptionBoosAssistantRegExp($dto->getExceptionBoosAssistantRegExp())
            ->setTokenKey($dto->getTokenKey())
            ->setAreaCode($dto->getAreaCode())
            ->setCompany($dto->getCompany())
            ->setCallAcl($dto->getCallAcl())
            ->setBossAssistant($dto->getBossAssistant())
            ->setCountry($dto->getCountry())
            ->setLanguage($dto->getLanguage())
            ->setTerminal($dto->getTerminal())
            ->setExtension($dto->getExtension())
            ->setTimezone($dto->getTimezone())
            ->setOutgoingDdi($dto->getOutgoingDdi())
            ->setOutgoingDdiRule($dto->getOutgoingDdiRule())
            ->setVoicemailLocution($dto->getVoicemailLocution())
        ;
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
            ->setExceptionBoosAssistantRegExp($dto->getExceptionBoosAssistantRegExp())
            ->setActive($dto->getActive())
            ->setMaxCalls($dto->getMaxCalls())
            ->setExternalIpCalls($dto->getExternalIpCalls())
            ->setVoicemailEnabled($dto->getVoicemailEnabled())
            ->setVoicemailSendMail($dto->getVoicemailSendMail())
            ->setVoicemailAttachSound($dto->getVoicemailAttachSound())
            ->setTokenKey($dto->getTokenKey())
            ->setAreaCode($dto->getAreaCode())
            ->setGsQRCode($dto->getGsQRCode())
            ->setCompany($dto->getCompany())
            ->setCallAcl($dto->getCallAcl())
            ->setBossAssistant($dto->getBossAssistant())
            ->setCountry($dto->getCountry())
            ->setLanguage($dto->getLanguage())
            ->setTerminal($dto->getTerminal())
            ->setExtension($dto->getExtension())
            ->setTimezone($dto->getTimezone())
            ->setOutgoingDdi($dto->getOutgoingDdi())
            ->setOutgoingDdiRule($dto->getOutgoingDdiRule())
            ->setVoicemailLocution($dto->getVoicemailLocution());


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
            ->setExceptionBoosAssistantRegExp($this->getExceptionBoosAssistantRegExp())
            ->setActive($this->getActive())
            ->setMaxCalls($this->getMaxCalls())
            ->setExternalIpCalls($this->getExternalIpCalls())
            ->setVoicemailEnabled($this->getVoicemailEnabled())
            ->setVoicemailSendMail($this->getVoicemailSendMail())
            ->setVoicemailAttachSound($this->getVoicemailAttachSound())
            ->setTokenKey($this->getTokenKey())
            ->setAreaCode($this->getAreaCode())
            ->setGsQRCode($this->getGsQRCode())
            ->setCompanyId($this->getCompany() ? $this->getCompany()->getId() : null)
            ->setCallAclId($this->getCallAcl() ? $this->getCallAcl()->getId() : null)
            ->setBossAssistantId($this->getBossAssistant() ? $this->getBossAssistant()->getId() : null)
            ->setCountryId($this->getCountry() ? $this->getCountry()->getId() : null)
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
            'exceptionBoosAssistantRegExp' => self::getExceptionBoosAssistantRegExp(),
            'active' => self::getActive(),
            'maxCalls' => self::getMaxCalls(),
            'externalIpCalls' => self::getExternalIpCalls(),
            'voicemailEnabled' => self::getVoicemailEnabled(),
            'voicemailSendMail' => self::getVoicemailSendMail(),
            'voicemailAttachSound' => self::getVoicemailAttachSound(),
            'tokenKey' => self::getTokenKey(),
            'areaCode' => self::getAreaCode(),
            'gsQRCode' => self::getGsQRCode(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'callAclId' => self::getCallAcl() ? self::getCallAcl()->getId() : null,
            'bossAssistantId' => self::getBossAssistant() ? self::getBossAssistant()->getId() : null,
            'countryId' => self::getCountry() ? self::getCountry()->getId() : null,
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
        Assertion::notNull($name);
        Assertion::maxLength($name, 100);

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
        Assertion::notNull($lastname);
        Assertion::maxLength($lastname, 100);

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
            Assertion::maxLength($email, 100);
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
            Assertion::maxLength($pass, 80);
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
        Assertion::notNull($doNotDisturb);
        Assertion::between(intval($doNotDisturb), 0, 1);

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
        Assertion::notNull($isBoss);
        Assertion::between(intval($isBoss), 0, 1);

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
     * Set exceptionBoosAssistantRegExp
     *
     * @param string $exceptionBoosAssistantRegExp
     *
     * @return self
     */
    public function setExceptionBoosAssistantRegExp($exceptionBoosAssistantRegExp = null)
    {
        if (!is_null($exceptionBoosAssistantRegExp)) {
            Assertion::maxLength($exceptionBoosAssistantRegExp, 255);
        }

        $this->exceptionBoosAssistantRegExp = $exceptionBoosAssistantRegExp;

        return $this;
    }

    /**
     * Get exceptionBoosAssistantRegExp
     *
     * @return string
     */
    public function getExceptionBoosAssistantRegExp()
    {
        return $this->exceptionBoosAssistantRegExp;
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
        Assertion::notNull($active);
        Assertion::between(intval($active), 0, 1);

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
        Assertion::notNull($maxCalls);
        Assertion::integerish($maxCalls);
        Assertion::greaterOrEqualThan($maxCalls, 0);

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
     * @param boolean $externalIpCalls
     *
     * @return self
     */
    public function setExternalIpCalls($externalIpCalls)
    {
        Assertion::notNull($externalIpCalls);
        Assertion::between(intval($externalIpCalls), 0, 1);
        Assertion::choice($externalIpCalls, array (
          0 => '0',
          1 => '1',
          2 => '2',
          3 => '3',
        ));

        $this->externalIpCalls = $externalIpCalls;

        return $this;
    }

    /**
     * Get externalIpCalls
     *
     * @return boolean
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
        Assertion::notNull($voicemailEnabled);
        Assertion::between(intval($voicemailEnabled), 0, 1);

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
        Assertion::notNull($voicemailSendMail);
        Assertion::between(intval($voicemailSendMail), 0, 1);

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
        Assertion::notNull($voicemailAttachSound);
        Assertion::between(intval($voicemailAttachSound), 0, 1);

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
            Assertion::maxLength($tokenKey, 125);
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
     * Set areaCode
     *
     * @param string $areaCode
     *
     * @return self
     */
    public function setAreaCode($areaCode = null)
    {
        if (!is_null($areaCode)) {
            Assertion::maxLength($areaCode, 10);
        }

        $this->areaCode = $areaCode;

        return $this;
    }

    /**
     * Get areaCode
     *
     * @return string
     */
    public function getAreaCode()
    {
        return $this->areaCode;
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
        Assertion::notNull($gsQRCode);
        Assertion::between(intval($gsQRCode), 0, 1);

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
     * @param UserInterface $bossAssistant
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
     * @return UserInterface
     */
    public function getBossAssistant()
    {
        return $this->bossAssistant;
    }

    /**
     * Set country
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $country
     *
     * @return self
     */
    public function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getCountry()
    {
        return $this->country;
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

