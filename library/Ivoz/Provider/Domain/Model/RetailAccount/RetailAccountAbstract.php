<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\RetailAccount;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;

/**
* RetailAccountAbstract
* @codeCoverageIgnore
*/
abstract class RetailAccountAbstract
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
     * comment: enum:udp|tcp|tls
     * @var string | null
     */
    protected $transport;

    /**
     * @var string | null
     */
    protected $ip;

    /**
     * @var int | null
     */
    protected $port;

    /**
     * @var string | null
     */
    protected $password;

    /**
     * @var string | null
     */
    protected $fromDomain;

    /**
     * comment: enum:yes|no
     * @var string
     */
    protected $directConnectivity = 'yes';

    /**
     * comment: enum:yes|no
     * @var string
     */
    protected $ddiIn = 'yes';

    /**
     * comment: enum:yes|no
     * @var string
     */
    protected $t38Passthrough = 'no';

    /**
     * @var bool
     */
    protected $rtpEncryption = false;

    /**
     * @var BrandInterface
     * inversedBy residentialDevices
     */
    protected $brand;

    /**
     * @var DomainInterface
     * inversedBy residentialDevices
     */
    protected $domain;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var TransformationRuleSetInterface
     */
    protected $transformationRuleSet;

    /**
     * @var DdiInterface
     */
    protected $outgoingDdi;

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        $description,
        $directConnectivity,
        $ddiIn,
        $t38Passthrough,
        $rtpEncryption
    ) {
        $this->setName($name);
        $this->setDescription($description);
        $this->setDirectConnectivity($directConnectivity);
        $this->setDdiIn($ddiIn);
        $this->setT38Passthrough($t38Passthrough);
        $this->setRtpEncryption($rtpEncryption);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "RetailAccount",
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
     * @return RetailAccountDto
     */
    public static function createDto($id = null)
    {
        return new RetailAccountDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param RetailAccountInterface|null $entity
     * @param int $depth
     * @return RetailAccountDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, RetailAccountInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var RetailAccountDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param RetailAccountDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, RetailAccountDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getDescription(),
            $dto->getDirectConnectivity(),
            $dto->getDdiIn(),
            $dto->getT38Passthrough(),
            $dto->getRtpEncryption()
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
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param RetailAccountDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, RetailAccountDto::class);

        $this
            ->setName($dto->getName())
            ->setDescription($dto->getDescription())
            ->setTransport($dto->getTransport())
            ->setIp($dto->getIp())
            ->setPort($dto->getPort())
            ->setPassword($dto->getPassword())
            ->setFromDomain($dto->getFromDomain())
            ->setDirectConnectivity($dto->getDirectConnectivity())
            ->setDdiIn($dto->getDdiIn())
            ->setT38Passthrough($dto->getT38Passthrough())
            ->setRtpEncryption($dto->getRtpEncryption())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return RetailAccountDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDescription(self::getDescription())
            ->setTransport(self::getTransport())
            ->setIp(self::getIp())
            ->setPort(self::getPort())
            ->setPassword(self::getPassword())
            ->setFromDomain(self::getFromDomain())
            ->setDirectConnectivity(self::getDirectConnectivity())
            ->setDdiIn(self::getDdiIn())
            ->setT38Passthrough(self::getT38Passthrough())
            ->setRtpEncryption(self::getRtpEncryption())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setDomain(Domain::entityToDto(self::getDomain(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setTransformationRuleSet(TransformationRuleSet::entityToDto(self::getTransformationRuleSet(), $depth))
            ->setOutgoingDdi(Ddi::entityToDto(self::getOutgoingDdi(), $depth));
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
            'password' => self::getPassword(),
            'fromDomain' => self::getFromDomain(),
            'directConnectivity' => self::getDirectConnectivity(),
            'ddiIn' => self::getDdiIn(),
            't38Passthrough' => self::getT38Passthrough(),
            'rtpEncryption' => self::getRtpEncryption(),
            'brandId' => self::getBrand()->getId(),
            'domainId' => self::getDomain() ? self::getDomain()->getId() : null,
            'companyId' => self::getCompany()->getId(),
            'transformationRuleSetId' => self::getTransformationRuleSet() ? self::getTransformationRuleSet()->getId() : null,
            'outgoingDdiId' => self::getOutgoingDdi() ? self::getOutgoingDdi()->getId() : null
        ];
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName(string $name): RetailAccountInterface
    {
        Assertion::maxLength($name, 65, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * Set description
     *
     * @param string $description
     *
     * @return static
     */
    protected function setDescription(string $description): RetailAccountInterface
    {
        Assertion::maxLength($description, 500, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set transport
     *
     * @param string $transport | null
     *
     * @return static
     */
    protected function setTransport(?string $transport = null): RetailAccountInterface
    {
        if (!is_null($transport)) {
            Assertion::maxLength($transport, 25, 'transport value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $transport,
                [
                    RetailAccountInterface::TRANSPORT_UDP,
                    RetailAccountInterface::TRANSPORT_TCP,
                    RetailAccountInterface::TRANSPORT_TLS,
                ],
                'transportvalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->transport = $transport;

        return $this;
    }

    /**
     * Get transport
     *
     * @return string | null
     */
    public function getTransport(): ?string
    {
        return $this->transport;
    }

    /**
     * Set ip
     *
     * @param string $ip | null
     *
     * @return static
     */
    protected function setIp(?string $ip = null): RetailAccountInterface
    {
        if (!is_null($ip)) {
            Assertion::maxLength($ip, 50, 'ip value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string | null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * Set port
     *
     * @param int $port | null
     *
     * @return static
     */
    protected function setPort(?int $port = null): RetailAccountInterface
    {
        if (!is_null($port)) {
            Assertion::greaterOrEqualThan($port, 0, 'port provided "%s" is not greater or equal than "%s".');
        }

        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return int | null
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

    /**
     * Set password
     *
     * @param string $password | null
     *
     * @return static
     */
    protected function setPassword(?string $password = null): RetailAccountInterface
    {
        if (!is_null($password)) {
            Assertion::maxLength($password, 64, 'password value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string | null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set fromDomain
     *
     * @param string $fromDomain | null
     *
     * @return static
     */
    protected function setFromDomain(?string $fromDomain = null): RetailAccountInterface
    {
        if (!is_null($fromDomain)) {
            Assertion::maxLength($fromDomain, 190, 'fromDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fromDomain = $fromDomain;

        return $this;
    }

    /**
     * Get fromDomain
     *
     * @return string | null
     */
    public function getFromDomain(): ?string
    {
        return $this->fromDomain;
    }

    /**
     * Set directConnectivity
     *
     * @param string $directConnectivity
     *
     * @return static
     */
    protected function setDirectConnectivity(string $directConnectivity): RetailAccountInterface
    {
        Assertion::choice(
            $directConnectivity,
            [
                RetailAccountInterface::DIRECTCONNECTIVITY_YES,
                RetailAccountInterface::DIRECTCONNECTIVITY_NO,
            ],
            'directConnectivityvalue "%s" is not an element of the valid values: %s'
        );

        $this->directConnectivity = $directConnectivity;

        return $this;
    }

    /**
     * Get directConnectivity
     *
     * @return string
     */
    public function getDirectConnectivity(): string
    {
        return $this->directConnectivity;
    }

    /**
     * Set ddiIn
     *
     * @param string $ddiIn
     *
     * @return static
     */
    protected function setDdiIn(string $ddiIn): RetailAccountInterface
    {
        Assertion::choice(
            $ddiIn,
            [
                RetailAccountInterface::DDIIN_YES,
                RetailAccountInterface::DDIIN_NO,
            ],
            'ddiInvalue "%s" is not an element of the valid values: %s'
        );

        $this->ddiIn = $ddiIn;

        return $this;
    }

    /**
     * Get ddiIn
     *
     * @return string
     */
    public function getDdiIn(): string
    {
        return $this->ddiIn;
    }

    /**
     * Set t38Passthrough
     *
     * @param string $t38Passthrough
     *
     * @return static
     */
    protected function setT38Passthrough(string $t38Passthrough): RetailAccountInterface
    {
        Assertion::choice(
            $t38Passthrough,
            [
                RetailAccountInterface::T38PASSTHROUGH_YES,
                RetailAccountInterface::T38PASSTHROUGH_NO,
            ],
            't38Passthroughvalue "%s" is not an element of the valid values: %s'
        );

        $this->t38Passthrough = $t38Passthrough;

        return $this;
    }

    /**
     * Get t38Passthrough
     *
     * @return string
     */
    public function getT38Passthrough(): string
    {
        return $this->t38Passthrough;
    }

    /**
     * Set rtpEncryption
     *
     * @param bool $rtpEncryption
     *
     * @return static
     */
    protected function setRtpEncryption(bool $rtpEncryption): RetailAccountInterface
    {
        Assertion::between(intval($rtpEncryption), 0, 1, 'rtpEncryption provided "%s" is not a valid boolean value.');
        $rtpEncryption = (bool) $rtpEncryption;

        $this->rtpEncryption = $rtpEncryption;

        return $this;
    }

    /**
     * Get rtpEncryption
     *
     * @return bool
     */
    public function getRtpEncryption(): bool
    {
        return $this->rtpEncryption;
    }

    /**
     * Set brand
     *
     * @param BrandInterface
     *
     * @return static
     */
    public function setBrand(BrandInterface $brand): RetailAccountInterface
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface
    {
        return $this->brand;
    }

    /**
     * Set domain
     *
     * @param DomainInterface | null
     *
     * @return static
     */
    public function setDomain(?DomainInterface $domain = null): RetailAccountInterface
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return DomainInterface | null
     */
    public function getDomain(): ?DomainInterface
    {
        return $this->domain;
    }

    /**
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    protected function setCompany(CompanyInterface $company): RetailAccountInterface
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
     * Set transformationRuleSet
     *
     * @param TransformationRuleSetInterface | null
     *
     * @return static
     */
    protected function setTransformationRuleSet(?TransformationRuleSetInterface $transformationRuleSet = null): RetailAccountInterface
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
     * Set outgoingDdi
     *
     * @param DdiInterface | null
     *
     * @return static
     */
    protected function setOutgoingDdi(?DdiInterface $outgoingDdi = null): RetailAccountInterface
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

}
