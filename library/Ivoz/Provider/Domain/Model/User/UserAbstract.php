<?php

namespace Ivoz\Provider\Domain\Model\User;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

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
     * @var string | null
     */
    protected $email;

    /**
     * comment: password
     * @var string | null
     */
    protected $pass;

    /**
     * @var boolean
     */
    protected $doNotDisturb = false;

    /**
     * @var boolean
     */
    protected $isBoss = false;

    /**
     * @var boolean
     */
    protected $active = false;

    /**
     * @var integer
     */
    protected $maxCalls = 0;

    /**
     * comment: enum:0|1|2|3
     * @var string
     */
    protected $externalIpCalls = '0';

    /**
     * @var boolean
     */
    protected $voicemailEnabled = true;

    /**
     * @var boolean
     */
    protected $voicemailSendMail = false;

    /**
     * @var boolean
     */
    protected $voicemailAttachSound = true;

    /**
     * @var boolean
     */
    protected $gsQRCode = false;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface | null
     */
    protected $callAcl;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    protected $bossAssistant;

    /**
     * @var \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface | null
     */
    protected $bossAssistantWhiteList;

    /**
     * @var \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface | null
     */
    protected $transformationRuleSet;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageInterface | null
     */
    protected $language;

    /**
     * @var \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface | null
     */
    protected $terminal;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    protected $extension;

    /**
     * @var \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface | null
     */
    protected $timezone;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    protected $outgoingDdi;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface | null
     */
    protected $outgoingDdiRule;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    protected $voicemailLocution;


    use ChangelogTrait;

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
        return sprintf(
            "%s#%s",
            "User",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return UserDto
     */
    public static function createDto($id = null)
    {
        return new UserDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param UserInterface|null $entity
     * @param int $depth
     * @return UserDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, UserInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var UserDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UserDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, UserDto::class);

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
            $dto->getGsQRCode()
        );

        $self
            ->setEmail($dto->getEmail())
            ->setPass($dto->getPass())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCallAcl($fkTransformer->transform($dto->getCallAcl()))
            ->setBossAssistant($fkTransformer->transform($dto->getBossAssistant()))
            ->setBossAssistantWhiteList($fkTransformer->transform($dto->getBossAssistantWhiteList()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()))
            ->setTerminal($fkTransformer->transform($dto->getTerminal()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setTimezone($fkTransformer->transform($dto->getTimezone()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
            ->setOutgoingDdiRule($fkTransformer->transform($dto->getOutgoingDdiRule()))
            ->setVoicemailLocution($fkTransformer->transform($dto->getVoicemailLocution()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param UserDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, UserDto::class);

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
            ->setGsQRCode($dto->getGsQRCode())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCallAcl($fkTransformer->transform($dto->getCallAcl()))
            ->setBossAssistant($fkTransformer->transform($dto->getBossAssistant()))
            ->setBossAssistantWhiteList($fkTransformer->transform($dto->getBossAssistantWhiteList()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()))
            ->setTerminal($fkTransformer->transform($dto->getTerminal()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setTimezone($fkTransformer->transform($dto->getTimezone()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
            ->setOutgoingDdiRule($fkTransformer->transform($dto->getOutgoingDdiRule()))
            ->setVoicemailLocution($fkTransformer->transform($dto->getVoicemailLocution()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return UserDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setLastname(self::getLastname())
            ->setEmail(self::getEmail())
            ->setPass(self::getPass())
            ->setDoNotDisturb(self::getDoNotDisturb())
            ->setIsBoss(self::getIsBoss())
            ->setActive(self::getActive())
            ->setMaxCalls(self::getMaxCalls())
            ->setExternalIpCalls(self::getExternalIpCalls())
            ->setVoicemailEnabled(self::getVoicemailEnabled())
            ->setVoicemailSendMail(self::getVoicemailSendMail())
            ->setVoicemailAttachSound(self::getVoicemailAttachSound())
            ->setGsQRCode(self::getGsQRCode())
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setCallAcl(\Ivoz\Provider\Domain\Model\CallAcl\CallAcl::entityToDto(self::getCallAcl(), $depth))
            ->setBossAssistant(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getBossAssistant(), $depth))
            ->setBossAssistantWhiteList(\Ivoz\Provider\Domain\Model\MatchList\MatchList::entityToDto(self::getBossAssistantWhiteList(), $depth))
            ->setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet::entityToDto(self::getTransformationRuleSet(), $depth))
            ->setLanguage(\Ivoz\Provider\Domain\Model\Language\Language::entityToDto(self::getLanguage(), $depth))
            ->setTerminal(\Ivoz\Provider\Domain\Model\Terminal\Terminal::entityToDto(self::getTerminal(), $depth))
            ->setExtension(\Ivoz\Provider\Domain\Model\Extension\Extension::entityToDto(self::getExtension(), $depth))
            ->setTimezone(\Ivoz\Provider\Domain\Model\Timezone\Timezone::entityToDto(self::getTimezone(), $depth))
            ->setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\Ddi::entityToDto(self::getOutgoingDdi(), $depth))
            ->setOutgoingDdiRule(\Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRule::entityToDto(self::getOutgoingDdiRule(), $depth))
            ->setVoicemailLocution(\Ivoz\Provider\Domain\Model\Locution\Locution::entityToDto(self::getVoicemailLocution(), $depth));
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
     * @return static
     */
    protected function setName($name)
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
     * @return static
     */
    protected function setLastname($lastname)
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
     * @param string $email | null
     *
     * @return static
     */
    protected function setEmail($email = null)
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
     * @return string | null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set pass
     *
     * @param string $pass | null
     *
     * @return static
     */
    protected function setPass($pass = null)
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
     * @return string | null
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
     * @return static
     */
    protected function setDoNotDisturb($doNotDisturb)
    {
        Assertion::notNull($doNotDisturb, 'doNotDisturb value "%s" is null, but non null value was expected.');
        Assertion::between(intval($doNotDisturb), 0, 1, 'doNotDisturb provided "%s" is not a valid boolean value.');
        $doNotDisturb = (bool) $doNotDisturb;

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
     * @return static
     */
    protected function setIsBoss($isBoss)
    {
        Assertion::notNull($isBoss, 'isBoss value "%s" is null, but non null value was expected.');
        Assertion::between(intval($isBoss), 0, 1, 'isBoss provided "%s" is not a valid boolean value.');
        $isBoss = (bool) $isBoss;

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
     * @return static
     */
    protected function setActive($active)
    {
        Assertion::notNull($active, 'active value "%s" is null, but non null value was expected.');
        Assertion::between(intval($active), 0, 1, 'active provided "%s" is not a valid boolean value.');
        $active = (bool) $active;

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
     * @return static
     */
    protected function setMaxCalls($maxCalls)
    {
        Assertion::notNull($maxCalls, 'maxCalls value "%s" is null, but non null value was expected.');
        Assertion::integerish($maxCalls, 'maxCalls value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($maxCalls, 0, 'maxCalls provided "%s" is not greater or equal than "%s".');

        $this->maxCalls = (int) $maxCalls;

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
     * @return static
     */
    protected function setExternalIpCalls($externalIpCalls)
    {
        Assertion::notNull($externalIpCalls, 'externalIpCalls value "%s" is null, but non null value was expected.');
        Assertion::maxLength($externalIpCalls, 1, 'externalIpCalls value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($externalIpCalls, [
            UserInterface::EXTERNALIPCALLS_0,
            UserInterface::EXTERNALIPCALLS_1,
            UserInterface::EXTERNALIPCALLS_2,
            UserInterface::EXTERNALIPCALLS_3
        ], 'externalIpCallsvalue "%s" is not an element of the valid values: %s');

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
     * @return static
     */
    protected function setVoicemailEnabled($voicemailEnabled)
    {
        Assertion::notNull($voicemailEnabled, 'voicemailEnabled value "%s" is null, but non null value was expected.');
        Assertion::between(intval($voicemailEnabled), 0, 1, 'voicemailEnabled provided "%s" is not a valid boolean value.');
        $voicemailEnabled = (bool) $voicemailEnabled;

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
     * @return static
     */
    protected function setVoicemailSendMail($voicemailSendMail)
    {
        Assertion::notNull($voicemailSendMail, 'voicemailSendMail value "%s" is null, but non null value was expected.');
        Assertion::between(intval($voicemailSendMail), 0, 1, 'voicemailSendMail provided "%s" is not a valid boolean value.');
        $voicemailSendMail = (bool) $voicemailSendMail;

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
     * @return static
     */
    protected function setVoicemailAttachSound($voicemailAttachSound)
    {
        Assertion::notNull($voicemailAttachSound, 'voicemailAttachSound value "%s" is null, but non null value was expected.');
        Assertion::between(intval($voicemailAttachSound), 0, 1, 'voicemailAttachSound provided "%s" is not a valid boolean value.');
        $voicemailAttachSound = (bool) $voicemailAttachSound;

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
     * Set gsQRCode
     *
     * @param boolean $gsQRCode
     *
     * @return static
     */
    protected function setGsQRCode($gsQRCode)
    {
        Assertion::notNull($gsQRCode, 'gsQRCode value "%s" is null, but non null value was expected.');
        Assertion::between(intval($gsQRCode), 0, 1, 'gsQRCode provided "%s" is not a valid boolean value.');
        $gsQRCode = (bool) $gsQRCode;

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
     * @return static
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
     * @param \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface $callAcl | null
     *
     * @return static
     */
    public function setCallAcl(\Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface $callAcl = null)
    {
        $this->callAcl = $callAcl;

        return $this;
    }

    /**
     * Get callAcl
     *
     * @return \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface | null
     */
    public function getCallAcl()
    {
        return $this->callAcl;
    }

    /**
     * Set bossAssistant
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $bossAssistant | null
     *
     * @return static
     */
    public function setBossAssistant(UserInterface $bossAssistant = null)
    {
        $this->bossAssistant = $bossAssistant;

        return $this;
    }

    /**
     * Get bossAssistant
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getBossAssistant()
    {
        return $this->bossAssistant;
    }

    /**
     * Set bossAssistantWhiteList
     *
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $bossAssistantWhiteList | null
     *
     * @return static
     */
    public function setBossAssistantWhiteList(\Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $bossAssistantWhiteList = null)
    {
        $this->bossAssistantWhiteList = $bossAssistantWhiteList;

        return $this;
    }

    /**
     * Get bossAssistantWhiteList
     *
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface | null
     */
    public function getBossAssistantWhiteList()
    {
        return $this->bossAssistantWhiteList;
    }

    /**
     * Set transformationRuleSet
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet | null
     *
     * @return static
     */
    public function setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet = null)
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * Get transformationRuleSet
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet()
    {
        return $this->transformationRuleSet;
    }

    /**
     * Set language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language | null
     *
     * @return static
     */
    public function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageInterface $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface | null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set terminal
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal | null
     *
     * @return static
     */
    public function setTerminal(\Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal = null)
    {
        $this->terminal = $terminal;

        return $this;
    }

    /**
     * Get terminal
     *
     * @return \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface | null
     */
    public function getTerminal()
    {
        return $this->terminal;
    }

    /**
     * Set extension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension | null
     *
     * @return static
     */
    public function setExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension = null)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set timezone
     *
     * @param \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $timezone | null
     *
     * @return static
     */
    public function setTimezone(\Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface $timezone = null)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return \Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface | null
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Set outgoingDdi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi | null
     *
     * @return static
     */
    public function setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi = null)
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    /**
     * Get outgoingDdi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getOutgoingDdi()
    {
        return $this->outgoingDdi;
    }

    /**
     * Set outgoingDdiRule
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule | null
     *
     * @return static
     */
    public function setOutgoingDdiRule(\Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule = null)
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    /**
     * Get outgoingDdiRule
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface | null
     */
    public function getOutgoingDdiRule()
    {
        return $this->outgoingDdiRule;
    }

    /**
     * Set voicemailLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $voicemailLocution | null
     *
     * @return static
     */
    public function setVoicemailLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $voicemailLocution = null)
    {
        $this->voicemailLocution = $voicemailLocution;

        return $this;
    }

    /**
     * Get voicemailLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getVoicemailLocution()
    {
        return $this->voicemailLocution;
    }

    // @codeCoverageIgnoreEnd
}
