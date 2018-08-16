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
     * @deprecated
     * Set lcrId
     *
     * @param integer $lcrId
     *
     * @return self
     */
    public function setLcrId($lcrId);

    /**
     * Get lcrId
     *
     * @return integer
     */
    public function getLcrId();

    /**
     * @deprecated
     * Set gwName
     *
     * @param string $gwName
     *
     * @return self
     */
    public function setGwName($gwName);

    /**
     * Get gwName
     *
     * @return string
     */
    public function getGwName();

    /**
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
     * Set tag
     *
     * @param string $tag
     *
     * @return self
     */
    public function setTag($tag = null);

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag();

    /**
     * @deprecated
     * Set defunct
     *
     * @param integer $defunct
     *
     * @return self
     */
    public function setDefunct($defunct = null);

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

