<?php

namespace Ivoz\Provider\Domain\Model\PeerServer;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class PeerServerDTO implements DataTransferObjectInterface
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
     * @var string
     */
    private $params;

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
    private $strip;

    /**
     * @var string
     */
    private $prefix;

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
     * @var mixed
     */
    private $peeringContractId;

    /**
     * @var mixed
     */
    private $brandId;

    /**
     * @var mixed
     */
    private $peeringContract;

    /**
     * @var mixed
     */
    private $brand;

    /**
     * @var array|null
     */
    private $lcrGateways = null;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'ip' => $this->getIp(),
            'hostname' => $this->getHostname(),
            'port' => $this->getPort(),
            'params' => $this->getParams(),
            'uriScheme' => $this->getUriScheme(),
            'transport' => $this->getTransport(),
            'strip' => $this->getStrip(),
            'prefix' => $this->getPrefix(),
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
            'peeringContractId' => $this->getPeeringContractId(),
            'brandId' => $this->getBrandId(),
            'lcrGateways' => $this->getLcrGateways()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->peeringContract = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\PeeringContract\\PeeringContract', $this->getPeeringContractId());
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
        if (!is_null($this->lcrGateways)) {
            $items = $this->getLcrGateways();
            $this->lcrGateways = [];
            foreach ($items as $item) {
                $this->lcrGateways[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\LcrGateway\\LcrGateway',
                    $item->getId() ?? $item
                );
            }
        }

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {
        $this->lcrGateways = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\LcrGateway\\LcrGateway',
            $this->lcrGateways
        );
    }

    /**
     * @param string $ip
     *
     * @return PeerServerDTO
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
     * @return PeerServerDTO
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
     * @return PeerServerDTO
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
     * @param string $params
     *
     * @return PeerServerDTO
     */
    public function setParams($params = null)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * @return string
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param boolean $uriScheme
     *
     * @return PeerServerDTO
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
     * @return PeerServerDTO
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
     * @param boolean $strip
     *
     * @return PeerServerDTO
     */
    public function setStrip($strip = null)
    {
        $this->strip = $strip;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getStrip()
    {
        return $this->strip;
    }

    /**
     * @param string $prefix
     *
     * @return PeerServerDTO
     */
    public function setPrefix($prefix = null)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param boolean $sendPAI
     *
     * @return PeerServerDTO
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
     * @return PeerServerDTO
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
     * @return PeerServerDTO
     */
    public function setAuthNeeded($authNeeded)
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
     * @return PeerServerDTO
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
     * @return PeerServerDTO
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
     * @return PeerServerDTO
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
     * @return PeerServerDTO
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
     * @return PeerServerDTO
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
     * @return PeerServerDTO
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
     * @return PeerServerDTO
     */
    public function setId($id)
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
     * @param integer $peeringContractId
     *
     * @return PeerServerDTO
     */
    public function setPeeringContractId($peeringContractId)
    {
        $this->peeringContractId = $peeringContractId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPeeringContractId()
    {
        return $this->peeringContractId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContract
     */
    public function getPeeringContract()
    {
        return $this->peeringContract;
    }

    /**
     * @param integer $brandId
     *
     * @return PeerServerDTO
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param array $lcrGateways
     *
     * @return PeerServerDTO
     */
    public function setLcrGateways($lcrGateways)
    {
        $this->lcrGateways = $lcrGateways;

        return $this;
    }

    /**
     * @return array
     */
    public function getLcrGateways()
    {
        return $this->lcrGateways;
    }
}


