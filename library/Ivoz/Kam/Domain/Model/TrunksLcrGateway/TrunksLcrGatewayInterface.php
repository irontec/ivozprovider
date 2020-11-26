<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrGateway;

use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServer;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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

    /**
     * Get lcrId
     *
     * @return int
     */
    public function getLcrId(): int;

    /**
     * Get gwName
     *
     * @return string
     */
    public function getGwName(): string;

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
     * Get params
     *
     * @return string | null
     */
    public function getParams(): ?string;

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
     * Get strip
     *
     * @return bool | null
     */
    public function getStrip(): ?bool;

    /**
     * Get prefix
     *
     * @return string | null
     */
    public function getPrefix(): ?string;

    /**
     * Get tag
     *
     * @return string | null
     */
    public function getTag(): ?string;

    /**
     * Get defunct
     *
     * @return int | null
     */
    public function getDefunct(): ?int;

    /**
     * Set carrierServer
     *
     * @param CarrierServer | null
     *
     * @return static
     */
    public function setCarrierServer(?CarrierServer $carrierServer = null): TrunksLcrGatewayInterface;

    /**
     * Get carrierServer
     *
     * @return CarrierServer | null
     */
    public function getCarrierServer(): ?CarrierServer;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
