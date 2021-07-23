<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrGateway;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;

/**
* TrunksLcrGatewayInterface
*/
interface TrunksLcrGatewayInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function getLcrId(): int;

    public function getGwName(): string;

    public function getIp(): ?string;

    public function getHostname(): ?string;

    public function getPort(): ?int;

    public function getParams(): ?string;

    public function getUriScheme(): ?int;

    public function getTransport(): ?int;

    public function getStrip(): ?bool;

    public function getPrefix(): ?string;

    public function getTag(): ?string;

    public function getDefunct(): ?int;

    public function setCarrierServer(?CarrierServerInterface $carrierServer = null): static;

    public function getCarrierServer(): ?CarrierServerInterface;

    public function isInitialized(): bool;
}
