<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrGateway;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
     * @return integer
     */
    public function getLcrId();

    /**
     * Get gwName
     *
     * @return string
     */
    public function getGwName();

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
     * Get params
     *
     * @return string
     */
    public function getParams();

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
     * Get strip
     *
     * @return boolean
     */
    public function getStrip();

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix();

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag();

    /**
     * Get defunct
     *
     * @return integer
     */
    public function getDefunct();

    /**
     * Set carrierServer
     *
     * @param \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface $carrierServer
     *
     * @return self
     */
    public function setCarrierServer(\Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface $carrierServer);

    /**
     * Get carrierServer
     *
     * @return \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface
     */
    public function getCarrierServer();
}
