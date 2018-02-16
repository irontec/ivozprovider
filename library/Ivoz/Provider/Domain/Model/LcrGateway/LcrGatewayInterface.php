<?php

namespace Ivoz\Provider\Domain\Model\LcrGateway;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface LcrGatewayInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
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
     * Set uriScheme
     *
     * @param boolean $uriScheme
     *
     * @return self
     */
    public function setUriScheme($uriScheme = null);

    /**
     * Get uriScheme
     *
     * @return boolean
     */
    public function getUriScheme();

    /**
     * Set transport
     *
     * @param boolean $transport
     *
     * @return self
     */
    public function setTransport($transport = null);

    /**
     * Get transport
     *
     * @return boolean
     */
    public function getTransport();

    /**
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
     * Set flags
     *
     * @param integer $flags
     *
     * @return self
     */
    public function setFlags($flags);

    /**
     * Get flags
     *
     * @return integer
     */
    public function getFlags();

    /**
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
     * Set peerServer
     *
     * @param \Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface $peerServer
     *
     * @return self
     */
    public function setPeerServer(\Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface $peerServer);

    /**
     * Get peerServer
     *
     * @return \Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface
     */
    public function getPeerServer();

}

