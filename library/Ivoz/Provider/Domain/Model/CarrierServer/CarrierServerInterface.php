<?php

namespace Ivoz\Provider\Domain\Model\CarrierServer;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface CarrierServerInterface extends LoggableEntityInterface
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
     * Get hostname
     *
     * @return string
     */
    public function getHostname();

    /**
     * Get port
     *
     * @return integer
     */
    public function getPort();

    /**
     * Get uriScheme
     *
     * @return integer
     */
    public function getUriScheme();

    /**
     * Get transport
     *
     * @return integer
     */
    public function getTransport();

    /**
     * Get sendPAI
     *
     * @return boolean
     */
    public function getSendPAI();

    /**
     * Get sendRPID
     *
     * @return boolean
     */
    public function getSendRPID();

    /**
     * Get authNeeded
     *
     * @return string
     */
    public function getAuthNeeded();

    /**
     * Get authUser
     *
     * @return string
     */
    public function getAuthUser();

    /**
     * Get authPassword
     *
     * @return string
     */
    public function getAuthPassword();

    /**
     * Get sipProxy
     *
     * @return string
     */
    public function getSipProxy();

    /**
     * Get outboundProxy
     *
     * @return string
     */
    public function getOutboundProxy();

    /**
     * Get fromUser
     *
     * @return string
     */
    public function getFromUser();

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
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier
     *
     * @return self
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null);

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    public function getCarrier();

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
