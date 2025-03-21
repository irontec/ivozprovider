<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Friend;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\ProxyUser\ProxyUserInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet;
use Ivoz\Provider\Domain\Model\CallAcl\CallAcl;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\Language\Language;
use Ivoz\Provider\Domain\Model\ProxyUser\ProxyUser;

/**
* FriendAbstract
* @codeCoverageIgnore
*/
abstract class FriendAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var ?string
     * comment: enum:udp|tcp|tls
     */
    protected $transport = null;

    /**
     * @var ?string
     */
    protected $ip = null;

    /**
     * @var ?int
     */
    protected $port = null;

    /**
     * @var ?string
     */
    protected $password = null;

    /**
     * @var int
     */
    protected $priority = 1;

    /**
     * @var string
     */
    protected $disallow = 'all';

    /**
     * @var string
     */
    protected $allow = 'alaw';

    /**
     * @var string
     * column: direct_media_method
     * comment: enum:invite|update
     */
    protected $directMediaMethod = 'update';

    /**
     * @var string
     * column: callerid_update_header
     * comment: enum:pai|rpid
     */
    protected $calleridUpdateHeader = 'pai';

    /**
     * @var string
     * column: update_callerid
     * comment: enum:yes|no
     */
    protected $updateCallerid = 'yes';

    /**
     * @var ?string
     * column: from_user
     */
    protected $fromUser = null;

    /**
     * @var ?string
     * column: from_domain
     */
    protected $fromDomain = null;

    /**
     * @var string
     * comment: enum:yes|no|intervpbx
     */
    protected $directConnectivity = 'yes';

    /**
     * @var string
     * comment: enum:yes|no
     */
    protected $ddiIn = 'yes';

    /**
     * @var string
     * comment: enum:yes|no
     */
    protected $t38Passthrough = 'no';

    /**
     * @var bool
     */
    protected $alwaysApplyTransformations = false;

    /**
     * @var bool
     */
    protected $rtpEncryption = false;

    /**
     * @var bool
     */
    protected $multiContact = true;

    /**
     * @var ?string
     * column: ruri_domain
     */
    protected $ruriDomain = null;

    /**
     * @var bool
     */
    protected $trustSDP = false;

    /**
     * @var CompanyInterface
     * inversedBy friends
     */
    protected $company;

    /**
     * @var ?DomainInterface
     * inversedBy friends
     */
    protected $domain = null;

    /**
     * @var ?TransformationRuleSetInterface
     */
    protected $transformationRuleSet = null;

    /**
     * @var ?CallAclInterface
     */
    protected $callAcl = null;

    /**
     * @var ?DdiInterface
     */
    protected $outgoingDdi = null;

    /**
     * @var ?LanguageInterface
     */
    protected $language = null;

    /**
     * @var ?CompanyInterface
     */
    protected $interCompany = null;

    /**
     * @var ?ProxyUserInterface
     */
    protected $proxyUser = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        string $description,
        int $priority,
        string $disallow,
        string $allow,
        string $directMediaMethod,
        string $calleridUpdateHeader,
        string $updateCallerid,
        string $directConnectivity,
        string $ddiIn,
        string $t38Passthrough,
        bool $alwaysApplyTransformations,
        bool $rtpEncryption,
        bool $multiContact,
        bool $trustSDP
    ) {
        $this->setName($name);
        $this->setDescription($description);
        $this->setPriority($priority);
        $this->setDisallow($disallow);
        $this->setAllow($allow);
        $this->setDirectMediaMethod($directMediaMethod);
        $this->setCalleridUpdateHeader($calleridUpdateHeader);
        $this->setUpdateCallerid($updateCallerid);
        $this->setDirectConnectivity($directConnectivity);
        $this->setDdiIn($ddiIn);
        $this->setT38Passthrough($t38Passthrough);
        $this->setAlwaysApplyTransformations($alwaysApplyTransformations);
        $this->setRtpEncryption($rtpEncryption);
        $this->setMultiContact($multiContact);
        $this->setTrustSDP($trustSDP);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Friend",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): FriendDto
    {
        return new FriendDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|FriendInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?FriendDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, FriendInterface::class);

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
     * @param FriendDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, FriendDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $description = $dto->getDescription();
        Assertion::notNull($description, 'getDescription value is null, but non null value was expected.');
        $priority = $dto->getPriority();
        Assertion::notNull($priority, 'getPriority value is null, but non null value was expected.');
        $disallow = $dto->getDisallow();
        Assertion::notNull($disallow, 'getDisallow value is null, but non null value was expected.');
        $allow = $dto->getAllow();
        Assertion::notNull($allow, 'getAllow value is null, but non null value was expected.');
        $directMediaMethod = $dto->getDirectMediaMethod();
        Assertion::notNull($directMediaMethod, 'getDirectMediaMethod value is null, but non null value was expected.');
        $calleridUpdateHeader = $dto->getCalleridUpdateHeader();
        Assertion::notNull($calleridUpdateHeader, 'getCalleridUpdateHeader value is null, but non null value was expected.');
        $updateCallerid = $dto->getUpdateCallerid();
        Assertion::notNull($updateCallerid, 'getUpdateCallerid value is null, but non null value was expected.');
        $directConnectivity = $dto->getDirectConnectivity();
        Assertion::notNull($directConnectivity, 'getDirectConnectivity value is null, but non null value was expected.');
        $ddiIn = $dto->getDdiIn();
        Assertion::notNull($ddiIn, 'getDdiIn value is null, but non null value was expected.');
        $t38Passthrough = $dto->getT38Passthrough();
        Assertion::notNull($t38Passthrough, 'getT38Passthrough value is null, but non null value was expected.');
        $alwaysApplyTransformations = $dto->getAlwaysApplyTransformations();
        Assertion::notNull($alwaysApplyTransformations, 'getAlwaysApplyTransformations value is null, but non null value was expected.');
        $rtpEncryption = $dto->getRtpEncryption();
        Assertion::notNull($rtpEncryption, 'getRtpEncryption value is null, but non null value was expected.');
        $multiContact = $dto->getMultiContact();
        Assertion::notNull($multiContact, 'getMultiContact value is null, but non null value was expected.');
        $trustSDP = $dto->getTrustSDP();
        Assertion::notNull($trustSDP, 'getTrustSDP value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $self = new static(
            $name,
            $description,
            $priority,
            $disallow,
            $allow,
            $directMediaMethod,
            $calleridUpdateHeader,
            $updateCallerid,
            $directConnectivity,
            $ddiIn,
            $t38Passthrough,
            $alwaysApplyTransformations,
            $rtpEncryption,
            $multiContact,
            $trustSDP
        );

        $self
            ->setTransport($dto->getTransport())
            ->setIp($dto->getIp())
            ->setPort($dto->getPort())
            ->setPassword($dto->getPassword())
            ->setFromUser($dto->getFromUser())
            ->setFromDomain($dto->getFromDomain())
            ->setRuriDomain($dto->getRuriDomain())
            ->setCompany($fkTransformer->transform($company))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setCallAcl($fkTransformer->transform($dto->getCallAcl()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()))
            ->setInterCompany($fkTransformer->transform($dto->getInterCompany()))
            ->setProxyUser($fkTransformer->transform($dto->getProxyUser()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param FriendDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, FriendDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $description = $dto->getDescription();
        Assertion::notNull($description, 'getDescription value is null, but non null value was expected.');
        $priority = $dto->getPriority();
        Assertion::notNull($priority, 'getPriority value is null, but non null value was expected.');
        $disallow = $dto->getDisallow();
        Assertion::notNull($disallow, 'getDisallow value is null, but non null value was expected.');
        $allow = $dto->getAllow();
        Assertion::notNull($allow, 'getAllow value is null, but non null value was expected.');
        $directMediaMethod = $dto->getDirectMediaMethod();
        Assertion::notNull($directMediaMethod, 'getDirectMediaMethod value is null, but non null value was expected.');
        $calleridUpdateHeader = $dto->getCalleridUpdateHeader();
        Assertion::notNull($calleridUpdateHeader, 'getCalleridUpdateHeader value is null, but non null value was expected.');
        $updateCallerid = $dto->getUpdateCallerid();
        Assertion::notNull($updateCallerid, 'getUpdateCallerid value is null, but non null value was expected.');
        $directConnectivity = $dto->getDirectConnectivity();
        Assertion::notNull($directConnectivity, 'getDirectConnectivity value is null, but non null value was expected.');
        $ddiIn = $dto->getDdiIn();
        Assertion::notNull($ddiIn, 'getDdiIn value is null, but non null value was expected.');
        $t38Passthrough = $dto->getT38Passthrough();
        Assertion::notNull($t38Passthrough, 'getT38Passthrough value is null, but non null value was expected.');
        $alwaysApplyTransformations = $dto->getAlwaysApplyTransformations();
        Assertion::notNull($alwaysApplyTransformations, 'getAlwaysApplyTransformations value is null, but non null value was expected.');
        $rtpEncryption = $dto->getRtpEncryption();
        Assertion::notNull($rtpEncryption, 'getRtpEncryption value is null, but non null value was expected.');
        $multiContact = $dto->getMultiContact();
        Assertion::notNull($multiContact, 'getMultiContact value is null, but non null value was expected.');
        $trustSDP = $dto->getTrustSDP();
        Assertion::notNull($trustSDP, 'getTrustSDP value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setDescription($description)
            ->setTransport($dto->getTransport())
            ->setIp($dto->getIp())
            ->setPort($dto->getPort())
            ->setPassword($dto->getPassword())
            ->setPriority($priority)
            ->setDisallow($disallow)
            ->setAllow($allow)
            ->setDirectMediaMethod($directMediaMethod)
            ->setCalleridUpdateHeader($calleridUpdateHeader)
            ->setUpdateCallerid($updateCallerid)
            ->setFromUser($dto->getFromUser())
            ->setFromDomain($dto->getFromDomain())
            ->setDirectConnectivity($directConnectivity)
            ->setDdiIn($ddiIn)
            ->setT38Passthrough($t38Passthrough)
            ->setAlwaysApplyTransformations($alwaysApplyTransformations)
            ->setRtpEncryption($rtpEncryption)
            ->setMultiContact($multiContact)
            ->setRuriDomain($dto->getRuriDomain())
            ->setTrustSDP($trustSDP)
            ->setCompany($fkTransformer->transform($company))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setCallAcl($fkTransformer->transform($dto->getCallAcl()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()))
            ->setInterCompany($fkTransformer->transform($dto->getInterCompany()))
            ->setProxyUser($fkTransformer->transform($dto->getProxyUser()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): FriendDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDescription(self::getDescription())
            ->setTransport(self::getTransport())
            ->setIp(self::getIp())
            ->setPort(self::getPort())
            ->setPassword(self::getPassword())
            ->setPriority(self::getPriority())
            ->setDisallow(self::getDisallow())
            ->setAllow(self::getAllow())
            ->setDirectMediaMethod(self::getDirectMediaMethod())
            ->setCalleridUpdateHeader(self::getCalleridUpdateHeader())
            ->setUpdateCallerid(self::getUpdateCallerid())
            ->setFromUser(self::getFromUser())
            ->setFromDomain(self::getFromDomain())
            ->setDirectConnectivity(self::getDirectConnectivity())
            ->setDdiIn(self::getDdiIn())
            ->setT38Passthrough(self::getT38Passthrough())
            ->setAlwaysApplyTransformations(self::getAlwaysApplyTransformations())
            ->setRtpEncryption(self::getRtpEncryption())
            ->setMultiContact(self::getMultiContact())
            ->setRuriDomain(self::getRuriDomain())
            ->setTrustSDP(self::getTrustSDP())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setDomain(Domain::entityToDto(self::getDomain(), $depth))
            ->setTransformationRuleSet(TransformationRuleSet::entityToDto(self::getTransformationRuleSet(), $depth))
            ->setCallAcl(CallAcl::entityToDto(self::getCallAcl(), $depth))
            ->setOutgoingDdi(Ddi::entityToDto(self::getOutgoingDdi(), $depth))
            ->setLanguage(Language::entityToDto(self::getLanguage(), $depth))
            ->setInterCompany(Company::entityToDto(self::getInterCompany(), $depth))
            ->setProxyUser(ProxyUser::entityToDto(self::getProxyUser(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'description' => self::getDescription(),
            'transport' => self::getTransport(),
            'ip' => self::getIp(),
            'port' => self::getPort(),
            'password' => self::getPassword(),
            'priority' => self::getPriority(),
            'disallow' => self::getDisallow(),
            'allow' => self::getAllow(),
            'direct_media_method' => self::getDirectMediaMethod(),
            'callerid_update_header' => self::getCalleridUpdateHeader(),
            'update_callerid' => self::getUpdateCallerid(),
            'from_user' => self::getFromUser(),
            'from_domain' => self::getFromDomain(),
            'directConnectivity' => self::getDirectConnectivity(),
            'ddiIn' => self::getDdiIn(),
            't38Passthrough' => self::getT38Passthrough(),
            'alwaysApplyTransformations' => self::getAlwaysApplyTransformations(),
            'rtpEncryption' => self::getRtpEncryption(),
            'multiContact' => self::getMultiContact(),
            'ruri_domain' => self::getRuriDomain(),
            'trustSDP' => self::getTrustSDP(),
            'companyId' => self::getCompany()->getId(),
            'domainId' => self::getDomain()?->getId(),
            'transformationRuleSetId' => self::getTransformationRuleSet()?->getId(),
            'callAclId' => self::getCallAcl()?->getId(),
            'outgoingDdiId' => self::getOutgoingDdi()?->getId(),
            'languageId' => self::getLanguage()?->getId(),
            'interCompanyId' => self::getInterCompany()?->getId(),
            'proxyUserId' => self::getProxyUser()?->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 65, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setDescription(string $description): static
    {
        Assertion::maxLength($description, 500, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->description = $description;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    protected function setTransport(?string $transport = null): static
    {
        if (!is_null($transport)) {
            Assertion::maxLength($transport, 25, 'transport value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $transport,
                [
                    FriendInterface::TRANSPORT_UDP,
                    FriendInterface::TRANSPORT_TCP,
                    FriendInterface::TRANSPORT_TLS,
                ],
                'transportvalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->transport = $transport;

        return $this;
    }

    public function getTransport(): ?string
    {
        return $this->transport;
    }

    protected function setIp(?string $ip = null): static
    {
        if (!is_null($ip)) {
            Assertion::maxLength($ip, 50, 'ip value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ip = $ip;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    protected function setPort(?int $port = null): static
    {
        if (!is_null($port)) {
            Assertion::greaterOrEqualThan($port, 0, 'port provided "%s" is not greater or equal than "%s".');
        }

        $this->port = $port;

        return $this;
    }

    public function getPort(): ?int
    {
        return $this->port;
    }

    protected function setPassword(?string $password = null): static
    {
        if (!is_null($password)) {
            Assertion::maxLength($password, 64, 'password value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->password = $password;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    protected function setPriority(int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    protected function setDisallow(string $disallow): static
    {
        Assertion::maxLength($disallow, 200, 'disallow value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->disallow = $disallow;

        return $this;
    }

    public function getDisallow(): string
    {
        return $this->disallow;
    }

    protected function setAllow(string $allow): static
    {
        Assertion::maxLength($allow, 200, 'allow value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->allow = $allow;

        return $this;
    }

    public function getAllow(): string
    {
        return $this->allow;
    }

    protected function setDirectMediaMethod(string $directMediaMethod): static
    {
        Assertion::maxLength($directMediaMethod, 25, 'directMediaMethod value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $directMediaMethod,
            [
                FriendInterface::DIRECTMEDIAMETHOD_INVITE,
                FriendInterface::DIRECTMEDIAMETHOD_UPDATE,
            ],
            'directMediaMethodvalue "%s" is not an element of the valid values: %s'
        );

        $this->directMediaMethod = $directMediaMethod;

        return $this;
    }

    public function getDirectMediaMethod(): string
    {
        return $this->directMediaMethod;
    }

    protected function setCalleridUpdateHeader(string $calleridUpdateHeader): static
    {
        Assertion::maxLength($calleridUpdateHeader, 10, 'calleridUpdateHeader value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $calleridUpdateHeader,
            [
                FriendInterface::CALLERIDUPDATEHEADER_PAI,
                FriendInterface::CALLERIDUPDATEHEADER_RPID,
            ],
            'calleridUpdateHeadervalue "%s" is not an element of the valid values: %s'
        );

        $this->calleridUpdateHeader = $calleridUpdateHeader;

        return $this;
    }

    public function getCalleridUpdateHeader(): string
    {
        return $this->calleridUpdateHeader;
    }

    protected function setUpdateCallerid(string $updateCallerid): static
    {
        Assertion::maxLength($updateCallerid, 10, 'updateCallerid value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $updateCallerid,
            [
                FriendInterface::UPDATECALLERID_YES,
                FriendInterface::UPDATECALLERID_NO,
            ],
            'updateCalleridvalue "%s" is not an element of the valid values: %s'
        );

        $this->updateCallerid = $updateCallerid;

        return $this;
    }

    public function getUpdateCallerid(): string
    {
        return $this->updateCallerid;
    }

    protected function setFromUser(?string $fromUser = null): static
    {
        if (!is_null($fromUser)) {
            Assertion::maxLength($fromUser, 190, 'fromUser value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fromUser = $fromUser;

        return $this;
    }

    public function getFromUser(): ?string
    {
        return $this->fromUser;
    }

    protected function setFromDomain(?string $fromDomain = null): static
    {
        if (!is_null($fromDomain)) {
            Assertion::maxLength($fromDomain, 190, 'fromDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fromDomain = $fromDomain;

        return $this;
    }

    public function getFromDomain(): ?string
    {
        return $this->fromDomain;
    }

    protected function setDirectConnectivity(string $directConnectivity): static
    {
        Assertion::maxLength($directConnectivity, 20, 'directConnectivity value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $directConnectivity,
            [
                FriendInterface::DIRECTCONNECTIVITY_YES,
                FriendInterface::DIRECTCONNECTIVITY_NO,
                FriendInterface::DIRECTCONNECTIVITY_INTERVPBX,
            ],
            'directConnectivityvalue "%s" is not an element of the valid values: %s'
        );

        $this->directConnectivity = $directConnectivity;

        return $this;
    }

    public function getDirectConnectivity(): string
    {
        return $this->directConnectivity;
    }

    protected function setDdiIn(string $ddiIn): static
    {
        Assertion::choice(
            $ddiIn,
            [
                FriendInterface::DDIIN_YES,
                FriendInterface::DDIIN_NO,
            ],
            'ddiInvalue "%s" is not an element of the valid values: %s'
        );

        $this->ddiIn = $ddiIn;

        return $this;
    }

    public function getDdiIn(): string
    {
        return $this->ddiIn;
    }

    protected function setT38Passthrough(string $t38Passthrough): static
    {
        Assertion::choice(
            $t38Passthrough,
            [
                FriendInterface::T38PASSTHROUGH_YES,
                FriendInterface::T38PASSTHROUGH_NO,
            ],
            't38Passthroughvalue "%s" is not an element of the valid values: %s'
        );

        $this->t38Passthrough = $t38Passthrough;

        return $this;
    }

    public function getT38Passthrough(): string
    {
        return $this->t38Passthrough;
    }

    protected function setAlwaysApplyTransformations(bool $alwaysApplyTransformations): static
    {
        $this->alwaysApplyTransformations = $alwaysApplyTransformations;

        return $this;
    }

    public function getAlwaysApplyTransformations(): bool
    {
        return $this->alwaysApplyTransformations;
    }

    protected function setRtpEncryption(bool $rtpEncryption): static
    {
        $this->rtpEncryption = $rtpEncryption;

        return $this;
    }

    public function getRtpEncryption(): bool
    {
        return $this->rtpEncryption;
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

    protected function setRuriDomain(?string $ruriDomain = null): static
    {
        if (!is_null($ruriDomain)) {
            Assertion::maxLength($ruriDomain, 190, 'ruriDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ruriDomain = $ruriDomain;

        return $this;
    }

    public function getRuriDomain(): ?string
    {
        return $this->ruriDomain;
    }

    protected function setTrustSDP(bool $trustSDP): static
    {
        $this->trustSDP = $trustSDP;

        return $this;
    }

    public function getTrustSDP(): bool
    {
        return $this->trustSDP;
    }

    public function setCompany(CompanyInterface $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

    public function setDomain(?DomainInterface $domain = null): static
    {
        $this->domain = $domain;

        return $this;
    }

    public function getDomain(): ?DomainInterface
    {
        return $this->domain;
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

    protected function setCallAcl(?CallAclInterface $callAcl = null): static
    {
        $this->callAcl = $callAcl;

        return $this;
    }

    public function getCallAcl(): ?CallAclInterface
    {
        return $this->callAcl;
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

    protected function setLanguage(?LanguageInterface $language = null): static
    {
        $this->language = $language;

        return $this;
    }

    public function getLanguage(): ?LanguageInterface
    {
        return $this->language;
    }

    protected function setInterCompany(?CompanyInterface $interCompany = null): static
    {
        $this->interCompany = $interCompany;

        return $this;
    }

    public function getInterCompany(): ?CompanyInterface
    {
        return $this->interCompany;
    }

    protected function setProxyUser(?ProxyUserInterface $proxyUser = null): static
    {
        $this->proxyUser = $proxyUser;

        return $this;
    }

    public function getProxyUser(): ?ProxyUserInterface
    {
        return $this->proxyUser;
    }
}
