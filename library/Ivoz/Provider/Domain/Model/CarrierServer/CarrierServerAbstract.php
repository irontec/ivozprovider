<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\CarrierServer;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\Brand\Brand;

/**
* CarrierServerAbstract
* @codeCoverageIgnore
*/
abstract class CarrierServerAbstract
{
    use ChangelogTrait;

    protected $ip;

    protected $hostname;

    protected $port;

    protected $uriScheme;

    protected $transport;

    protected $sendPAI = false;

    protected $sendRPID = false;

    protected $authNeeded = 'no';

    protected $authUser;

    protected $authPassword;

    protected $sipProxy;

    protected $outboundProxy;

    protected $fromUser;

    protected $fromDomain;

    /**
     * @var CarrierInterface
     * inversedBy servers
     */
    protected $carrier;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * Constructor
     */
    protected function __construct(
        string $authNeeded
    ) {
        $this->setAuthNeeded($authNeeded);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "CarrierServer",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): CarrierServerDto
    {
        return new CarrierServerDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|CarrierServerInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CarrierServerDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CarrierServerInterface::class);

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
     * @param CarrierServerDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CarrierServerDto::class);

        $self = new static(
            $dto->getAuthNeeded()
        );

        $self
            ->setIp($dto->getIp())
            ->setHostname($dto->getHostname())
            ->setPort($dto->getPort())
            ->setUriScheme($dto->getUriScheme())
            ->setTransport($dto->getTransport())
            ->setSendPAI($dto->getSendPAI())
            ->setSendRPID($dto->getSendRPID())
            ->setAuthUser($dto->getAuthUser())
            ->setAuthPassword($dto->getAuthPassword())
            ->setSipProxy($dto->getSipProxy())
            ->setOutboundProxy($dto->getOutboundProxy())
            ->setFromUser($dto->getFromUser())
            ->setFromDomain($dto->getFromDomain())
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setBrand($fkTransformer->transform($dto->getBrand()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CarrierServerDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CarrierServerDto::class);

        $this
            ->setIp($dto->getIp())
            ->setHostname($dto->getHostname())
            ->setPort($dto->getPort())
            ->setUriScheme($dto->getUriScheme())
            ->setTransport($dto->getTransport())
            ->setSendPAI($dto->getSendPAI())
            ->setSendRPID($dto->getSendRPID())
            ->setAuthNeeded($dto->getAuthNeeded())
            ->setAuthUser($dto->getAuthUser())
            ->setAuthPassword($dto->getAuthPassword())
            ->setSipProxy($dto->getSipProxy())
            ->setOutboundProxy($dto->getOutboundProxy())
            ->setFromUser($dto->getFromUser())
            ->setFromDomain($dto->getFromDomain())
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setBrand($fkTransformer->transform($dto->getBrand()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CarrierServerDto
    {
        return self::createDto()
            ->setIp(self::getIp())
            ->setHostname(self::getHostname())
            ->setPort(self::getPort())
            ->setUriScheme(self::getUriScheme())
            ->setTransport(self::getTransport())
            ->setSendPAI(self::getSendPAI())
            ->setSendRPID(self::getSendRPID())
            ->setAuthNeeded(self::getAuthNeeded())
            ->setAuthUser(self::getAuthUser())
            ->setAuthPassword(self::getAuthPassword())
            ->setSipProxy(self::getSipProxy())
            ->setOutboundProxy(self::getOutboundProxy())
            ->setFromUser(self::getFromUser())
            ->setFromDomain(self::getFromDomain())
            ->setCarrier(Carrier::entityToDto(self::getCarrier(), $depth))
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'ip' => self::getIp(),
            'hostname' => self::getHostname(),
            'port' => self::getPort(),
            'uriScheme' => self::getUriScheme(),
            'transport' => self::getTransport(),
            'sendPAI' => self::getSendPAI(),
            'sendRPID' => self::getSendRPID(),
            'authNeeded' => self::getAuthNeeded(),
            'authUser' => self::getAuthUser(),
            'authPassword' => self::getAuthPassword(),
            'sipProxy' => self::getSipProxy(),
            'outboundProxy' => self::getOutboundProxy(),
            'fromUser' => self::getFromUser(),
            'fromDomain' => self::getFromDomain(),
            'carrierId' => self::getCarrier()->getId(),
            'brandId' => self::getBrand()->getId()
        ];
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

    protected function setHostname(?string $hostname = null): static
    {
        if (!is_null($hostname)) {
            Assertion::maxLength($hostname, 64, 'hostname value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->hostname = $hostname;

        return $this;
    }

    public function getHostname(): ?string
    {
        return $this->hostname;
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

    protected function setUriScheme(?int $uriScheme = null): static
    {
        if (!is_null($uriScheme)) {
            Assertion::greaterOrEqualThan($uriScheme, 0, 'uriScheme provided "%s" is not greater or equal than "%s".');
        }

        $this->uriScheme = $uriScheme;

        return $this;
    }

    public function getUriScheme(): ?int
    {
        return $this->uriScheme;
    }

    protected function setTransport(?int $transport = null): static
    {
        if (!is_null($transport)) {
            Assertion::greaterOrEqualThan($transport, 0, 'transport provided "%s" is not greater or equal than "%s".');
        }

        $this->transport = $transport;

        return $this;
    }

    public function getTransport(): ?int
    {
        return $this->transport;
    }

    protected function setSendPAI(?bool $sendPAI = null): static
    {
        $this->sendPAI = $sendPAI;

        return $this;
    }

    public function getSendPAI(): ?bool
    {
        return $this->sendPAI;
    }

    protected function setSendRPID(?bool $sendRPID = null): static
    {
        $this->sendRPID = $sendRPID;

        return $this;
    }

    public function getSendRPID(): ?bool
    {
        return $this->sendRPID;
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

    protected function setAuthUser(?string $authUser = null): static
    {
        if (!is_null($authUser)) {
            Assertion::maxLength($authUser, 64, 'authUser value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->authUser = $authUser;

        return $this;
    }

    public function getAuthUser(): ?string
    {
        return $this->authUser;
    }

    protected function setAuthPassword(?string $authPassword = null): static
    {
        if (!is_null($authPassword)) {
            Assertion::maxLength($authPassword, 64, 'authPassword value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->authPassword = $authPassword;

        return $this;
    }

    public function getAuthPassword(): ?string
    {
        return $this->authPassword;
    }

    protected function setSipProxy(?string $sipProxy = null): static
    {
        if (!is_null($sipProxy)) {
            Assertion::maxLength($sipProxy, 128, 'sipProxy value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->sipProxy = $sipProxy;

        return $this;
    }

    public function getSipProxy(): ?string
    {
        return $this->sipProxy;
    }

    protected function setOutboundProxy(?string $outboundProxy = null): static
    {
        if (!is_null($outboundProxy)) {
            Assertion::maxLength($outboundProxy, 128, 'outboundProxy value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->outboundProxy = $outboundProxy;

        return $this;
    }

    public function getOutboundProxy(): ?string
    {
        return $this->outboundProxy;
    }

    protected function setFromUser(?string $fromUser = null): static
    {
        if (!is_null($fromUser)) {
            Assertion::maxLength($fromUser, 64, 'fromUser value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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

    public function setCarrier(CarrierInterface $carrier): static
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getCarrier(): CarrierInterface
    {
        return $this->carrier;
    }

    protected function setBrand(BrandInterface $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): BrandInterface
    {
        return $this->brand;
    }
}
