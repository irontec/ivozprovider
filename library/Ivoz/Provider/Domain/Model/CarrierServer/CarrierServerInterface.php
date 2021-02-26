<?php

namespace Ivoz\Provider\Domain\Model\CarrierServer;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;

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
    public function setIp(?string $ip = null): static;

    public function getName();

    public function getIp(): ?string;

    public function getHostname(): ?string;

    public function getPort(): ?int;

    public function getUriScheme(): ?int;

    public function getTransport(): ?int;

    public function getSendPAI(): ?bool;

    public function getSendRPID(): ?bool;

    public function getAuthNeeded(): string;

    public function getAuthUser(): ?string;

    public function getAuthPassword(): ?string;

    public function getSipProxy(): ?string;

    public function getOutboundProxy(): ?string;

    public function getFromUser(): ?string;

    public function getFromDomain(): ?string;

    public function setCarrier(CarrierInterface $carrier): static;

    public function getCarrier(): CarrierInterface;

    public function getBrand(): BrandInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    public function setLcrGateway(TrunksLcrGatewayInterface $lcrGateway): static;

    public function getLcrGateway(): ?TrunksLcrGatewayInterface;

}
