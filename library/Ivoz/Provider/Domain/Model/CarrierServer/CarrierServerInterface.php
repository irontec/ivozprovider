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
     * @return string | null
     */
    public function getIp();

    /**
     * Get hostname
     *
     * @return string | null
     */
    public function getHostname();

    /**
     * Get port
     *
     * @return integer | null
     */
    public function getPort();

    /**
     * Get uriScheme
     *
     * @return integer | null
     */
    public function getUriScheme();

    /**
     * Get transport
     *
     * @return integer | null
     */
    public function getTransport();

    /**
     * Get sendPAI
     *
     * @return boolean | null
     */
    public function getSendPAI();

    /**
     * Get sendRPID
     *
     * @return boolean | null
     */
    public function getSendRPID();

    /**
     * Get authNeeded
     *
     * @return string
     */
    public function getAuthNeeded(): string;

    /**
     * Get authUser
     *
     * @return string | null
     */
    public function getAuthUser();

    /**
     * Get authPassword
     *
     * @return string | null
     */
    public function getAuthPassword();

    /**
     * Get sipProxy
     *
     * @return string | null
     */
    public function getSipProxy();

    /**
     * Get outboundProxy
     *
     * @return string | null
     */
    public function getOutboundProxy();

    /**
     * Get fromUser
     *
     * @return string | null
     */
    public function getFromUser();

    /**
     * Get fromDomain
     *
     * @return string | null
     */
    public function getFromDomain();

    /**
     * Get lcrGateway
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface | null
     */
    public function getLcrGateway();

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier
     *
     * @return static
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier);

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    public function getCarrier();

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
