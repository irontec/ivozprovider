<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\User;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\CallAcl\CallAcl;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\MatchList\MatchList;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet;
use Ivoz\Provider\Domain\Model\Language\Language;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Timezone\Timezone;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRule;
use Ivoz\Provider\Domain\Model\Locution\Locution;

/**
* UserAbstract
* @codeCoverageIgnore
*/
abstract class UserAbstract
{
    use ChangelogTrait;

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
     * @var bool
     */
    protected $doNotDisturb = false;

    /**
     * @var bool
     */
    protected $isBoss = false;

    /**
     * @var bool
     */
    protected $active = false;

    /**
     * @var int
     */
    protected $maxCalls = 0;

    /**
     * comment: enum:0|1|2|3
     * @var string
     */
    protected $externalIpCalls = '0';

    /**
     * comment: enum:rfc|486|600
     * @var string
     */
    protected $rejectCallMethod = 'rfc';

    /**
     * @var boolean
     */
    protected $voicemailEnabled = true;

    /**
     * @var bool
     */
    protected $voicemailSendMail = false;

    /**
     * @var bool
     */
    protected $voicemailAttachSound = true;

    /**
     * @var bool
     */
    protected $multiContact = true;

    /**
     * @var boolean
     */
    protected $gsQRCode = false;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var CallAclInterface
     */
    protected $callAcl;

    /**
     * @var UserInterface
     */
    protected $bossAssistant;

    /**
     * @var MatchListInterface
     */
    protected $bossAssistantWhiteList;

    /**
     * @var TransformationRuleSetInterface
     */
    protected $transformationRuleSet;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @var TerminalInterface
     * inversedBy users
     */
    protected $terminal;

    /**
     * @var ExtensionInterface
     * inversedBy users
     */
    protected $extension;

    /**
     * @var TimezoneInterface
     */
    protected $timezone;

    /**
     * @var DdiInterface
     */
    protected $outgoingDdi;

    /**
     * @var OutgoingDdiRuleInterface
     */
    protected $outgoingDdiRule;

