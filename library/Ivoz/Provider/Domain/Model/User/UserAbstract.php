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
     * @var ?string
     */
    protected $email = null;

    /**
     * @var ?string
     * comment: password
     */
    protected $pass = null;

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
     * @var string
     * comment: enum:0|1|2|3
     */
    protected $externalIpCalls = '0';

    /**
     * @var string
     * comment: enum:rfc|486|600
     */
    protected $rejectCallMethod = 'rfc';

    /**
     * @var bool
     */
    protected $multiContact = true;

    /**
     * @var bool
     */
    protected $gsQRCode = false;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var ?CallAclInterface
     */
    protected $callAcl = null;

    /**
     * @var ?UserInterface
     */
    protected $bossAssistant = null;

    /**
     * @var ?MatchListInterface
     */
    protected $bossAssistantWhiteList = null;

    /**
     * @var ?TransformationRuleSetInterface
     */
    protected $transformationRuleSet = null;

    /**
     * @var ?LanguageInterface
     */
    protected $language = null;

    /**
     * @var ?TerminalInterface
     * inversedBy users
     */
    protected $terminal = null;

    /**
     * @var ?ExtensionInterface
     * inversedBy users
     */
    protected $extension = null;

    /**
     * @var ?TimezoneInterface
     */
    protected $timezone = null;

    /**
     * @var ?DdiInterface
     */
    protected $outgoingDdi = null;

    /**
     * @var ?OutgoingDdiRuleInterface
     */
    protected $outgoingDdiRule = null;

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
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $lastname = $dto->getLastname();
        Assertion::notNull($lastname, 'getLastname value is null, but non null value was expected.');
        $doNotDisturb = $dto->getDoNotDisturb();
        Assertion::notNull($doNotDisturb, 'getDoNotDisturb value is null, but non null value was expected.');
        $isBoss = $dto->getIsBoss();
        Assertion::notNull($isBoss, 'getIsBoss value is null, but non null value was expected.');
        $active = $dto->getActive();
        Assertion::notNull($active, 'getActive value is null, but non null value was expected.');
        $maxCalls = $dto->getMaxCalls();
        Assertion::notNull($maxCalls, 'getMaxCalls value is null, but non null value was expected.');
        $externalIpCalls = $dto->getExternalIpCalls();
        Assertion::notNull($externalIpCalls, 'getExternalIpCalls value is null, but non null value was expected.');
        $rejectCallMethod = $dto->getRejectCallMethod();
        Assertion::notNull($rejectCallMethod, 'getRejectCallMethod value is null, but non null value was expected.');
        $multiContact = $dto->getMultiContact();
        Assertion::notNull($multiContact, 'getMultiContact value is null, but non null value was expected.');
        $gsQRCode = $dto->getGsQRCode();
        Assertion::notNull($gsQRCode, 'getGsQRCode value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $self = new static(
            $name,
            $lastname,
            $doNotDisturb,
            $isBoss,
            $active,
            $maxCalls,
            $externalIpCalls,
            $rejectCallMethod,
            $multiContact,
            $gsQRCode
        );

        $self
            ->setEmail($dto->getEmail())
            ->setPass($dto->getPass())
            ->setCompany($fkTransformer->transform($company))
            ->setCallAcl($fkTransformer->transform($dto->getCallAcl()))
            ->setBossAssistant($fkTransformer->transform($dto->getBossAssistant()))
            ->setBossAssistantWhiteList($fkTransformer->transform($dto->getBossAssistantWhiteList()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()))
            ->setTerminal($fkTransformer->transform($dto->getTerminal()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setTimezone($fkTransformer->transform($dto->getTimezone()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
            ->setOutgoingDdiRule($fkTransformer->transform($dto->getOutgoingDdiRule()));

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

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $lastname = $dto->getLastname();
        Assertion::notNull($lastname, 'getLastname value is null, but non null value was expected.');
        $doNotDisturb = $dto->getDoNotDisturb();
        Assertion::notNull($doNotDisturb, 'getDoNotDisturb value is null, but non null value was expected.');
        $isBoss = $dto->getIsBoss();
        Assertion::notNull($isBoss, 'getIsBoss value is null, but non null value was expected.');
        $active = $dto->getActive();
        Assertion::notNull($active, 'getActive value is null, but non null value was expected.');
        $maxCalls = $dto->getMaxCalls();
        Assertion::notNull($maxCalls, 'getMaxCalls value is null, but non null value was expected.');
        $externalIpCalls = $dto->getExternalIpCalls();
        Assertion::notNull($externalIpCalls, 'getExternalIpCalls value is null, but non null value was expected.');
        $rejectCallMethod = $dto->getRejectCallMethod();
        Assertion::notNull($rejectCallMethod, 'getRejectCallMethod value is null, but non null value was expected.');
        $multiContact = $dto->getMultiContact();
        Assertion::notNull($multiContact, 'getMultiContact value is null, but non null value was expected.');
        $gsQRCode = $dto->getGsQRCode();
        Assertion::notNull($gsQRCode, 'getGsQRCode value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setLastname($lastname)
            ->setEmail($dto->getEmail())
            ->setPass($dto->getPass())
            ->setDoNotDisturb($doNotDisturb)
            ->setIsBoss($isBoss)
            ->setActive($active)
            ->setMaxCalls($maxCalls)
            ->setExternalIpCalls($externalIpCalls)
            ->setRejectCallMethod($rejectCallMethod)
            ->setMultiContact($multiContact)
            ->setGsQRCode($gsQRCode)
            ->setCompany($fkTransformer->transform($company))
            ->setCallAcl($fkTransformer->transform($dto->getCallAcl()))
            ->setBossAssistant($fkTransformer->transform($dto->getBossAssistant()))
            ->setBossAssistantWhiteList($fkTransformer->transform($dto->getBossAssistantWhiteList()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()))
            ->setTerminal($fkTransformer->transform($dto->getTerminal()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setTimezone($fkTransformer->transform($dto->getTimezone()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
            ->setOutgoingDdiRule($fkTransformer->transform($dto->getOutgoingDdiRule()));

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
            ->setOutgoingDdiRule(OutgoingDdiRule::entityToDto(self::getOutgoingDdiRule(), $depth));
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
            'outgoingDdiRuleId' => self::getOutgoingDdiRule()?->getId()
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
}
