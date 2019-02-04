<?php

namespace Ivoz\Provider\Domain\Model\CarrierServer;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class CarrierServerDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $ip;

    /**
     * @var string
     */
    private $hostname;

    /**
     * @var integer
     */
    private $port;

    /**
     * @var integer
     */
    private $uriScheme;

    /**
     * @var integer
     */
    private $transport;

    /**
     * @var boolean
     */
    private $sendPAI = 0;

    /**
     * @var boolean
     */
    private $sendRPID = 0;

    /**
     * @var string
     */
    private $authNeeded = 'no';

    /**
     * @var string
     */
    private $authUser;

    /**
     * @var string
     */
    private $authPassword;

    /**
     * @var string
     */
    private $sipProxy;

    /**
     * @var string
     */
    private $outboundProxy;

    /**
     * @var string
     */
    private $fromUser;

    /**
     * @var string
     */
    private $fromDomain;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayDto | null
     */
    private $lcrGateway;

    /**
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierDto | null
     */
    private $carrier;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
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
            'lcrGatewayId' => 'lcrGateway',
            'carrierId' => 'carrier',
            'brandId' => 'brand'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
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
            'lcrGateway' => $this->getLcrGateway(),
            'carrier' => $this->getCarrier(),
            'brand' => $this->getBrand()
        ];
    }

    /**
     * @param string $ip
     *
     * @return static
     */
    public function setIp($ip = null)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $hostname
     *
     * @return static
     */
    public function setHostname($hostname = null)
    {
        $this->hostname = $hostname;

        return $this;
    }

    /**
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * @param integer $port
     *
     * @return static
     */
    public function setPort($port = null)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param integer $uriScheme
     *
     * @return static
     */
    public function setUriScheme($uriScheme = null)
    {
        $this->uriScheme = $uriScheme;

        return $this;
    }

    /**
     * @return integer
     */
    public function getUriScheme()
    {
        return $this->uriScheme;
    }

    /**
     * @param integer $transport
     *
     * @return static
     */
    public function setTransport($transport = null)
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @param boolean $sendPAI
     *
     * @return static
     */
    public function setSendPAI($sendPAI = null)
    {
        $this->sendPAI = $sendPAI;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getSendPAI()
    {
        return $this->sendPAI;
    }

    /**
     * @param boolean $sendRPID
     *
     * @return static
     */
    public function setSendRPID($sendRPID = null)
    {
        $this->sendRPID = $sendRPID;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getSendRPID()
    {
        return $this->sendRPID;
    }

    /**
     * @param string $authNeeded
     *
     * @return static
     */
    public function setAuthNeeded($authNeeded = null)
    {
        $this->authNeeded = $authNeeded;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthNeeded()
    {
        return $this->authNeeded;
    }

    /**
     * @param string $authUser
     *
     * @return static
     */
    public function setAuthUser($authUser = null)
    {
        $this->authUser = $authUser;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthUser()
    {
        return $this->authUser;
    }

    /**
     * @param string $authPassword
     *
     * @return static
     */
    public function setAuthPassword($authPassword = null)
    {
        $this->authPassword = $authPassword;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->authPassword;
    }

    /**
     * @param string $sipProxy
     *
     * @return static
     */
    public function setSipProxy($sipProxy = null)
    {
        $this->sipProxy = $sipProxy;

        return $this;
    }

    /**
     * @return string
     */
    public function getSipProxy()
    {
        return $this->sipProxy;
    }

    /**
     * @param string $outboundProxy
     *
     * @return static
     */
    public function setOutboundProxy($outboundProxy = null)
    {
        $this->outboundProxy = $outboundProxy;

        return $this;
    }

    /**
     * @return string
     */
    public function getOutboundProxy()
    {
        return $this->outboundProxy;
    }

    /**
     * @param string $fromUser
     *
     * @return static
     */
    public function setFromUser($fromUser = null)
    {
        $this->fromUser = $fromUser;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromUser()
    {
        return $this->fromUser;
    }

    /**
     * @param string $fromDomain
     *
     * @return static
     */
    public function setFromDomain($fromDomain = null)
    {
        $this->fromDomain = $fromDomain;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromDomain()
    {
        return $this->fromDomain;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayDto $lcrGateway
     *
     * @return static
     */
    public function setLcrGateway(\Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayDto $lcrGateway = null)
    {
        $this->lcrGateway = $lcrGateway;

        return $this;
    }

    /**
     * @return \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayDto
     */
    public function getLcrGateway()
    {
        return $this->lcrGateway;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setLcrGatewayId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayDto($id)
            : null;

        return $this->setLcrGateway($value);
    }

    /**
     * @return integer | null
     */
    public function getLcrGatewayId()
    {
        if ($dto = $this->getLcrGateway()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierDto $carrier
     *
     * @return static
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierDto $carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierDto
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCarrierId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Carrier\CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    /**
     * @return integer | null
     */
    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandDto $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandDto $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandDto
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setBrandId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Brand\BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return integer | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }
}
