<?php

namespace Ivoz\Provider\Domain\Model\PeerServer;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class PeerServerDtoAbstract implements DataTransferObjectInterface
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
     * @var boolean
     */
    private $uriScheme;

    /**
     * @var boolean
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
     * @var \Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayDto | null
     */
    private $lcrGateway;

    /**
     * @var \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto | null
     */
    private $peeringContract;

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
            'peeringContractId' => 'peeringContract',
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
            'peeringContract' => $this->getPeeringContract(),
            'brand' => $this->getBrand()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->lcrGateway = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\LcrGateway\\LcrGateway', $this->getLcrGatewayId());
        $this->peeringContract = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\PeeringContract\\PeeringContract', $this->getPeeringContractId());
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

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
     * @param boolean $uriScheme
     *
     * @return static
     */
    public function setUriScheme($uriScheme = null)
    {
        $this->uriScheme = $uriScheme;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getUriScheme()
    {
        return $this->uriScheme;
    }

    /**
     * @param boolean $transport
     *
     * @return static
     */
    public function setTransport($transport = null)
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * @return boolean
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
     * @param \Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayDto $lcrGateway
     *
     * @return static
     */
    public function setLcrGateway(\Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayDto $lcrGateway = null)
    {
        $this->lcrGateway = $lcrGateway;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayDto
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
            ? new \Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto $peeringContract
     *
     * @return static
     */
    public function setPeeringContract(\Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto $peeringContract = null)
    {
        $this->peeringContract = $peeringContract;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto
     */
    public function getPeeringContract()
    {
        return $this->peeringContract;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setPeeringContractId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractDto($id)
            : null;

        return $this->setPeeringContract($value);
    }

    /**
     * @return integer | null
     */
    public function getPeeringContractId()
    {
        if ($dto = $this->getPeeringContract()) {
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


