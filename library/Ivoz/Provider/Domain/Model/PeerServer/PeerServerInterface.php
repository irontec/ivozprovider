<?php

namespace Ivoz\Provider\Domain\Model\PeerServer;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface PeerServerInterface extends LoggableEntityInterface
{
    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setIp($ip = null);

    public function getName();

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
     * Set uriScheme
     *
     * @param integer $uriScheme
     *
     * @return self
     */
    public function setUriScheme($uriScheme = null);

    /**
     * Get uriScheme
     *
     * @return integer
     */
    public function getUriScheme();

    /**
     * Set transport
     *
     * @param integer $transport
     *
     * @return self
     */
    public function setTransport($transport = null);

    /**
     * Get transport
     *
     * @return integer
     */
    public function getTransport();

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
     * Set lcrGateway
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface $lcrGateway
     *
     * @return self
     */
    public function setLcrGateway(\Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface $lcrGateway = null);

    /**
     * Get lcrGateway
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface
     */
    public function getLcrGateway();

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

}

