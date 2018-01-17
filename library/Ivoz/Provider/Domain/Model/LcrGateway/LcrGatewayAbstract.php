<?php

namespace Ivoz\Provider\Domain\Model\LcrGateway;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * LcrGatewayAbstract
 * @codeCoverageIgnore
 */
abstract class LcrGatewayAbstract
{
    /**
     * column: lcr_id
     * @var integer
     */
    protected $lcrId = '1';

    /**
     * column: gw_name
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
     * column: uri_scheme
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


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($lcrId, $gwName, $flags)
    {
        $this->setLcrId($lcrId);
        $this->setGwName($gwName);
        $this->setFlags($flags);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "LcrGateway",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return LcrGatewayDto
     */
    public static function createDto($id = null)
    {
        return new LcrGatewayDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return LcrGatewayDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, LcrGatewayInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto LcrGatewayDto
         */
        Assertion::isInstanceOf($dto, LcrGatewayDto::class);

        $self = new static(
            $dto->getLcrId(),
            $dto->getGwName(),
            $dto->getFlags());

        $self
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

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto LcrGatewayDto
         */
        Assertion::isInstanceOf($dto, LcrGatewayDto::class);

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



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return LcrGatewayDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
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
            ->setPeerServer(\Ivoz\Provider\Domain\Model\PeerServer\PeerServer::entityToDto($this->getPeerServer(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'lcr_id' => self::getLcrId(),
            'gw_name' => self::getGwName(),
            'ip' => self::getIp(),
            'hostname' => self::getHostname(),
            'port' => self::getPort(),
            'params' => self::getParams(),
            'uri_scheme' => self::getUriScheme(),
            'transport' => self::getTransport(),
            'strip' => self::getStrip(),
            'prefix' => self::getPrefix(),
            'tag' => self::getTag(),
            'flags' => self::getFlags(),
            'defunct' => self::getDefunct(),
            'peerServerId' => self::getPeerServer() ? self::getPeerServer()->getId() : null
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
        Assertion::notNull($lcrId, 'lcrId value "%s" is null, but non null value was expected.');
        Assertion::integerish($lcrId, 'lcrId value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($lcrId, 0, 'lcrId provided "%s" is not greater or equal than "%s".');

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
        Assertion::notNull($gwName, 'gwName value "%s" is null, but non null value was expected.');
        Assertion::maxLength($gwName, 200, 'gwName value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
            Assertion::maxLength($ip, 50, 'ip value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
            Assertion::maxLength($hostname, 64, 'hostname value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
                Assertion::integerish($port, 'port value "%s" is not an integer or a number castable to integer.');
                Assertion::greaterOrEqualThan($port, 0, 'port provided "%s" is not greater or equal than "%s".');
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
            Assertion::maxLength($params, 64, 'params value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
            Assertion::between(intval($uriScheme), 0, 1, 'uriScheme provided "%s" is not a valid boolean value.');
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
            Assertion::between(intval($transport), 0, 1, 'transport provided "%s" is not a valid boolean value.');
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
            Assertion::between(intval($strip), 0, 1, 'strip provided "%s" is not a valid boolean value.');
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
            Assertion::maxLength($prefix, 16, 'prefix value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
            Assertion::maxLength($tag, 64, 'tag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
        Assertion::notNull($flags, 'flags value "%s" is null, but non null value was expected.');
        Assertion::integerish($flags, 'flags value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($flags, 0, 'flags provided "%s" is not greater or equal than "%s".');

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
                Assertion::integerish($defunct, 'defunct value "%s" is not an integer or a number castable to integer.');
                Assertion::greaterOrEqualThan($defunct, 0, 'defunct provided "%s" is not greater or equal than "%s".');
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
    public function setPeerServer(\Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface $peerServer)
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

