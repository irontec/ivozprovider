<?php

namespace Ivoz\Provider\Domain\Model\LcrGateway;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class LcrGatewayDTO implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $lcrId = '1';

    /**
     * @var string
     */
    private $gwName;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var string
     */
    private $hostname;

    /**
     * @var integer
     */
    private $port;

    /**
     * @var string
     */
    private $params;

    /**
     * @var boolean
     */
    private $uriScheme;

    /**
     * @var boolean
     */
    private $transport;

    /**
     * @var boolean
     */
    private $strip;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @var string
     */
    private $tag;

    /**
     * @var integer
     */
    private $flags = '0';

    /**
     * @var integer
     */
    private $defunct;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $peerServerId;

    /**
     * @var mixed
     */
    private $peerServer;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'lcrId' => $this->getLcrId(),
            'gwName' => $this->getGwName(),
            'ip' => $this->getIp(),
            'hostname' => $this->getHostname(),
            'port' => $this->getPort(),
            'params' => $this->getParams(),
            'uriScheme' => $this->getUriScheme(),
            'transport' => $this->getTransport(),
            'strip' => $this->getStrip(),
            'prefix' => $this->getPrefix(),
            'tag' => $this->getTag(),
            'flags' => $this->getFlags(),
            'defunct' => $this->getDefunct(),
            'id' => $this->getId(),
            'peerServerId' => $this->getPeerServerId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->peerServer = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\PeerServer\\PeerServer', $this->getPeerServerId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param integer $lcrId
     *
     * @return LcrGatewayDTO
     */
    public function setLcrId($lcrId)
    {
        $this->lcrId = $lcrId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getLcrId()
    {
        return $this->lcrId;
    }

    /**
     * @param string $gwName
     *
     * @return LcrGatewayDTO
     */
    public function setGwName($gwName)
    {
        $this->gwName = $gwName;

        return $this;
    }

    /**
     * @return string
     */
    public function getGwName()
    {
        return $this->gwName;
    }

    /**
     * @param string $ip
     *
     * @return LcrGatewayDTO
     */
    public function setIp($ip = null)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $hostname
     *
     * @return LcrGatewayDTO
     */
    public function setHostname($hostname = null)
    {
        $this->hostname = $hostname;

        return $this;
    }

    /**
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * @param integer $port
     *
     * @return LcrGatewayDTO
     */
    public function setPort($port = null)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param string $params
     *
     * @return LcrGatewayDTO
     */
    public function setParams($params = null)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * @return string
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param boolean $uriScheme
     *
     * @return LcrGatewayDTO
     */
    public function setUriScheme($uriScheme = null)
    {
        $this->uriScheme = $uriScheme;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getUriScheme()
    {
        return $this->uriScheme;
    }

    /**
     * @param boolean $transport
     *
     * @return LcrGatewayDTO
     */
    public function setTransport($transport = null)
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @param boolean $strip
     *
     * @return LcrGatewayDTO
     */
    public function setStrip($strip = null)
    {
        $this->strip = $strip;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getStrip()
    {
        return $this->strip;
    }

    /**
     * @param string $prefix
     *
     * @return LcrGatewayDTO
     */
    public function setPrefix($prefix = null)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $tag
     *
     * @return LcrGatewayDTO
     */
    public function setTag($tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param integer $flags
     *
     * @return LcrGatewayDTO
     */
    public function setFlags($flags)
    {
        $this->flags = $flags;

        return $this;
    }

    /**
     * @return integer
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * @param integer $defunct
     *
     * @return LcrGatewayDTO
     */
    public function setDefunct($defunct = null)
    {
        $this->defunct = $defunct;

        return $this;
    }

    /**
     * @return integer
     */
    public function getDefunct()
    {
        return $this->defunct;
    }

    /**
     * @param integer $id
     *
     * @return LcrGatewayDTO
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $peerServerId
     *
     * @return LcrGatewayDTO
     */
    public function setPeerServerId($peerServerId)
    {
        $this->peerServerId = $peerServerId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPeerServerId()
    {
        return $this->peerServerId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\PeerServer\PeerServer
     */
    public function getPeerServer()
    {
        return $this->peerServer;
    }
}


