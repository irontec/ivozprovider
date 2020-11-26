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
     * @var string | null
     */
    private $ip;

    /**
     * @var string | null
     */
    private $hostname;

    /**
     * @var int | null
     */
    private $port;

    /**
     * @var int | null
     */
    private $uriScheme;

    /**
     * @var int | null
     */
    private $transport;

    /**
     * @var bool | null
     */
    private $sendPAI = false;

    /**
     * @var bool | null
     */
    private $sendRPID = false;

    /**
     * @var string
     */
    private $authNeeded = 'no';

    /**
     * @var string | null
     */
    private $authUser;

    /**
     * @var string | null
     */
    private $authPassword;

    /**
     * @var string | null
     */
    private $sipProxy;

    /**
     * @var string | null
     */
    private $outboundProxy;

    /**
     * @var string | null
     */
    private $fromUser;

    /**
     * @var string | null
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

    /**
     * @param string $ip | null
     *
     * @return static
     */
    public function setIp(?string $ip = null): self
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @param string $hostname | null
     *
     * @return static
     */
    public function setHostname(?string $hostname = null): self
    {
        $this->hostname = $hostname;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getHostname(): ?string
    {
        return $this->hostname;
    }

    /**
     * @param int $port | null
     *
     * @return static
     */
    public function setPort(?int $port = null): self
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

    /**
     * @param int $uriScheme | null
     *
     * @return static
     */
    public function setUriScheme(?int $uriScheme = null): self
    {
        $this->uriScheme = $uriScheme;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getUriScheme(): ?int
    {
        return $this->uriScheme;
    }

    /**
     * @param int $transport | null
     *
     * @return static
     */
    public function setTransport(?int $transport = null): self
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getTransport(): ?int
    {
        return $this->transport;
    }

    /**
     * @param bool $sendPAI | null
     *
     * @return static
     */
    public function setSendPAI(?bool $sendPAI = null): self
    {
        $this->sendPAI = $sendPAI;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getSendPAI(): ?bool
    {
        return $this->sendPAI;
    }

    /**
     * @param bool $sendRPID | null
     *
     * @return static
     */
    public function setSendRPID(?bool $sendRPID = null): self
    {
        $this->sendRPID = $sendRPID;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getSendRPID(): ?bool
    {
        return $this->sendRPID;
    }

    /**
     * @param string $authNeeded | null
     *
     * @return static
     */
    public function setAuthNeeded(?string $authNeeded = null): self
    {
        $this->authNeeded = $authNeeded;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAuthNeeded(): ?string
    {
        return $this->authNeeded;
    }

    /**
     * @param string $authUser | null
     *
     * @return static
     */
    public function setAuthUser(?string $authUser = null): self
    {
        $this->authUser = $authUser;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAuthUser(): ?string
    {
        return $this->authUser;
    }

    /**
     * @param string $authPassword | null
     *
     * @return static
     */
    public function setAuthPassword(?string $authPassword = null): self
    {
        $this->authPassword = $authPassword;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAuthPassword(): ?string
    {
        return $this->authPassword;
    }

    /**
     * @param string $sipProxy | null
     *
     * @return static
     */
    public function setSipProxy(?string $sipProxy = null): self
    {
        $this->sipProxy = $sipProxy;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSipProxy(): ?string
    {
        return $this->sipProxy;
    }

    /**
     * @param string $outboundProxy | null
     *
     * @return static
     */
    public function setOutboundProxy(?string $outboundProxy = null): self
    {
        $this->outboundProxy = $outboundProxy;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getOutboundProxy(): ?string
    {
        return $this->outboundProxy;
    }

    /**
     * @param string $fromUser | null
     *
     * @return static
     */
    public function setFromUser(?string $fromUser = null): self
    {
        $this->fromUser = $fromUser;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFromUser(): ?string
    {
        return $this->fromUser;
    }

    /**
     * @param string $fromDomain | null
     *
     * @return static
     */
    public function setFromDomain(?string $fromDomain = null): self
    {
        $this->fromDomain = $fromDomain;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFromDomain(): ?string
    {
        return $this->fromDomain;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param CarrierDto | null
     *
     * @return static
     */
    public function setCarrier(?CarrierDto $carrier = null): self
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * @return CarrierDto | null
     */
    public function getCarrier(): ?CarrierDto
    {
        return $this->carrier;
    }

    /**
     * @return static
     */
    public function setCarrierId($id): self
    {
        $value = !is_null($id)
            ? new CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    /**
     * @return mixed | null
     */
    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param BrandDto | null
     *
     * @return static
     */
    public function setBrand(?BrandDto $brand = null): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return BrandDto | null
     */
    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    /**
     * @return static
     */
    public function setBrandId($id): self
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return mixed | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param TrunksLcrGatewayDto | null
     *
     * @return static
     */
    public function setLcrGateway(?TrunksLcrGatewayDto $lcrGateway = null): self
    {
        $this->lcrGateway = $lcrGateway;

        return $this;
    }

    /**
     * @return TrunksLcrGatewayDto | null
     */
    public function getLcrGateway(): ?TrunksLcrGatewayDto
    {
        return $this->lcrGateway;
    }

    /**
     * @return static
     */
    public function setLcrGatewayId($id): self
    {
        $value = !is_null($id)
            ? new TrunksLcrGatewayDto($id)
            : null;

        return $this->setLcrGateway($value);
    }

    /**
     * @return mixed | null
     */
    public function getLcrGatewayId()
    {
        if ($dto = $this->getLcrGateway()) {
            return $dto->getId();
        }

        return null;
    }

}
