<?php

namespace Ivoz\Provider\Domain\Model\LcrGateway;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * LcrGatewayAbstract
 * @codeCoverageIgnore
 */
abstract class LcrGatewayAbstract
{
    /**
     * @column lcr_id
     * @var integer
     */
    protected $lcrId = '1';

    /**
     * @column gw_name
     * @var string
     */
    protected $gwName;

    /**
     * @var string
     */
    protected $ip;

    /**
     * @var string
     */
    protected $hostname;

    /**
     * @var integer
     */
    protected $port;

    /**
     * @var string
     */
    protected $params;

    /**
     * @column uri_scheme
     * @var boolean
     */
    protected $uriScheme;

    /**
     * @var boolean
     */
    protected $transport;

    /**
     * @var boolean
     */
    protected $strip;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var string
     */
    protected $tag;

    /**
     * @var integer
     */
    protected $flags = '0';

    /**
     * @var integer
     */
    protected $defunct;

    /**
     * @var \Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface
     */
    protected $peerServer;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($lcrId, $gwName, $flags)
    {
        $this->setLcrId($lcrId);
        $this->setGwName($gwName);
        $this->setFlags($flags);

        $this->initChangelog();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$fieldName] != $this->_initialValues[$fieldName];
    }

    public function getInitialValue($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }

        return $this->_initialValues[$fieldName];
    }

    /**
     * @return LcrGatewayDTO
     */
    public static function createDTO()
    {
        return new LcrGatewayDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto LcrGatewayDTO
         */
        Assertion::isInstanceOf($dto, LcrGatewayDTO::class);

        $self = new static(
            $dto->getLcrId(),
            $dto->getGwName(),
            $dto->getFlags());

        return $self
            ->setIp($dto->getIp())
            ->setHostname($dto->getHostname())
            ->setPort($dto->getPort())
            ->setParams($dto->getParams())
            ->setUriScheme($dto->getUriScheme())
            ->setTransport($dto->getTransport())
            ->setStrip($dto->getStrip())
            ->setPrefix($dto->getPrefix())
            ->setTag($dto->getTag())
            ->setDefunct($dto->getDefunct())
            ->setPeerServer($dto->getPeerServer())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto LcrGatewayDTO
         */
        Assertion::isInstanceOf($dto, LcrGatewayDTO::class);

        $this
            ->setLcrId($dto->getLcrId())
            ->setGwName($dto->getGwName())
            ->setIp($dto->getIp())
            ->setHostname($dto->getHostname())
            ->setPort($dto->getPort())
            ->setParams($dto->getParams())
            ->setUriScheme($dto->getUriScheme())
            ->setTransport($dto->getTransport())
            ->setStrip($dto->getStrip())
            ->setPrefix($dto->getPrefix())
            ->setTag($dto->getTag())
            ->setFlags($dto->getFlags())
            ->setDefunct($dto->getDefunct())
            ->setPeerServer($dto->getPeerServer());


        return $this;
    }

    /**
     * @return LcrGatewayDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setLcrId($this->getLcrId())
            ->setGwName($this->getGwName())
            ->setIp($this->getIp())
            ->setHostname($this->getHostname())
            ->setPort($this->getPort())
            ->setParams($this->getParams())
            ->setUriScheme($this->getUriScheme())
            ->setTransport($this->getTransport())
            ->setStrip($this->getStrip())
            ->setPrefix($this->getPrefix())
            ->setTag($this->getTag())
            ->setFlags($this->getFlags())
            ->setDefunct($this->getDefunct())
            ->setPeerServerId($this->getPeerServer() ? $this->getPeerServer()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
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
            'peerServerId' => $this->getPeerServer() ? $this->getPeerServer()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set lcrId
     *
     * @param integer $lcrId
     *
     * @return self
     */
    public function setLcrId($lcrId)
    {
        Assertion::notNull($lcrId);
        Assertion::integerish($lcrId);
        Assertion::greaterOrEqualThan($lcrId, 0);

        $this->lcrId = $lcrId;

        return $this;
    }

    /**
     * Get lcrId
     *
     * @return integer
     */
    public function getLcrId()
    {
        return $this->lcrId;
    }

    /**
     * Set gwName
     *
     * @param string $gwName
     *
     * @return self
     */
    public function setGwName($gwName)
    {
        Assertion::notNull($gwName);
        Assertion::maxLength($gwName, 200);

        $this->gwName = $gwName;

        return $this;
    }

    /**
     * Get gwName
     *
     * @return string
     */
    public function getGwName()
    {
        return $this->gwName;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return self
     */
    public function setIp($ip = null)
    {
        if (!is_null($ip)) {
            Assertion::maxLength($ip, 50);
        }

        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set hostname
     *
     * @param string $hostname
     *
     * @return self
     */
    public function setHostname($hostname = null)
    {
        if (!is_null($hostname)) {
            Assertion::maxLength($hostname, 64);
        }

        $this->hostname = $hostname;

        return $this;
    }

    /**
     * Get hostname
     *
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * Set port
     *
     * @param integer $port
     *
     * @return self
     */
    public function setPort($port = null)
    {
        if (!is_null($port)) {
            if (!is_null($port)) {
                Assertion::integerish($port);
                Assertion::greaterOrEqualThan($port, 0);
            }
        }

        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return integer
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set params
     *
     * @param string $params
     *
     * @return self
     */
    public function setParams($params = null)
    {
        if (!is_null($params)) {
            Assertion::maxLength($params, 64);
        }

        $this->params = $params;

        return $this;
    }

    /**
     * Get params
     *
     * @return string
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set uriScheme
     *
     * @param boolean $uriScheme
     *
     * @return self
     */
    public function setUriScheme($uriScheme = null)
    {
        if (!is_null($uriScheme)) {
            Assertion::between(intval($uriScheme), 0, 1);
        }

        $this->uriScheme = $uriScheme;

        return $this;
    }

    /**
     * Get uriScheme
     *
     * @return boolean
     */
    public function getUriScheme()
    {
        return $this->uriScheme;
    }

    /**
     * Set transport
     *
     * @param boolean $transport
     *
     * @return self
     */
    public function setTransport($transport = null)
    {
        if (!is_null($transport)) {
            Assertion::between(intval($transport), 0, 1);
        }

        $this->transport = $transport;

        return $this;
    }

    /**
     * Get transport
     *
     * @return boolean
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Set strip
     *
     * @param boolean $strip
     *
     * @return self
     */
    public function setStrip($strip = null)
    {
        if (!is_null($strip)) {
            Assertion::between(intval($strip), 0, 1);
        }

        $this->strip = $strip;

        return $this;
    }

    /**
     * Get strip
     *
     * @return boolean
     */
    public function getStrip()
    {
        return $this->strip;
    }

    /**
     * Set prefix
     *
     * @param string $prefix
     *
     * @return self
     */
    public function setPrefix($prefix = null)
    {
        if (!is_null($prefix)) {
            Assertion::maxLength($prefix, 16);
        }

        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return self
     */
    public function setTag($tag = null)
    {
        if (!is_null($tag)) {
            Assertion::maxLength($tag, 64);
        }

        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set flags
     *
     * @param integer $flags
     *
     * @return self
     */
    public function setFlags($flags)
    {
        Assertion::notNull($flags);
        Assertion::integerish($flags);
        Assertion::greaterOrEqualThan($flags, 0);

        $this->flags = $flags;

        return $this;
    }

    /**
     * Get flags
     *
     * @return integer
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * Set defunct
     *
     * @param integer $defunct
     *
     * @return self
     */
    public function setDefunct($defunct = null)
    {
        if (!is_null($defunct)) {
            if (!is_null($defunct)) {
                Assertion::integerish($defunct);
                Assertion::greaterOrEqualThan($defunct, 0);
            }
        }

        $this->defunct = $defunct;

        return $this;
    }

    /**
     * Get defunct
     *
     * @return integer
     */
    public function getDefunct()
    {
        return $this->defunct;
    }

    /**
     * Set peerServer
     *
     * @param \Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface $peerServer
     *
     * @return self
     */
    public function setPeerServer(\Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface $peerServer = null)
    {
        $this->peerServer = $peerServer;

        return $this;
    }

    /**
     * Get peerServer
     *
     * @return \Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface
     */
    public function getPeerServer()
    {
        return $this->peerServer;
    }



    // @codeCoverageIgnoreEnd
}

