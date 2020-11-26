<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\CarrierServer;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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

    /**
     * @var string | null
     */
    protected $ip;

    /**
     * @var string | null
     */
    protected $hostname;

    /**
     * @var int | null
     */
    protected $port;

    /**
     * @var int | null
     */
    protected $uriScheme;

    /**
     * @var int | null
     */
    protected $transport;

    /**
     * @var bool | null
     */
    protected $sendPAI = false;

    /**
     * @var bool | null
     */
    protected $sendRPID = false;

    /**
     * @var string
     */
    protected $authNeeded = 'no';

    /**
     * @var string | null
     */
    protected $authUser;

    /**
     * @var string | null
     */
    protected $authPassword;

    /**
     * @var string | null
     */
    protected $sipProxy;

    /**
     * @var string | null
     */
    protected $outboundProxy;

    /**
     * @var string | null
     */
    protected $fromUser;

    /**
     * @var string | null
     */
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
        $authNeeded
    ) {
        $this->setAuthNeeded($authNeeded);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "CarrierServer",
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
     * @return CarrierServerDto
     */
    public static function createDto($id = null)
    {
        return new CarrierServerDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param CarrierServerInterface|null $entity
     * @param int $depth
     * @return CarrierServerDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var CarrierServerDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CarrierServerDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @param int $depth
     * @return CarrierServerDto
     */
    public function toDto($depth = 0)
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

    /**
     * @return array
     */
    protected function __toArray()
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

    /**
     * Set ip
     *
     * @param string $ip | null
     *
     * @return static
     */
    protected function setIp(?string $ip = null): CarrierServerInterface
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
     * Set hostname
     *
     * @param string $hostname | null
     *
     * @return static
     */
    protected function setHostname(?string $hostname = null): CarrierServerInterface
    {
        if (!is_null($hostname)) {
            Assertion::maxLength($hostname, 64, 'hostname value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->hostname = $hostname;

        return $this;
    }

    /**
     * Get hostname
     *
     * @return string | null
     */
    public function getHostname(): ?string
    {
        return $this->hostname;
    }

    /**
     * Set port
     *
     * @param int $port | null
     *
     * @return static
     */
    protected function setPort(?int $port = null): CarrierServerInterface
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
     * Set uriScheme
     *
     * @param int $uriScheme | null
     *
     * @return static
     */
    protected function setUriScheme(?int $uriScheme = null): CarrierServerInterface
    {
        if (!is_null($uriScheme)) {
            Assertion::greaterOrEqualThan($uriScheme, 0, 'uriScheme provided "%s" is not greater or equal than "%s".');
        }

        $this->uriScheme = $uriScheme;

        return $this;
    }

    /**
     * Get uriScheme
     *
     * @return int | null
     */
    public function getUriScheme(): ?int
    {
        return $this->uriScheme;
    }

    /**
     * Set transport
     *
     * @param int $transport | null
     *
     * @return static
     */
    protected function setTransport(?int $transport = null): CarrierServerInterface
    {
        if (!is_null($transport)) {
            Assertion::greaterOrEqualThan($transport, 0, 'transport provided "%s" is not greater or equal than "%s".');
        }

        $this->transport = $transport;

        return $this;
    }

    /**
     * Get transport
     *
     * @return int | null
     */
    public function getTransport(): ?int
    {
        return $this->transport;
    }

    /**
     * Set sendPAI
     *
     * @param bool $sendPAI | null
     *
     * @return static
     */
    protected function setSendPAI(?bool $sendPAI = null): CarrierServerInterface
    {
        if (!is_null($sendPAI)) {
            Assertion::between(intval($sendPAI), 0, 1, 'sendPAI provided "%s" is not a valid boolean value.');
            $sendPAI = (bool) $sendPAI;
        }

        $this->sendPAI = $sendPAI;

        return $this;
    }

    /**
     * Get sendPAI
     *
     * @return bool | null
     */
    public function getSendPAI(): ?bool
    {
        return $this->sendPAI;
    }

    /**
     * Set sendRPID
     *
     * @param bool $sendRPID | null
     *
     * @return static
     */
    protected function setSendRPID(?bool $sendRPID = null): CarrierServerInterface
    {
        if (!is_null($sendRPID)) {
            Assertion::between(intval($sendRPID), 0, 1, 'sendRPID provided "%s" is not a valid boolean value.');
            $sendRPID = (bool) $sendRPID;
        }

        $this->sendRPID = $sendRPID;

        return $this;
    }

    /**
     * Get sendRPID
     *
     * @return bool | null
     */
    public function getSendRPID(): ?bool
    {
        return $this->sendRPID;
    }

    /**
     * Set authNeeded
     *
     * @param string $authNeeded
     *
     * @return static
     */
    protected function setAuthNeeded(string $authNeeded): CarrierServerInterface
    {
        $this->authNeeded = $authNeeded;

        return $this;
    }

    /**
     * Get authNeeded
     *
     * @return string
     */
    public function getAuthNeeded(): string
    {
        return $this->authNeeded;
    }

    /**
     * Set authUser
     *
     * @param string $authUser | null
     *
     * @return static
     */
    protected function setAuthUser(?string $authUser = null): CarrierServerInterface
    {
        if (!is_null($authUser)) {
            Assertion::maxLength($authUser, 64, 'authUser value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->authUser = $authUser;

        return $this;
    }

    /**
     * Get authUser
     *
     * @return string | null
     */
    public function getAuthUser(): ?string
    {
        return $this->authUser;
    }

    /**
     * Set authPassword
     *
     * @param string $authPassword | null
     *
     * @return static
     */
    protected function setAuthPassword(?string $authPassword = null): CarrierServerInterface
    {
        if (!is_null($authPassword)) {
            Assertion::maxLength($authPassword, 64, 'authPassword value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->authPassword = $authPassword;

        return $this;
    }

    /**
     * Get authPassword
     *
     * @return string | null
     */
    public function getAuthPassword(): ?string
    {
        return $this->authPassword;
    }

    /**
     * Set sipProxy
     *
     * @param string $sipProxy | null
     *
     * @return static
     */
    protected function setSipProxy(?string $sipProxy = null): CarrierServerInterface
    {
        if (!is_null($sipProxy)) {
            Assertion::maxLength($sipProxy, 128, 'sipProxy value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->sipProxy = $sipProxy;

        return $this;
    }

    /**
     * Get sipProxy
     *
     * @return string | null
     */
    public function getSipProxy(): ?string
    {
        return $this->sipProxy;
    }

    /**
     * Set outboundProxy
     *
     * @param string $outboundProxy | null
     *
     * @return static
     */
    protected function setOutboundProxy(?string $outboundProxy = null): CarrierServerInterface
    {
        if (!is_null($outboundProxy)) {
            Assertion::maxLength($outboundProxy, 128, 'outboundProxy value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->outboundProxy = $outboundProxy;

        return $this;
    }

    /**
     * Get outboundProxy
     *
     * @return string | null
     */
    public function getOutboundProxy(): ?string
    {
        return $this->outboundProxy;
    }

    /**
     * Set fromUser
     *
     * @param string $fromUser | null
     *
     * @return static
     */
    protected function setFromUser(?string $fromUser = null): CarrierServerInterface
    {
        if (!is_null($fromUser)) {
            Assertion::maxLength($fromUser, 64, 'fromUser value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fromUser = $fromUser;

        return $this;
    }

    /**
     * Get fromUser
     *
     * @return string | null
     */
    public function getFromUser(): ?string
    {
        return $this->fromUser;
    }

    /**
     * Set fromDomain
     *
     * @param string $fromDomain | null
     *
     * @return static
     */
    protected function setFromDomain(?string $fromDomain = null): CarrierServerInterface
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
     * Set carrier
     *
     * @param CarrierInterface
     *
     * @return static
     */
    public function setCarrier(CarrierInterface $carrier): CarrierServerInterface
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get carrier
     *
     * @return CarrierInterface
     */
    public function getCarrier(): CarrierInterface
    {
        return $this->carrier;
    }

    /**
     * Set brand
     *
     * @param BrandInterface
     *
     * @return static
     */
    protected function setBrand(BrandInterface $brand): CarrierServerInterface
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

}
