<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\SurvivalDevice;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\Company;

/**
* SurvivalDeviceAbstract
* @codeCoverageIgnore
*/
abstract class SurvivalDeviceAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $proxy;

    /**
     * @var ?string
     */
    protected $outboundProxy = null;

    /**
     * @var int
     */
    protected $udpPort = 5060;

    /**
     * @var int
     */
    protected $tcpPort = 5060;

    /**
     * @var int
     */
    protected $tlsPort = 5061;

    /**
     * @var int
     */
    protected $wssPort = 10081;

    /**
     * @var ?string
     */
    protected $description = null;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        string $proxy,
        int $udpPort,
        int $tcpPort,
        int $tlsPort,
        int $wssPort
    ) {
        $this->setName($name);
        $this->setProxy($proxy);
        $this->setUdpPort($udpPort);
        $this->setTcpPort($tcpPort);
        $this->setTlsPort($tlsPort);
        $this->setWssPort($wssPort);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "SurvivalDevice",
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
    public static function createDto($id = null): SurvivalDeviceDto
    {
        return new SurvivalDeviceDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|SurvivalDeviceInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?SurvivalDeviceDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, SurvivalDeviceInterface::class);

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
     * @param SurvivalDeviceDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, SurvivalDeviceDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $proxy = $dto->getProxy();
        Assertion::notNull($proxy, 'getProxy value is null, but non null value was expected.');
        $udpPort = $dto->getUdpPort();
        Assertion::notNull($udpPort, 'getUdpPort value is null, but non null value was expected.');
        $tcpPort = $dto->getTcpPort();
        Assertion::notNull($tcpPort, 'getTcpPort value is null, but non null value was expected.');
        $tlsPort = $dto->getTlsPort();
        Assertion::notNull($tlsPort, 'getTlsPort value is null, but non null value was expected.');
        $wssPort = $dto->getWssPort();
        Assertion::notNull($wssPort, 'getWssPort value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $self = new static(
            $name,
            $proxy,
            $udpPort,
            $tcpPort,
            $tlsPort,
            $wssPort
        );

        $self
            ->setOutboundProxy($dto->getOutboundProxy())
            ->setDescription($dto->getDescription())
            ->setCompany($fkTransformer->transform($company));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param SurvivalDeviceDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, SurvivalDeviceDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $proxy = $dto->getProxy();
        Assertion::notNull($proxy, 'getProxy value is null, but non null value was expected.');
        $udpPort = $dto->getUdpPort();
        Assertion::notNull($udpPort, 'getUdpPort value is null, but non null value was expected.');
        $tcpPort = $dto->getTcpPort();
        Assertion::notNull($tcpPort, 'getTcpPort value is null, but non null value was expected.');
        $tlsPort = $dto->getTlsPort();
        Assertion::notNull($tlsPort, 'getTlsPort value is null, but non null value was expected.');
        $wssPort = $dto->getWssPort();
        Assertion::notNull($wssPort, 'getWssPort value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setProxy($proxy)
            ->setOutboundProxy($dto->getOutboundProxy())
            ->setUdpPort($udpPort)
            ->setTcpPort($tcpPort)
            ->setTlsPort($tlsPort)
            ->setWssPort($wssPort)
            ->setDescription($dto->getDescription())
            ->setCompany($fkTransformer->transform($company));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): SurvivalDeviceDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setProxy(self::getProxy())
            ->setOutboundProxy(self::getOutboundProxy())
            ->setUdpPort(self::getUdpPort())
            ->setTcpPort(self::getTcpPort())
            ->setTlsPort(self::getTlsPort())
            ->setWssPort(self::getWssPort())
            ->setDescription(self::getDescription())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'proxy' => self::getProxy(),
            'outboundProxy' => self::getOutboundProxy(),
            'udpPort' => self::getUdpPort(),
            'tcpPort' => self::getTcpPort(),
            'tlsPort' => self::getTlsPort(),
            'wssPort' => self::getWssPort(),
            'description' => self::getDescription(),
            'companyId' => self::getCompany()->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 80, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setProxy(string $proxy): static
    {
        Assertion::maxLength($proxy, 80, 'proxy value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->proxy = $proxy;

        return $this;
    }

    public function getProxy(): string
    {
        return $this->proxy;
    }

    protected function setOutboundProxy(?string $outboundProxy = null): static
    {
        if (!is_null($outboundProxy)) {
            Assertion::maxLength($outboundProxy, 80, 'outboundProxy value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->outboundProxy = $outboundProxy;

        return $this;
    }

    public function getOutboundProxy(): ?string
    {
        return $this->outboundProxy;
    }

    protected function setUdpPort(int $udpPort): static
    {
        Assertion::greaterOrEqualThan($udpPort, 0, 'udpPort provided "%s" is not greater or equal than "%s".');

        $this->udpPort = $udpPort;

        return $this;
    }

    public function getUdpPort(): int
    {
        return $this->udpPort;
    }

    protected function setTcpPort(int $tcpPort): static
    {
        Assertion::greaterOrEqualThan($tcpPort, 0, 'tcpPort provided "%s" is not greater or equal than "%s".');

        $this->tcpPort = $tcpPort;

        return $this;
    }

    public function getTcpPort(): int
    {
        return $this->tcpPort;
    }

    protected function setTlsPort(int $tlsPort): static
    {
        Assertion::greaterOrEqualThan($tlsPort, 0, 'tlsPort provided "%s" is not greater or equal than "%s".');

        $this->tlsPort = $tlsPort;

        return $this;
    }

    public function getTlsPort(): int
    {
        return $this->tlsPort;
    }

    protected function setWssPort(int $wssPort): static
    {
        Assertion::greaterOrEqualThan($wssPort, 0, 'wssPort provided "%s" is not greater or equal than "%s".');

        $this->wssPort = $wssPort;

        return $this;
    }

    public function getWssPort(): int
    {
        return $this->wssPort;
    }

    protected function setDescription(?string $description = null): static
    {
        if (!is_null($description)) {
            Assertion::maxLength($description, 1024, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
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
}
