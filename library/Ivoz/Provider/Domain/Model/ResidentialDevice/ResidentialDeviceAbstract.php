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

    protected $name;

    protected $description = '';

    /**
     * comment: enum:udp|tcp|tls
     */
    protected $transport;

    protected $ip;

    protected $port;

    /**
     * column: auth_needed
     */
    protected $authNeeded = 'yes';

    protected $password;

    protected $disallow = 'all';

    protected $allow = 'alaw';

    /**
     * column: direct_media_method
     * comment: enum:invite|update
     */
    protected $directMediaMethod = 'update';

    /**
     * column: callerid_update_header
     * comment: enum:pai|rpid
     */
    protected $calleridUpdateHeader = 'pai';

    /**
     * column: update_callerid
     * comment: enum:yes|no
     */
    protected $updateCallerid = 'yes';

    /**
     * column: from_domain
     */
    protected $fromDomain;

    /**
     * comment: enum:yes|no
     */
    protected $directConnectivity = 'yes';

    /**
     * comment: enum:yes|no
     */
    protected $ddiIn = 'yes';

    protected $maxCalls = 1;

    /**
     * comment: enum:yes|no
     */
    protected $t38Passthrough = 'no';

    protected $rtpEncryption = false;

    protected $multiContact = true;

    /**
     * @var BrandInterface
     * inversedBy residentialDevices
     */
    protected $brand;

    /**
     * @var DomainInterface | null
     * inversedBy residentialDevices
     */
    protected $domain;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var TransformationRuleSetInterface | null
     */
    protected $transformationRuleSet;

    /**
     * @var DdiInterface | null
     */
    protected $outgoingDdi;

    /**
     * @var LanguageInterface | null
     */
    protected $language;

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

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "ResidentialDevice",
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
     * @param mixed $id
     */
    public static function createDto($id = null): ResidentialDeviceDto
    {
        return new ResidentialDeviceDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param ResidentialDeviceInterface|null $entity
     * @param int $depth
     * @return ResidentialDeviceDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var ResidentialDeviceDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ResidentialDeviceDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ResidentialDeviceDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getDescription(),
            $dto->getAuthNeeded(),
            $dto->getDisallow(),
            $dto->getAllow(),
            $dto->getDirectMediaMethod(),
            $dto->getCalleridUpdateHeader(),
            $dto->getUpdateCallerid(),
            $dto->getDirectConnectivity(),
            $dto->getDdiIn(),
            $dto->getMaxCalls(),
            $dto->getT38Passthrough(),
            $dto->getRtpEncryption(),
            $dto->getMultiContact()
        );

        $self
            ->setTransport($dto->getTransport())
            ->setIp($dto->getIp())
            ->setPort($dto->getPort())
            ->setPassword($dto->getPassword())
            ->setFromDomain($dto->getFromDomain())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ResidentialDeviceDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ResidentialDeviceDto::class);

        $this
            ->setName($dto->getName())
            ->setDescription($dto->getDescription())
            ->setTransport($dto->getTransport())
            ->setIp($dto->getIp())
            ->setPort($dto->getPort())
            ->setAuthNeeded($dto->getAuthNeeded())
            ->setPassword($dto->getPassword())
            ->setDisallow($dto->getDisallow())
            ->setAllow($dto->getAllow())
            ->setDirectMediaMethod($dto->getDirectMediaMethod())
            ->setCalleridUpdateHeader($dto->getCalleridUpdateHeader())
            ->setUpdateCallerid($dto->getUpdateCallerid())
            ->setFromDomain($dto->getFromDomain())
            ->setDirectConnectivity($dto->getDirectConnectivity())
            ->setDdiIn($dto->getDdiIn())
            ->setMaxCalls($dto->getMaxCalls())
            ->setT38Passthrough($dto->getT38Passthrough())
            ->setRtpEncryption($dto->getRtpEncryption())
            ->setMultiContact($dto->getMultiContact())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): ResidentialDeviceDto
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
     * @return array
     */
    protected function __toArray()
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
            'domainId' => self::getDomain() ? self::getDomain()->getId() : null,
            'companyId' => self::getCompany()->getId(),
            'transformationRuleSetId' => self::getTransformationRuleSet() ? self::getTransformationRuleSet()->getId() : null,
            'outgoingDdiId' => self::getOutgoingDdi() ? self::getOutgoingDdi()->getId() : null,
            'languageId' => self::getLanguage() ? self::getLanguage()->getId() : null
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
