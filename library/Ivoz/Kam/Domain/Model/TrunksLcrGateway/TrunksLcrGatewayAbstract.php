<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrGateway;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TrunksLcrGatewayAbstract
 * @codeCoverageIgnore
 */
abstract class TrunksLcrGatewayAbstract
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
     * @var string | null
     */
    protected $ip;

    /**
     * @var string | null
     */
    protected $hostname;

    /**
     * @var integer | null
     */
    protected $port;

    /**
     * @var string | null
     */
    protected $params;

    /**
     * column: uri_scheme
     * @var integer | null
     */
    protected $uriScheme;

    /**
     * @var integer | null
     */
    protected $transport;

    /**
     * @var boolean | null
     */
    protected $strip;

    /**
     * @var string | null
     */
    protected $prefix;

    /**
     * @var string | null
     */
    protected $tag;

    /**
     * @var integer | null
     */
    protected $defunct;

    /**
     * @var \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface
     */
    protected $carrierServer;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($lcrId, $gwName)
    {
        $this->setLcrId($lcrId);
        $this->setGwName($gwName);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "TrunksLcrGateway",
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
     * @return TrunksLcrGatewayDto
     */
    public static function createDto($id = null)
    {
        return new TrunksLcrGatewayDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return TrunksLcrGatewayDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TrunksLcrGatewayInterface::class);

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
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TrunksLcrGatewayDto
         */
        Assertion::isInstanceOf($dto, TrunksLcrGatewayDto::class);

        $self = new static(
            $dto->getLcrId(),
            $dto->getGwName()
        );

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
            ->setCarrierServer($dto->getCarrierServer())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TrunksLcrGatewayDto
         */
        Assertion::isInstanceOf($dto, TrunksLcrGatewayDto::class);

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
            ->setDefunct($dto->getDefunct())
            ->setCarrierServer($dto->getCarrierServer());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TrunksLcrGatewayDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setLcrId(self::getLcrId())
            ->setGwName(self::getGwName())
            ->setIp(self::getIp())
            ->setHostname(self::getHostname())
            ->setPort(self::getPort())
            ->setParams(self::getParams())
            ->setUriScheme(self::getUriScheme())
            ->setTransport(self::getTransport())
            ->setStrip(self::getStrip())
            ->setPrefix(self::getPrefix())
            ->setTag(self::getTag())
            ->setDefunct(self::getDefunct())
            ->setCarrierServer(\Ivoz\Provider\Domain\Model\CarrierServer\CarrierServer::entityToDto(self::getCarrierServer(), $depth));
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
            'defunct' => self::getDefunct(),
            'carrierServerId' => self::getCarrierServer() ? self::getCarrierServer()->getId() : null
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
    protected function setLcrId($lcrId)
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
    protected function setGwName($gwName)
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
    protected function setIp($ip = null)
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
     * @return string | null
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
    protected function setHostname($hostname = null)
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
     * @return string | null
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
    protected function setPort($port = null)
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
     * @return integer | null
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
    protected function setParams($params = null)
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
     * @return string | null
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set uriScheme
     *
     * @param integer $uriScheme
     *
     * @return self
     */
    protected function setUriScheme($uriScheme = null)
    {
        if (!is_null($uriScheme)) {
            if (!is_null($uriScheme)) {
                Assertion::integerish($uriScheme, 'uriScheme value "%s" is not an integer or a number castable to integer.');
                Assertion::greaterOrEqualThan($uriScheme, 0, 'uriScheme provided "%s" is not greater or equal than "%s".');
            }
        }

        $this->uriScheme = $uriScheme;

        return $this;
    }

    /**
     * Get uriScheme
     *
     * @return integer | null
     */
    public function getUriScheme()
    {
        return $this->uriScheme;
    }

    /**
     * Set transport
     *
     * @param integer $transport
     *
     * @return self
     */
    protected function setTransport($transport = null)
    {
        if (!is_null($transport)) {
            if (!is_null($transport)) {
                Assertion::integerish($transport, 'transport value "%s" is not an integer or a number castable to integer.');
                Assertion::greaterOrEqualThan($transport, 0, 'transport provided "%s" is not greater or equal than "%s".');
            }
        }

        $this->transport = $transport;

        return $this;
    }

    /**
     * Get transport
     *
     * @return integer | null
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
    protected function setStrip($strip = null)
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
     * @return boolean | null
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
    protected function setPrefix($prefix = null)
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
     * @return string | null
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
    protected function setTag($tag = null)
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
     * @return string | null
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set defunct
     *
     * @param integer $defunct
     *
     * @return self
     */
    protected function setDefunct($defunct = null)
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
     * @return integer | null
     */
    public function getDefunct()
    {
        return $this->defunct;
    }

    /**
     * Set carrierServer
     *
     * @param \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface $carrierServer
     *
     * @return self
     */
    public function setCarrierServer(\Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface $carrierServer)
    {
        $this->carrierServer = $carrierServer;

        return $this;
    }

    /**
     * Get carrierServer
     *
     * @return \Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface | null
     */
    public function getCarrierServer()
    {
        return $this->carrierServer;
    }

    // @codeCoverageIgnoreEnd
}
