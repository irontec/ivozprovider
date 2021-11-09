<?php

namespace Ivoz\Provider\Domain\Model\CarrierServer;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayDto;

/**
* CarrierServerDtoAbstract
* @codeCoverageIgnore
*/
abstract class CarrierServerDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $ip;

    /**
     * @var string|null
     */
    private $hostname;

    /**
     * @var int|null
     */
    private $port;

    /**
     * @var int|null
     */
    private $uriScheme;

    /**
     * @var int|null
     */
    private $transport;

    /**
     * @var bool|null
     */
    private $sendPAI = false;

    /**
     * @var bool|null
     */
    private $sendRPID = false;

    /**
     * @var string
     */
    private $authNeeded = 'no';

    /**
     * @var string|null
     */
    private $authUser;

    /**
     * @var string|null
     */
    private $authPassword;

    /**
     * @var string|null
     */
    private $sipProxy;

    /**
     * @var string|null
     */
    private $outboundProxy;

    /**
     * @var string|null
     */
    private $fromUser;

    /**
     * @var string|null
     */
    private $fromDomain;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CarrierDto | null
     */
    private $carrier;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var TrunksLcrGatewayDto | null
     */
    private $lcrGateway;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'ip' => 'ip',
            'hostname' => 'hostname',
            'port' => 'port',
            'uriScheme' => 'uriScheme',
            'transport' => 'transport',
            'sendPAI' => 'sendPAI',
            'sendRPID' => 'sendRPID',
            'authNeeded' => 'authNeeded',
            'authUser' => 'authUser',
            'authPassword' => 'authPassword',
            'sipProxy' => 'sipProxy',
            'outboundProxy' => 'outboundProxy',
            'fromUser' => 'fromUser',
            'fromDomain' => 'fromDomain',
            'id' => 'id',
            'carrierId' => 'carrier',
            'brandId' => 'brand',
            'lcrGatewayId' => 'lcrGateway'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'ip' => $this->getIp(),
            'hostname' => $this->getHostname(),
            'port' => $this->getPort(),
            'uriScheme' => $this->getUriScheme(),
            'transport' => $this->getTransport(),
            'sendPAI' => $this->getSendPAI(),
            'sendRPID' => $this->getSendRPID(),
            'authNeeded' => $this->getAuthNeeded(),
            'authUser' => $this->getAuthUser(),
            'authPassword' => $this->getAuthPassword(),
            'sipProxy' => $this->getSipProxy(),
            'outboundProxy' => $this->getOutboundProxy(),
            'fromUser' => $this->getFromUser(),
            'fromDomain' => $this->getFromDomain(),
            'id' => $this->getId(),
            'carrier' => $this->getCarrier(),
            'brand' => $this->getBrand(),
            'lcrGateway' => $this->getLcrGateway()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    public function setIp(?string $ip): static
    {
        $this->ip = $ip;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setHostname(?string $hostname): static
    {
        $this->hostname = $hostname;

        return $this;
    }

    public function getHostname(): ?string
    {
        return $this->hostname;
    }

    public function setPort(?int $port): static
    {
        $this->port = $port;

        return $this;
    }

    public function getPort(): ?int
    {
        return $this->port;
    }

    public function setUriScheme(?int $uriScheme): static
    {
        $this->uriScheme = $uriScheme;

        return $this;
    }

    public function getUriScheme(): ?int
    {
        return $this->uriScheme;
    }

    public function setTransport(?int $transport): static
    {
        $this->transport = $transport;

        return $this;
    }

    public function getTransport(): ?int
    {
        return $this->transport;
    }

    public function setSendPAI(?bool $sendPAI): static
    {
        $this->sendPAI = $sendPAI;

        return $this;
    }

    public function getSendPAI(): ?bool
    {
        return $this->sendPAI;
    }

    public function setSendRPID(?bool $sendRPID): static
    {
        $this->sendRPID = $sendRPID;

        return $this;
    }

    public function getSendRPID(): ?bool
    {
        return $this->sendRPID;
    }

    public function setAuthNeeded(string $authNeeded): static
    {
        $this->authNeeded = $authNeeded;

        return $this;
    }

    public function getAuthNeeded(): ?string
    {
        return $this->authNeeded;
    }

    public function setAuthUser(?string $authUser): static
    {
        $this->authUser = $authUser;

        return $this;
    }

    public function getAuthUser(): ?string
    {
        return $this->authUser;
    }

    public function setAuthPassword(?string $authPassword): static
    {
        $this->authPassword = $authPassword;

        return $this;
    }

    public function getAuthPassword(): ?string
    {
        return $this->authPassword;
    }

    public function setSipProxy(?string $sipProxy): static
    {
        $this->sipProxy = $sipProxy;

        return $this;
    }

    public function getSipProxy(): ?string
    {
        return $this->sipProxy;
    }

    public function setOutboundProxy(?string $outboundProxy): static
    {
        $this->outboundProxy = $outboundProxy;

        return $this;
    }

    public function getOutboundProxy(): ?string
    {
        return $this->outboundProxy;
    }

    public function setFromUser(?string $fromUser): static
    {
        $this->fromUser = $fromUser;

        return $this;
    }

    public function getFromUser(): ?string
    {
        return $this->fromUser;
    }

    public function setFromDomain(?string $fromDomain): static
    {
        $this->fromDomain = $fromDomain;

        return $this;
    }

    public function getFromDomain(): ?string
    {
        return $this->fromDomain;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCarrier(?CarrierDto $carrier): static
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getCarrier(): ?CarrierDto
    {
        return $this->carrier;
    }

    public function setCarrierId($id): static
    {
        $value = !is_null($id)
            ? new CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }

    public function setBrand(?BrandDto $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    public function setBrandId($id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    public function setLcrGateway(?TrunksLcrGatewayDto $lcrGateway): static
    {
        $this->lcrGateway = $lcrGateway;

        return $this;
    }

    public function getLcrGateway(): ?TrunksLcrGatewayDto
    {
        return $this->lcrGateway;
    }

    public function setLcrGatewayId($id): static
    {
        $value = !is_null($id)
            ? new TrunksLcrGatewayDto($id)
            : null;

        return $this->setLcrGateway($value);
    }

    public function getLcrGatewayId()
    {
        if ($dto = $this->getLcrGateway()) {
            return $dto->getId();
        }

        return null;
    }
}
