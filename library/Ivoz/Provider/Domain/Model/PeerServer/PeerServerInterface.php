<?php

namespace Ivoz\Provider\Domain\Model\PeerServer;

use Ivoz\Core\Domain\Model\EntityInterface;
use Doctrine\Common\Collections\Collection;

interface PeerServerInterface extends EntityInterface
{
    public function getFlags();

    /**
     * get first lcrGateways
     *
     * @return \Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayInterface
     */
    public function getLcrGateway();

    public function getName();

    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return self
     */
    public function setIp($ip = null);

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp();

    /**
     * Set hostname
     *
     * @param string $hostname
     *
     * @return self
     */
    public function setHostname($hostname = null);

    /**
     * Get hostname
     *
     * @return string
     */
    public function getHostname();

    /**
     * Set port
     *
     * @param integer $port
     *
     * @return self
     */
    public function setPort($port = null);

    /**
     * Get port
     *
     * @return integer
     */
    public function getPort();

    /**
     * Set params
     *
     * @param string $params
     *
     * @return self
     */
    public function setParams($params = null);

    /**
     * Get params
     *
     * @return string
     */
    public function getParams();

    /**
     * Set uriScheme
     *
     * @param boolean $uriScheme
     *
     * @return self
     */
    public function setUriScheme($uriScheme = null);

    /**
     * Get uriScheme
     *
     * @return boolean
     */
    public function getUriScheme();

    /**
     * Set transport
     *
     * @param boolean $transport
     *
     * @return self
     */
    public function setTransport($transport = null);

    /**
     * Get transport
     *
     * @return boolean
     */
    public function getTransport();

    /**
     * Set strip
     *
     * @param boolean $strip
     *
     * @return self
     */
    public function setStrip($strip = null);

    /**
     * Get strip
     *
     * @return boolean
     */
    public function getStrip();

    /**
     * Set prefix
     *
     * @param string $prefix
     *
     * @return self
     */
    public function setPrefix($prefix = null);

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix();

    /**
     * Set sendPAI
     *
     * @param boolean $sendPAI
     *
     * @return self
     */
    public function setSendPAI($sendPAI = null);

    /**
     * Get sendPAI
     *
     * @return boolean
     */
    public function getSendPAI();

    /**
     * Set sendRPID
     *
     * @param boolean $sendRPID
     *
     * @return self
     */
    public function setSendRPID($sendRPID = null);

    /**
     * Get sendRPID
     *
     * @return boolean
     */
    public function getSendRPID();

    /**
     * Set authNeeded
     *
     * @param string $authNeeded
     *
     * @return self
     */
    public function setAuthNeeded($authNeeded);

    /**
     * Get authNeeded
     *
     * @return string
     */
    public function getAuthNeeded();

    /**
     * Set authUser
     *
     * @param string $authUser
     *
     * @return self
     */
    public function setAuthUser($authUser = null);

    /**
     * Get authUser
     *
     * @return string
     */
    public function getAuthUser();

    /**
     * Set authPassword
     *
     * @param string $authPassword
     *
     * @return self
     */
    public function setAuthPassword($authPassword = null);

    /**
     * Get authPassword
     *
     * @return string
     */
    public function getAuthPassword();

    /**
     * Set sipProxy
     *
     * @param string $sipProxy
     *
     * @return self
     */
    public function setSipProxy($sipProxy = null);

    /**
     * Get sipProxy
     *
     * @return string
     */
    public function getSipProxy();

    /**
     * Set outboundProxy
     *
     * @param string $outboundProxy
     *
     * @return self
     */
    public function setOutboundProxy($outboundProxy = null);

    /**
     * Get outboundProxy
     *
     * @return string
     */
    public function getOutboundProxy();

    /**
     * Set fromUser
     *
     * @param string $fromUser
     *
     * @return self
     */
    public function setFromUser($fromUser = null);

    /**
     * Get fromUser
     *
     * @return string
     */
    public function getFromUser();

    /**
     * Set fromDomain
     *
     * @param string $fromDomain
     *
     * @return self
     */
    public function setFromDomain($fromDomain = null);

    /**
     * Get fromDomain
     *
     * @return string
     */
    public function getFromDomain();

    /**
     * Set peeringContract
     *
     * @param \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface $peeringContract
     *
     * @return self
     */
    public function setPeeringContract(\Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface $peeringContract = null);

    /**
     * Get peeringContract
     *
     * @return \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface
     */
    public function getPeeringContract();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Add lcrGateway
     *
     * @param \Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayInterface $lcrGateway
     *
     * @return PeerServerTrait
     */
    public function addLcrGateway(\Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayInterface $lcrGateway);

    /**
     * Remove lcrGateway
     *
     * @param \Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayInterface $lcrGateway
     */
    public function removeLcrGateway(\Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayInterface $lcrGateway);

    /**
     * Replace lcrGateways
     *
     * @param \Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayInterface[] $lcrGateways
     * @return self
     */
    public function replaceLcrGateways(Collection $lcrGateways);

    /**
     * Get lcrGateways
     *
     * @return array
     */
    public function getLcrGateways(\Doctrine\Common\Collections\Criteria $criteria = null);

}

