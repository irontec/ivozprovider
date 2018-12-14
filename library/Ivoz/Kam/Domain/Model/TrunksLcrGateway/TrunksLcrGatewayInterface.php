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
     * Get params
     *
     * @return string | null
     */
    public function getParams();

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
     * Get strip
     *
     * @return boolean | null
     */
    public function getStrip();

    /**
     * Get prefix
     *
     * @return string | null
     */
    public function getPrefix();

    /**
     * Get tag
     *
     * @return string | null
     */
    public function getTag();

    /**
     * Get defunct
     *
     * @return integer | null
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
     * @return \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface | null
     */
    public function getCarrierServer();
}
