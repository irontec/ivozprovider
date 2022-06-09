<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ResidentialDevice;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\Language\Language;

/**
* ResidentialDeviceAbstract
* @codeCoverageIgnore
*/
abstract class ResidentialDeviceAbstract
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
     * @var string
     * column: auth_needed
     */
    protected $authNeeded = 'yes';

    /**
     * @var ?string
     */
    protected $password = null;

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
     * column: from_domain
     */
    protected $fromDomain = null;

    /**
     * @var string
     * comment: enum:yes|no
     */
    protected $directConnectivity = 'yes';

    /**
     * @var string
     * comment: enum:yes|no
     */
    protected $ddiIn = 'yes';

    /**
     * @var int
     */
    protected $maxCalls = 1;

    /**
     * @var string
     * comment: enum:yes|no
     */
    protected $t38Passthrough = 'no';

    /**
     * @var bool
     */
    protected $rtpEncryption = false;

    /**
     * @var bool
     */
    protected $multiContact = true;

    /**
     * @var BrandInterface
     * inversedBy residentialDevices
     */
    protected $brand;

    /**
     * @var ?DomainInterface
     * inversedBy residentialDevices
     */
    protected $domain = null;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var ?TransformationRuleSetInterface
     */
    protected $transformationRuleSet = null;

    /**
     * @var ?DdiInterface
     */
    protected $outgoingDdi = null;

    /**
     * @var ?LanguageInterface
     */
    protected $language = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        string $description,
        string $authNeeded,
        string $disallow,
        string $allow,
        string $directMediaMethod,
        string $calleridUpdateHeader,
        string $updateCallerid,
        string $directConnectivity,
        string $ddiIn,
        int $maxCalls,
        string $t38Passthrough,
        bool $rtpEncryption,
        bool $multiContact
    ) {
        $this->setName($name);
        $this->setDescription($description);
        $this->setAuthNeeded($authNeeded);
        $this->setDisallow($disallow);
        $this->setAllow($allow);
        $this->setDirectMediaMethod($directMediaMethod);
        $this->setCalleridUpdateHeader($calleridUpdateHeader);
        $this->setUpdateCallerid($updateCallerid);
        $this->setDirectConnectivity($directConnectivity);
        $this->setDdiIn($ddiIn);
        $this->setMaxCalls($maxCalls);
        $this->setT38Passthrough($t38Passthrough);
        $this->setRtpEncryption($rtpEncryption);
        $this->setMultiContact($multiContact);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "ResidentialDevice",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): ResidentialDeviceDto
    {
        return new ResidentialDeviceDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ResidentialDeviceInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ResidentialDeviceDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ResidentialDeviceInterface::class);

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
     * @param ResidentialDeviceDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ResidentialDeviceDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $description = $dto->getDescription();
        Assertion::notNull($description, 'getDescription value is null, but non null value was expected.');
        $authNeeded = $dto->getAuthNeeded();
        Assertion::notNull($authNeeded, 'getAuthNeeded value is null, but non null value was expected.');
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
        $maxCalls = $dto->getMaxCalls();
        Assertion::notNull($maxCalls, 'getMaxCalls value is null, but non null value was expected.');
        $t38Passthrough = $dto->getT38Passthrough();
        Assertion::notNull($t38Passthrough, 'getT38Passthrough value is null, but non null value was expected.');
        $rtpEncryption = $dto->getRtpEncryption();
        Assertion::notNull($rtpEncryption, 'getRtpEncryption value is null, but non null value was expected.');
        $multiContact = $dto->getMultiContact();
        Assertion::notNull($multiContact, 'getMultiContact value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $self = new static(
            $name,
            $description,
            $authNeeded,
            $disallow,
            $allow,
            $directMediaMethod,
            $calleridUpdateHeader,
            $updateCallerid,
            $directConnectivity,
            $ddiIn,
            $maxCalls,
            $t38Passthrough,
            $rtpEncryption,
            $multiContact
        );

        $self
            ->setTransport($dto->getTransport())
            ->setIp($dto->getIp())
            ->setPort($dto->getPort())
            ->setPassword($dto->getPassword())
            ->setFromDomain($dto->getFromDomain())
            ->setBrand($fkTransformer->transform($brand))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setCompany($fkTransformer->transform($company))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ResidentialDeviceDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ResidentialDeviceDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $description = $dto->getDescription();
        Assertion::notNull($description, 'getDescription value is null, but non null value was expected.');
        $authNeeded = $dto->getAuthNeeded();
        Assertion::notNull($authNeeded, 'getAuthNeeded value is null, but non null value was expected.');
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
        $maxCalls = $dto->getMaxCalls();
        Assertion::notNull($maxCalls, 'getMaxCalls value is null, but non null value was expected.');
        $t38Passthrough = $dto->getT38Passthrough();
        Assertion::notNull($t38Passthrough, 'getT38Passthrough value is null, but non null value was expected.');
        $rtpEncryption = $dto->getRtpEncryption();
        Assertion::notNull($rtpEncryption, 'getRtpEncryption value is null, but non null value was expected.');
        $multiContact = $dto->getMultiContact();
        Assertion::notNull($multiContact, 'getMultiContact value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setDescription($description)
            ->setTransport($dto->getTransport())
            ->setIp($dto->getIp())
            ->setPort($dto->getPort())
            ->setAuthNeeded($authNeeded)
            ->setPassword($dto->getPassword())
            ->setDisallow($disallow)
            ->setAllow($allow)
            ->setDirectMediaMethod($directMediaMethod)
            ->setCalleridUpdateHeader($calleridUpdateHeader)
            ->setUpdateCallerid($updateCallerid)
            ->setFromDomain($dto->getFromDomain())
            ->setDirectConnectivity($directConnectivity)
            ->setDdiIn($ddiIn)
            ->setMaxCalls($maxCalls)
            ->setT38Passthrough($t38Passthrough)
            ->setRtpEncryption($rtpEncryption)
            ->setMultiContact($multiContact)
            ->setBrand($fkTransformer->transform($brand))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setCompany($fkTransformer->transform($company))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ResidentialDeviceDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDescription(self::getDescription())
            ->setTransport(self::getTransport())
            ->setIp(self::getIp())
            ->setPort(self::getPort())
            ->setAuthNeeded(self::getAuthNeeded())
            ->setPassword(self::getPassword())
            ->setDisallow(self::getDisallow())
            ->setAllow(self::getAllow())
            ->setDirectMediaMethod(self::getDirectMediaMethod())
            ->setCalleridUpdateHeader(self::getCalleridUpdateHeader())
            ->setUpdateCallerid(self::getUpdateCallerid())
            ->setFromDomain(self::getFromDomain())
            ->setDirectConnectivity(self::getDirectConnectivity())
            ->setDdiIn(self::getDdiIn())
            ->setMaxCalls(self::getMaxCalls())
            ->setT38Passthrough(self::getT38Passthrough())
            ->setRtpEncryption(self::getRtpEncryption())
            ->setMultiContact(self::getMultiContact())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setDomain(Domain::entityToDto(self::getDomain(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setTransformationRuleSet(TransformationRuleSet::entityToDto(self::getTransformationRuleSet(), $depth))
            ->setOutgoingDdi(Ddi::entityToDto(self::getOutgoingDdi(), $depth))
            ->setLanguage(Language::entityToDto(self::getLanguage(), $depth));
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
            'auth_needed' => self::getAuthNeeded(),
            'password' => self::getPassword(),
            'disallow' => self::getDisallow(),
            'allow' => self::getAllow(),
            'direct_media_method' => self::getDirectMediaMethod(),
            'callerid_update_header' => self::getCalleridUpdateHeader(),
            'update_callerid' => self::getUpdateCallerid(),
            'from_domain' => self::getFromDomain(),
            'directConnectivity' => self::getDirectConnectivity(),
            'ddiIn' => self::getDdiIn(),
            'maxCalls' => self::getMaxCalls(),
            't38Passthrough' => self::getT38Passthrough(),
            'rtpEncryption' => self::getRtpEncryption(),
            'multiContact' => self::getMultiContact(),
            'brandId' => self::getBrand()->getId(),
            'domainId' => self::getDomain()?->getId(),
            'companyId' => self::getCompany()->getId(),
            'transformationRuleSetId' => self::getTransformationRuleSet()?->getId(),
            'outgoingDdiId' => self::getOutgoingDdi()?->getId(),
            'languageId' => self::getLanguage()?->getId()
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
                    ResidentialDeviceInterface::TRANSPORT_UDP,
                    ResidentialDeviceInterface::TRANSPORT_TCP,
                    ResidentialDeviceInterface::TRANSPORT_TLS,
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

    protected function setAuthNeeded(string $authNeeded): static
    {
        $this->authNeeded = $authNeeded;

        return $this;
    }

    public function getAuthNeeded(): string
    {
        return $this->authNeeded;
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
        Assertion::choice(
            $directMediaMethod,
            [
                ResidentialDeviceInterface::DIRECTMEDIAMETHOD_INVITE,
                ResidentialDeviceInterface::DIRECTMEDIAMETHOD_UPDATE,
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
        Assertion::choice(
            $calleridUpdateHeader,
            [
                ResidentialDeviceInterface::CALLERIDUPDATEHEADER_PAI,
                ResidentialDeviceInterface::CALLERIDUPDATEHEADER_RPID,
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
        Assertion::choice(
            $updateCallerid,
            [
                ResidentialDeviceInterface::UPDATECALLERID_YES,
                ResidentialDeviceInterface::UPDATECALLERID_NO,
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
        Assertion::choice(
            $directConnectivity,
            [
                ResidentialDeviceInterface::DIRECTCONNECTIVITY_YES,
                ResidentialDeviceInterface::DIRECTCONNECTIVITY_NO,
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
                ResidentialDeviceInterface::DDIIN_YES,
                ResidentialDeviceInterface::DDIIN_NO,
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

    protected function setT38Passthrough(string $t38Passthrough): static
    {
        Assertion::choice(
            $t38Passthrough,
            [
                ResidentialDeviceInterface::T38PASSTHROUGH_YES,
                ResidentialDeviceInterface::T38PASSTHROUGH_NO,
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

    public function setBrand(BrandInterface $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): BrandInterface
    {
        return $this->brand;
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

    protected function setCompany(CompanyInterface $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): CompanyInterface
    {
        return $this->company;
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
}
