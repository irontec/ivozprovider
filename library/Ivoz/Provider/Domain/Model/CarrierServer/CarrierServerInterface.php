<?php

namespace Ivoz\Provider\Domain\Model\CarrierServer;

use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* CarrierServerInterface
*/
interface CarrierServerInterface extends LoggableEntityInterface
{
    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setIp(string $ip = null): CarrierServerInterface;

    public function getName();

    /**
     * Get ip
     *
     * @return string | null
     */
    public function getIp(): ?string;

    /**
     * Get hostname
     *
     * @return string | null
     */
    public function getHostname(): ?string;

    /**
     * Get port
     *
     * @return int | null
     */
    public function getPort(): ?int;

    /**
     * Get uriScheme
     *
     * @return int | null
     */
    public function getUriScheme(): ?int;

    /**
     * Get transport
     *
     * @return int | null
     */
    public function getTransport(): ?int;

    /**
     * Get sendPAI
     *
     * @return bool | null
     */
    public function getSendPAI(): ?bool;

    /**
     * Get sendRPID
     *
     * @return bool | null
     */
    public function getSendRPID(): ?bool;

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
    public function getAuthUser(): ?string;

    /**
     * Get authPassword
     *
     * @return string | null
     */
    public function getAuthPassword(): ?string;

    /**
     * Get sipProxy
     *
     * @return string | null
     */
    public function getSipProxy(): ?string;

    /**
     * Get outboundProxy
     *
     * @return string | null
     */
    public function getOutboundProxy(): ?string;

    /**
     * Get fromUser
     *
     * @return string | null
     */
    public function getFromUser(): ?string;

    /**
     * Get fromDomain
     *
     * @return string | null
     */
    public function getFromDomain(): ?string;

    /**
     * Set carrier
     *
     * @param CarrierInterface
     *
     * @return static
     */
    public function setCarrier(CarrierInterface $carrier): CarrierServerInterface;

    /**
     * Get carrier
     *
     * @return CarrierInterface
     */
    public function getCarrier(): CarrierInterface;

    /**
     * Get brand
     *
     * @return BrandInterface
     */
    public function getBrand(): BrandInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * @var TrunksLcrGatewayInterface
     * mappedBy carrierServer
     */
    public function setLcrGateway(TrunksLcrGatewayInterface $lcrGateway): CarrierServerInterface;

    /**
     * Get lcrGateway
     * @return TrunksLcrGatewayInterface
     */
    public function getLcrGateway(): ?TrunksLcrGatewayInterface;

}
