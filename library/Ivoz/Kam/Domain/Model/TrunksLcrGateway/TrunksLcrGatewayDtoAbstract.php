<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrGateway;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TrunksLcrGatewayDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $lcrId = 1;

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
     * @var integer
     */
    private $uriScheme;

    /**
     * @var integer
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
    private $defunct;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerDto | null
     */
    private $carrierServer;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'lcrId' => 'lcrId',
            'gwName' => 'gwName',
            'ip' => 'ip',
            'hostname' => 'hostname',
            'port' => 'port',
            'params' => 'params',
            'uriScheme' => 'uriScheme',
            'transport' => 'transport',
            'strip' => 'strip',
            'prefix' => 'prefix',
            'tag' => 'tag',
            'defunct' => 'defunct',
            'id' => 'id',
            'carrierServerId' => 'carrierServer'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
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
            'defunct' => $this->getDefunct(),
            'id' => $this->getId(),
            'carrierServer' => $this->getCarrierServer()
        ];
    }

    /**
     * @param integer $lcrId
     *
     * @return static
     */
    public function setLcrId($lcrId = null)
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
     * @return static
     */
    public function setGwName($gwName = null)
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @return static
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
     * @param integer $uriScheme
     *
     * @return static
     */
    public function setUriScheme($uriScheme = null)
    {
        $this->uriScheme = $uriScheme;

        return $this;
    }

    /**
     * @return integer
     */
    public function getUriScheme()
    {
        return $this->uriScheme;
    }

    /**
     * @param integer $transport
     *
     * @return static
     */
    public function setTransport($transport = null)
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @param boolean $strip
     *
     * @return static
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
     * @return static
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
     * @return static
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
     * @param integer $defunct
     *
     * @return static
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
     * @return static
     */
    public function setId($id = null)
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
     * @param \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerDto $carrierServer
     *
     * @return static
     */
    public function setCarrierServer(\Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerDto $carrierServer = null)
    {
        $this->carrierServer = $carrierServer;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerDto
     */
    public function getCarrierServer()
    {
        return $this->carrierServer;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCarrierServerId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerDto($id)
            : null;

        return $this->setCarrierServer($value);
    }

    /**
     * @return integer | null
     */
    public function getCarrierServerId()
    {
        if ($dto = $this->getCarrierServer()) {
            return $dto->getId();
        }

        return null;
    }
}
