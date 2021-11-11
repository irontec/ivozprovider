<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\User;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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

    protected $name;

    protected $lastname;

    protected $email;

    /**
     * comment: password
     */
    protected $pass;

    protected $doNotDisturb = false;

    protected $isBoss = false;

    protected $active = false;

    protected $maxCalls = 0;

    /**
     * comment: enum:0|1|2|3
     */
    protected $externalIpCalls = '0';

    /**
     * comment: enum:rfc|486|600
     */
    protected $rejectCallMethod = 'rfc';

    protected $voicemailEnabled = true;

    protected $voicemailSendMail = false;

    protected $voicemailAttachSound = true;

    protected $multiContact = true;

    protected $gsQRCode = false;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var CallAclInterface | null
     */
    protected $callAcl;

    /**
     * @var UserInterface | null
     */
    protected $bossAssistant;

    /**
     * @var MatchListInterface | null
     */
    protected $bossAssistantWhiteList;

    /**
     * @var TransformationRuleSetInterface | null
     */
    protected $transformationRuleSet;

    /**
     * @var LanguageInterface | null
     */
    protected $language;

    /**
     * @var TerminalInterface | null
     * inversedBy users
     */
    protected $terminal;

    /**
     * @var ExtensionInterface | null
     * inversedBy users
     */
    protected $extension;

    /**
     * @var TimezoneInterface | null
     */
    protected $timezone;

    /**
     * @var DdiInterface | null
     */
    protected $outgoingDdi;

    /**
     * @var OutgoingDdiRuleInterface | null
     */
    protected $outgoingDdiRule;

    /**
     * @var LocutionInterface | null
     */
    protected $voicemailLocution;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        string $lastname,
        bool $doNotDisturb,
        bool $isBoss,
        bool $active,
        int $maxCalls,
        string $externalIpCalls,
        string $rejectCallMethod,
        bool $voicemailEnabled,
        bool $voicemailSendMail,
        bool $voicemailAttachSound,
        bool $multiContact,
        bool $gsQRCode
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

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "User",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): UserDto
    {
        return new UserDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|UserInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UserDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UserDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
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
     */
    public function toDto(int $depth = 0): UserDto
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

    protected function __toArray(): array
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
            'callAclId' => self::getCallAcl()?->getId(),
            'bossAssistantId' => self::getBossAssistant()?->getId(),
            'bossAssistantWhiteListId' => self::getBossAssistantWhiteList()?->getId(),
            'transformationRuleSetId' => self::getTransformationRuleSet()?->getId(),
            'languageId' => self::getLanguage()?->getId(),
            'terminalId' => self::getTerminal()?->getId(),
            'extensionId' => self::getExtension()?->getId(),
            'timezoneId' => self::getTimezone()?->getId(),
            'outgoingDdiId' => self::getOutgoingDdi()?->getId(),
            'outgoingDdiRuleId' => self::getOutgoingDdiRule()?->getId(),
            'voicemailLocutionId' => self::getVoicemailLocution()?->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setLastname(string $lastname): static
    {
        Assertion::maxLength($lastname, 100, 'lastname value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->lastname = $lastname;

        return $this;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    protected function setEmail(?string $email = null): static
    {
        if (!is_null($email)) {
            Assertion::maxLength($email, 100, 'email value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->email = $email;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    protected function setPass(?string $pass = null): static
    {
        if (!is_null($pass)) {
            Assertion::maxLength($pass, 80, 'pass value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->pass = $pass;

        return $this;
    }

    public function getPass(): ?string
    {
        return $this->pass;
    }

    protected function setDoNotDisturb(bool $doNotDisturb): static
    {
        $this->doNotDisturb = $doNotDisturb;

        return $this;
    }

    public function getDoNotDisturb(): bool
    {
        return $this->doNotDisturb;
    }

    protected function setIsBoss(bool $isBoss): static
    {
        $this->isBoss = $isBoss;

        return $this;
    }

    public function getIsBoss(): bool
    {
        return $this->isBoss;
    }

    protected function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    protected function setMaxCalls(int $maxCalls): static
    {
        Assertion::greaterOrEqualThan($maxCalls, 0, 'maxCalls provided "%s" is not greater or equal than "%s".');

        $this->maxCalls = $maxCalls;

        return $this;
    }

    public function getMaxCalls(): int
    {
        return $this->maxCalls;
    }

    protected function setExternalIpCalls(string $externalIpCalls): static
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

    public function getExternalIpCalls(): string
    {
        return $this->externalIpCalls;
    }

    protected function setRejectCallMethod(string $rejectCallMethod): static
    {
        Assertion::maxLength($rejectCallMethod, 3, 'rejectCallMethod value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $rejectCallMethod,
            [
                UserInterface::REJECTCALLMETHOD_RFC,
                UserInterface::REJECTCALLMETHOD_486,
                UserInterface::REJECTCALLMETHOD_600,
            ],
            'rejectCallMethodvalue "%s" is not an element of the valid values: %s'
        );

        $this->rejectCallMethod = $rejectCallMethod;

        return $this;
    }

    public function getRejectCallMethod(): string
    {
        return $this->rejectCallMethod;
    }

    protected function setVoicemailEnabled(bool $voicemailEnabled): static
    {
        $this->voicemailEnabled = $voicemailEnabled;

        return $this;
    }

    public function getVoicemailEnabled(): bool
    {
        return $this->voicemailEnabled;
    }

    protected function setVoicemailSendMail(bool $voicemailSendMail): static
    {
        $this->voicemailSendMail = $voicemailSendMail;

        return $this;
    }

    public function getVoicemailSendMail(): bool
    {
        return $this->voicemailSendMail;
    }

    protected function setVoicemailAttachSound(bool $voicemailAttachSound): static
    {
        $this->voicemailAttachSound = $voicemailAttachSound;

        return $this;
    }

    public function getVoicemailAttachSound(): bool
    {
        return $this->voicemailAttachSound;
    }

    protected function setMultiContact(bool $multiContact): static
    {
        $this->multiContact = $multiContact;

        return $this;
    }

    public function getMultiContact(): bool
    {
        return $this->multiContact;
    }

    protected function setGsQRCode(bool $gsQRCode): static
    {
        $this->gsQRCode = $gsQRCode;

        return $this;
    }

    public function getGsQRCode(): bool
    {
        return $this->gsQRCode;
    }

    protected function setCompany(CompanyInterface $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

    protected function setCallAcl(?CallAclInterface $callAcl = null): static
    {
        $this->callAcl = $callAcl;

        return $this;
    }

    public function getCallAcl(): ?CallAclInterface
    {
        return $this->callAcl;
    }

    protected function setBossAssistant(?UserInterface $bossAssistant = null): static
    {
        $this->bossAssistant = $bossAssistant;

        return $this;
    }

    public function getBossAssistant(): ?UserInterface
    {
        return $this->bossAssistant;
    }

    protected function setBossAssistantWhiteList(?MatchListInterface $bossAssistantWhiteList = null): static
    {
        $this->bossAssistantWhiteList = $bossAssistantWhiteList;

        return $this;
    }

    public function getBossAssistantWhiteList(): ?MatchListInterface
    {
        return $this->bossAssistantWhiteList;
    }

    protected function setTransformationRuleSet(?TransformationRuleSetInterface $transformationRuleSet = null): static
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    public function getTransformationRuleSet(): ?TransformationRuleSetInterface
    {
        return $this->transformationRuleSet;
    }

    protected function setLanguage(?LanguageInterface $language = null): static
    {
        $this->language = $language;

        return $this;
    }

    public function getLanguage(): ?LanguageInterface
    {
        return $this->language;
    }

    public function setTerminal(?TerminalInterface $terminal = null): static
    {
        $this->terminal = $terminal;

        return $this;
    }

    public function getTerminal(): ?TerminalInterface
    {
        return $this->terminal;
    }

    public function setExtension(?ExtensionInterface $extension = null): static
    {
        $this->extension = $extension;

        return $this;
    }

    public function getExtension(): ?ExtensionInterface
    {
        return $this->extension;
    }

    protected function setTimezone(?TimezoneInterface $timezone = null): static
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function getTimezone(): ?TimezoneInterface
    {
        return $this->timezone;
    }

    protected function setOutgoingDdi(?DdiInterface $outgoingDdi = null): static
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    public function getOutgoingDdi(): ?DdiInterface
    {
        return $this->outgoingDdi;
    }

    protected function setOutgoingDdiRule(?OutgoingDdiRuleInterface $outgoingDdiRule = null): static
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    public function getOutgoingDdiRule(): ?OutgoingDdiRuleInterface
    {
        return $this->outgoingDdiRule;
    }

    protected function setVoicemailLocution(?LocutionInterface $voicemailLocution = null): static
    {
        $this->voicemailLocution = $voicemailLocution;

        return $this;
    }

    public function getVoicemailLocution(): ?LocutionInterface
    {
        return $this->voicemailLocution;
    }
}