    /**
     * @var LocutionInterface
     */
    protected $voicemailLocution;

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
        $rejectCallMethod,
        $voicemailEnabled,
        $voicemailSendMail,
        $voicemailAttachSound,
        $multiContact,
        $gsQRCode
    ) {
        $this->setName($name);
        $this->setLastname($lastname);
        $this->setDoNotDisturb($doNotDisturb);
        $this->setIsBoss($isBoss);
        $this->setActive($active);
        $this->setMaxCalls($maxCalls);
        $this->setExternalIpCalls($externalIpCalls);
        $this->setRejectCallMethod($rejectCallMethod);
        $this->setVoicemailEnabled($voicemailEnabled);
        $this->setVoicemailSendMail($voicemailSendMail);
        $this->setVoicemailAttachSound($voicemailAttachSound);
        $this->setMultiContact($multiContact);
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
        ForeignKeyTransformerInterface $fkTransformer
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
            $dto->getRejectCallMethod(),
            $dto->getVoicemailEnabled(),
            $dto->getVoicemailSendMail(),
            $dto->getVoicemailAttachSound(),
            $dto->getMultiContact(),
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
            ->setVoicemailLocution($fkTransformer->transform($dto->getVoicemailLocution()));

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
        ForeignKeyTransformerInterface $fkTransformer
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
            ->setRejectCallMethod($dto->getRejectCallMethod())
            ->setVoicemailEnabled($dto->getVoicemailEnabled())
            ->setVoicemailSendMail($dto->getVoicemailSendMail())
            ->setVoicemailAttachSound($dto->getVoicemailAttachSound())
            ->setMultiContact($dto->getMultiContact())
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
            ->setRejectCallMethod(self::getRejectCallMethod())
            ->setVoicemailEnabled(self::getVoicemailEnabled())
            ->setVoicemailSendMail(self::getVoicemailSendMail())
            ->setVoicemailAttachSound(self::getVoicemailAttachSound())
            ->setMultiContact(self::getMultiContact())
            ->setGsQRCode(self::getGsQRCode())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setCallAcl(CallAcl::entityToDto(self::getCallAcl(), $depth))
            ->setBossAssistant(User::entityToDto(self::getBossAssistant(), $depth))
            ->setBossAssistantWhiteList(MatchList::entityToDto(self::getBossAssistantWhiteList(), $depth))
            ->setTransformationRuleSet(TransformationRuleSet::entityToDto(self::getTransformationRuleSet(), $depth))
            ->setLanguage(Language::entityToDto(self::getLanguage(), $depth))
            ->setTerminal(Terminal::entityToDto(self::getTerminal(), $depth))
            ->setExtension(Extension::entityToDto(self::getExtension(), $depth))
            ->setTimezone(Timezone::entityToDto(self::getTimezone(), $depth))
            ->setOutgoingDdi(Ddi::entityToDto(self::getOutgoingDdi(), $depth))
            ->setOutgoingDdiRule(OutgoingDdiRule::entityToDto(self::getOutgoingDdiRule(), $depth))
            ->setVoicemailLocution(Locution::entityToDto(self::getVoicemailLocution(), $depth));
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
            'rejectCallMethod' => self::getRejectCallMethod(),
            'voicemailEnabled' => self::getVoicemailEnabled(),
            'voicemailSendMail' => self::getVoicemailSendMail(),
            'voicemailAttachSound' => self::getVoicemailAttachSound(),
            'multiContact' => self::getMultiContact(),
            'gsQRCode' => self::getGsQRCode(),
            'companyId' => self::getCompany()->getId(),
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName(string $name): UserInterface
    {
        Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
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
    protected function setLastname(string $lastname): UserInterface
    {
        Assertion::maxLength($lastname, 100, 'lastname value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname(): string
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
    protected function setEmail(?string $email = null): UserInterface
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
    public function getEmail(): ?string
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
    protected function setPass(?string $pass = null): UserInterface
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
    public function getPass(): ?string
    {
        return $this->pass;
    }

    /**
     * Set doNotDisturb
     *
     * @param bool $doNotDisturb
     *
     * @return static
     */
    protected function setDoNotDisturb(bool $doNotDisturb): UserInterface
    {
        Assertion::between(intval($doNotDisturb), 0, 1, 'doNotDisturb provided "%s" is not a valid boolean value.');
        $doNotDisturb = (bool) $doNotDisturb;

        $this->doNotDisturb = $doNotDisturb;

        return $this;
    }

    /**
     * Get doNotDisturb
     *
     * @return bool
     */
    public function getDoNotDisturb(): bool
    {
        return $this->doNotDisturb;
    }

    /**
     * Set isBoss
     *
     * @param bool $isBoss
     *
     * @return static
     */
    protected function setIsBoss(bool $isBoss): UserInterface
    {
        Assertion::between(intval($isBoss), 0, 1, 'isBoss provided "%s" is not a valid boolean value.');
        $isBoss = (bool) $isBoss;

        $this->isBoss = $isBoss;

        return $this;
    }

    /**
     * Get isBoss
     *
     * @return bool
     */
    public function getIsBoss(): bool
    {
        return $this->isBoss;
    }

    /**
     * Set active
     *
     * @param bool $active
     *
     * @return static
     */
    protected function setActive(bool $active): UserInterface
    {
        Assertion::between(intval($active), 0, 1, 'active provided "%s" is not a valid boolean value.');
        $active = (bool) $active;

        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * Set maxCalls
     *
     * @param int $maxCalls
     *
     * @return static
     */
    protected function setMaxCalls(int $maxCalls): UserInterface
    {
        Assertion::greaterOrEqualThan($maxCalls, 0, 'maxCalls provided "%s" is not greater or equal than "%s".');

        $this->maxCalls = $maxCalls;

        return $this;
    }

    /**
     * Get maxCalls
     *
     * @return int
     */
    public function getMaxCalls(): int
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
    protected function setExternalIpCalls(string $externalIpCalls): UserInterface
    {
        Assertion::maxLength($externalIpCalls, 1, 'externalIpCalls value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $externalIpCalls,
            [
                UserInterface::EXTERNALIPCALLS_0,
                UserInterface::EXTERNALIPCALLS_1,
                UserInterface::EXTERNALIPCALLS_2,
                UserInterface::EXTERNALIPCALLS_3,
            ],
            'externalIpCallsvalue "%s" is not an element of the valid values: %s'
        );

        $this->externalIpCalls = $externalIpCalls;

        return $this;
    }

    /**
     * Get externalIpCalls
     *
     * @return string
     */
    public function getExternalIpCalls(): string
    {
        return $this->externalIpCalls;
    }

    /**
     * Set rejectCallMethod
     *
     * @param string $rejectCallMethod
     *
     * @return static
     */
    protected function setRejectCallMethod($rejectCallMethod)
    {
        Assertion::notNull($rejectCallMethod, 'rejectCallMethod value "%s" is null, but non null value was expected.');
        Assertion::maxLength($rejectCallMethod, 3, 'rejectCallMethod value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($rejectCallMethod, [
            UserInterface::REJECTCALLMETHOD_RFC,
            UserInterface::REJECTCALLMETHOD_486,
            UserInterface::REJECTCALLMETHOD_600
        ], 'rejectCallMethodvalue "%s" is not an element of the valid values: %s');

        $this->rejectCallMethod = $rejectCallMethod;

        return $this;
    }

    /**
     * Get rejectCallMethod
     *
     * @return string
     */
    public function getRejectCallMethod(): string
    {
        return $this->rejectCallMethod;
    }

    /**
     * Set voicemailEnabled
     *
     * @param bool $voicemailEnabled
     *
     * @return static
     */
    protected function setVoicemailEnabled(bool $voicemailEnabled): UserInterface
    {
        Assertion::between(intval($voicemailEnabled), 0, 1, 'voicemailEnabled provided "%s" is not a valid boolean value.');
        $voicemailEnabled = (bool) $voicemailEnabled;

        $this->voicemailEnabled = $voicemailEnabled;

        return $this;
    }

    /**
     * Get voicemailEnabled
     *
     * @return bool
     */
    public function getVoicemailEnabled(): bool
    {
        return $this->voicemailEnabled;
    }

    /**
     * Set voicemailSendMail
     *
     * @param bool $voicemailSendMail
     *
     * @return static
     */
    protected function setVoicemailSendMail(bool $voicemailSendMail): UserInterface
    {
        Assertion::between(intval($voicemailSendMail), 0, 1, 'voicemailSendMail provided "%s" is not a valid boolean value.');
        $voicemailSendMail = (bool) $voicemailSendMail;

        $this->voicemailSendMail = $voicemailSendMail;

        return $this;
    }

    /**
     * Get voicemailSendMail
     *
     * @return bool
     */
    public function getVoicemailSendMail(): bool
    {
        return $this->voicemailSendMail;
    }

    /**
     * Set voicemailAttachSound
     *
     * @param bool $voicemailAttachSound
     *
     * @return static
     */
    protected function setVoicemailAttachSound(bool $voicemailAttachSound): UserInterface
    {
        Assertion::between(intval($voicemailAttachSound), 0, 1, 'voicemailAttachSound provided "%s" is not a valid boolean value.');
        $voicemailAttachSound = (bool) $voicemailAttachSound;

        $this->voicemailAttachSound = $voicemailAttachSound;

        return $this;
    }

    /**
     * Get voicemailAttachSound
     *
     * @return bool
     */
    public function getVoicemailAttachSound(): bool
    {
        return $this->voicemailAttachSound;
    }

    /**
     * Set multiContact
     *
     * @param boolean $multiContact
     *
     * @return static
     */
    protected function setMultiContact($multiContact)
    {
        Assertion::notNull($multiContact, 'multiContact value "%s" is null, but non null value was expected.');
        Assertion::between(intval($multiContact), 0, 1, 'multiContact provided "%s" is not a valid boolean value.');
        $multiContact = (bool) $multiContact;

        $this->multiContact = $multiContact;

        return $this;
    }

    /**
     * Get multiContact
     *
     * @return boolean
     */
    public function getMultiContact(): bool
    {
        return $this->multiContact;
    }

    /**
     * Set gsQRCode
     *
     * @param bool $gsQRCode
     *
     * @return static
     */
    protected function setGsQRCode(bool $gsQRCode): UserInterface
    {
        Assertion::between(intval($gsQRCode), 0, 1, 'gsQRCode provided "%s" is not a valid boolean value.');
        $gsQRCode = (bool) $gsQRCode;

        $this->gsQRCode = $gsQRCode;

        return $this;
    }

    /**
     * Get gsQRCode
     *
     * @return bool
     */
    public function getGsQRCode(): bool
    {
        return $this->gsQRCode;
    }

    /**
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    protected function setCompany(CompanyInterface $company): UserInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

    /**
     * Set callAcl
     *
     * @param CallAclInterface | null
     *
     * @return static
     */
    protected function setCallAcl(?CallAclInterface $callAcl = null): UserInterface
    {
        $this->callAcl = $callAcl;

        return $this;
    }

    /**
     * Get callAcl
     *
     * @return CallAclInterface | null
     */
    public function getCallAcl(): ?CallAclInterface
    {
        return $this->callAcl;
    }

    /**
     * Set bossAssistant
     *
     * @param UserInterface | null
     *
     * @return static
     */
    protected function setBossAssistant(?UserInterface $bossAssistant = null): UserInterface
    {
        $this->bossAssistant = $bossAssistant;

        return $this;
    }

    /**
     * Get bossAssistant
     *
     * @return UserInterface | null
     */
    public function getBossAssistant(): ?UserInterface
    {
        return $this->bossAssistant;
    }

    /**
     * Set bossAssistantWhiteList
     *
     * @param MatchListInterface | null
     *
     * @return static
     */
    protected function setBossAssistantWhiteList(?MatchListInterface $bossAssistantWhiteList = null): UserInterface
    {
        $this->bossAssistantWhiteList = $bossAssistantWhiteList;

        return $this;
    }

    /**
     * Get bossAssistantWhiteList
     *
     * @return MatchListInterface | null
     */
    public function getBossAssistantWhiteList(): ?MatchListInterface
    {
        return $this->bossAssistantWhiteList;
    }

    /**
     * Set transformationRuleSet
     *
     * @param TransformationRuleSetInterface | null
     *
     * @return static
     */
    protected function setTransformationRuleSet(?TransformationRuleSetInterface $transformationRuleSet = null): UserInterface
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * Get transformationRuleSet
     *
     * @return TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet(): ?TransformationRuleSetInterface
    {
        return $this->transformationRuleSet;
    }

    /**
     * Set language
     *
     * @param LanguageInterface | null
     *
     * @return static
     */
    protected function setLanguage(?LanguageInterface $language = null): UserInterface
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return LanguageInterface | null
     */
    public function getLanguage(): ?LanguageInterface
    {
        return $this->language;
    }

    /**
     * Set terminal
     *
     * @param TerminalInterface | null
     *
     * @return static
     */
    public function setTerminal(?TerminalInterface $terminal = null): UserInterface
    {
        $this->terminal = $terminal;

        return $this;
    }

    /**
     * Get terminal
     *
     * @return TerminalInterface | null
     */
    public function getTerminal(): ?TerminalInterface
    {
        return $this->terminal;
    }

    /**
     * Set extension
     *
     * @param ExtensionInterface | null
     *
     * @return static
     */
    public function setExtension(?ExtensionInterface $extension = null): UserInterface
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return ExtensionInterface | null
     */
    public function getExtension(): ?ExtensionInterface
    {
        return $this->extension;
    }

    /**
     * Set timezone
     *
     * @param TimezoneInterface | null
     *
     * @return static
     */
    protected function setTimezone(?TimezoneInterface $timezone = null): UserInterface
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return TimezoneInterface | null
     */
    public function getTimezone(): ?TimezoneInterface
    {
        return $this->timezone;
    }

    /**
     * Set outgoingDdi
     *
     * @param DdiInterface | null
     *
     * @return static
     */
    protected function setOutgoingDdi(?DdiInterface $outgoingDdi = null): UserInterface
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    /**
     * Get outgoingDdi
     *
     * @return DdiInterface | null
     */
    public function getOutgoingDdi(): ?DdiInterface
    {
        return $this->outgoingDdi;
    }

    /**
     * Set outgoingDdiRule
     *
     * @param OutgoingDdiRuleInterface | null
     *
     * @return static
     */
    protected function setOutgoingDdiRule(?OutgoingDdiRuleInterface $outgoingDdiRule = null): UserInterface
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    /**
     * Get outgoingDdiRule
     *
     * @return OutgoingDdiRuleInterface | null
     */
    public function getOutgoingDdiRule(): ?OutgoingDdiRuleInterface
    {
        return $this->outgoingDdiRule;
    }

    /**
     * Set voicemailLocution
     *
     * @param LocutionInterface | null
     *
     * @return static
     */
    protected function setVoicemailLocution(?LocutionInterface $voicemailLocution = null): UserInterface
    {
        $this->voicemailLocution = $voicemailLocution;

        return $this;
    }

    /**
     * Get voicemailLocution
     *
     * @return LocutionInterface | null
     */
    public function getVoicemailLocution(): ?LocutionInterface
    {
        return $this->voicemailLocution;
    }

}
