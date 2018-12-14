<?php

namespace Ivoz\Provider\Domain\Model\CarrierServer;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * CarrierServerAbstract
 * @codeCoverageIgnore
 */
abstract class CarrierServerAbstract
{
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
    protected $sendPAI = 0;

    /**
     * @var boolean | null
     */
    protected $sendRPID = 0;

    /**
     * @var string
     */
    protected $authNeeded = 'no';

    /**
     * @var string | null
     */
    protected $authUser;

    /**
     * @var string | null
     */
    protected $authPassword;

    /**
     * @var string | null
     */
    protected $sipProxy;

    /**
     * @var string | null
     */
    protected $outboundProxy;

    /**
     * @var string | null
     */
    protected $fromUser;

    /**
     * @var string | null
     */
    protected $fromDomain;

    /**
     * @var \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface
     */
    protected $lcrGateway;

    /**
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    protected $carrier;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($authNeeded)
    {
        $this->setAuthNeeded($authNeeded);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "CarrierServer",
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
     * @return CarrierServerDto
     */
    public static function createDto($id = null)
    {
        return new CarrierServerDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return CarrierServerDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CarrierServerInterface::class);

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
         * @var $dto CarrierServerDto
         */
        Assertion::isInstanceOf($dto, CarrierServerDto::class);

        $self = new static(
            $dto->getAuthNeeded()
        );

        $self
            ->setIp($dto->getIp())
            ->setHostname($dto->getHostname())
            ->setPort($dto->getPort())
            ->setUriScheme($dto->getUriScheme())
            ->setTransport($dto->getTransport())
            ->setSendPAI($dto->getSendPAI())
            ->setSendRPID($dto->getSendRPID())
            ->setAuthUser($dto->getAuthUser())
            ->setAuthPassword($dto->getAuthPassword())
            ->setSipProxy($dto->getSipProxy())
            ->setOutboundProxy($dto->getOutboundProxy())
            ->setFromUser($dto->getFromUser())
            ->setFromDomain($dto->getFromDomain())
            ->setCarrier($dto->getCarrier())
            ->setBrand($dto->getBrand())
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
         * @var $dto CarrierServerDto
         */
        Assertion::isInstanceOf($dto, CarrierServerDto::class);

        $this
            ->setIp($dto->getIp())
            ->setHostname($dto->getHostname())
            ->setPort($dto->getPort())
            ->setUriScheme($dto->getUriScheme())
            ->setTransport($dto->getTransport())
            ->setSendPAI($dto->getSendPAI())
            ->setSendRPID($dto->getSendRPID())
            ->setAuthNeeded($dto->getAuthNeeded())
            ->setAuthUser($dto->getAuthUser())
            ->setAuthPassword($dto->getAuthPassword())
            ->setSipProxy($dto->getSipProxy())
            ->setOutboundProxy($dto->getOutboundProxy())
            ->setFromUser($dto->getFromUser())
            ->setFromDomain($dto->getFromDomain())
            ->setCarrier($dto->getCarrier())
            ->setBrand($dto->getBrand());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CarrierServerDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setIp(self::getIp())
            ->setHostname(self::getHostname())
            ->setPort(self::getPort())
            ->setUriScheme(self::getUriScheme())
            ->setTransport(self::getTransport())
            ->setSendPAI(self::getSendPAI())
            ->setSendRPID(self::getSendRPID())
            ->setAuthNeeded(self::getAuthNeeded())
            ->setAuthUser(self::getAuthUser())
            ->setAuthPassword(self::getAuthPassword())
            ->setSipProxy(self::getSipProxy())
            ->setOutboundProxy(self::getOutboundProxy())
            ->setFromUser(self::getFromUser())
            ->setFromDomain(self::getFromDomain())
            ->setCarrier(\Ivoz\Provider\Domain\Model\Carrier\Carrier::entityToDto(self::getCarrier(), $depth))
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'ip' => self::getIp(),
            'hostname' => self::getHostname(),
            'port' => self::getPort(),
            'uriScheme' => self::getUriScheme(),
            'transport' => self::getTransport(),
            'sendPAI' => self::getSendPAI(),
            'sendRPID' => self::getSendRPID(),
            'authNeeded' => self::getAuthNeeded(),
            'authUser' => self::getAuthUser(),
            'authPassword' => self::getAuthPassword(),
            'sipProxy' => self::getSipProxy(),
            'outboundProxy' => self::getOutboundProxy(),
            'fromUser' => self::getFromUser(),
            'fromDomain' => self::getFromDomain(),
            'carrierId' => self::getCarrier() ? self::getCarrier()->getId() : null,
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

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
     * Set sendPAI
     *
     * @param boolean $sendPAI
     *
     * @return self
     */
    protected function setSendPAI($sendPAI = null)
    {
        if (!is_null($sendPAI)) {
            Assertion::between(intval($sendPAI), 0, 1, 'sendPAI provided "%s" is not a valid boolean value.');
        }

        $this->sendPAI = $sendPAI;

        return $this;
    }

    /**
     * Get sendPAI
     *
     * @return boolean | null
     */
    public function getSendPAI()
    {
        return $this->sendPAI;
    }

    /**
     * Set sendRPID
     *
     * @param boolean $sendRPID
     *
     * @return self
     */
    protected function setSendRPID($sendRPID = null)
    {
        if (!is_null($sendRPID)) {
            Assertion::between(intval($sendRPID), 0, 1, 'sendRPID provided "%s" is not a valid boolean value.');
        }

        $this->sendRPID = $sendRPID;

        return $this;
    }

    /**
     * Get sendRPID
     *
     * @return boolean | null
     */
    public function getSendRPID()
    {
        return $this->sendRPID;
    }

    /**
     * Set authNeeded
     *
     * @param string $authNeeded
     *
     * @return self
     */
    protected function setAuthNeeded($authNeeded)
    {
        Assertion::notNull($authNeeded, 'authNeeded value "%s" is null, but non null value was expected.');

        $this->authNeeded = $authNeeded;

        return $this;
    }

    /**
     * Get authNeeded
     *
     * @return string
     */
    public function getAuthNeeded()
    {
        return $this->authNeeded;
    }

    /**
     * Set authUser
     *
     * @param string $authUser
     *
     * @return self
     */
    protected function setAuthUser($authUser = null)
    {
        if (!is_null($authUser)) {
            Assertion::maxLength($authUser, 64, 'authUser value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->authUser = $authUser;

        return $this;
    }

    /**
     * Get authUser
     *
     * @return string | null
     */
    public function getAuthUser()
    {
        return $this->authUser;
    }

    /**
     * Set authPassword
     *
     * @param string $authPassword
     *
     * @return self
     */
    protected function setAuthPassword($authPassword = null)
    {
        if (!is_null($authPassword)) {
            Assertion::maxLength($authPassword, 64, 'authPassword value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->authPassword = $authPassword;

        return $this;
    }

    /**
     * Get authPassword
     *
     * @return string | null
     */
    public function getAuthPassword()
    {
        return $this->authPassword;
    }

    /**
     * Set sipProxy
     *
     * @param string $sipProxy
     *
     * @return self
     */
    protected function setSipProxy($sipProxy = null)
    {
        if (!is_null($sipProxy)) {
            Assertion::maxLength($sipProxy, 128, 'sipProxy value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->sipProxy = $sipProxy;

        return $this;
    }

    /**
     * Get sipProxy
     *
     * @return string | null
     */
    public function getSipProxy()
    {
        return $this->sipProxy;
    }

    /**
     * Set outboundProxy
     *
     * @param string $outboundProxy
     *
     * @return self
     */
    protected function setOutboundProxy($outboundProxy = null)
    {
        if (!is_null($outboundProxy)) {
            Assertion::maxLength($outboundProxy, 128, 'outboundProxy value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->outboundProxy = $outboundProxy;

        return $this;
    }

    /**
     * Get outboundProxy
     *
     * @return string | null
     */
    public function getOutboundProxy()
    {
        return $this->outboundProxy;
    }

    /**
     * Set fromUser
     *
     * @param string $fromUser
     *
     * @return self
     */
    protected function setFromUser($fromUser = null)
    {
        if (!is_null($fromUser)) {
            Assertion::maxLength($fromUser, 64, 'fromUser value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fromUser = $fromUser;

        return $this;
    }

    /**
     * Get fromUser
     *
     * @return string | null
     */
    public function getFromUser()
    {
        return $this->fromUser;
    }

    /**
     * Set fromDomain
     *
     * @param string $fromDomain
     *
     * @return self
     */
    protected function setFromDomain($fromDomain = null)
    {
        if (!is_null($fromDomain)) {
            Assertion::maxLength($fromDomain, 190, 'fromDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fromDomain = $fromDomain;

        return $this;
    }

    /**
     * Get fromDomain
     *
     * @return string | null
     */
    public function getFromDomain()
    {
        return $this->fromDomain;
    }

    /**
     * Set lcrGateway
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface $lcrGateway
     *
     * @return self
     */
    public function setLcrGateway(\Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface $lcrGateway = null)
    {
        $this->lcrGateway = $lcrGateway;

        return $this;
    }

    /**
     * Get lcrGateway
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface
     */
    public function getLcrGateway()
    {
        return $this->lcrGateway;
    }

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier
     *
     * @return self
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand()
    {
        return $this->brand;
    }

    // @codeCoverageIgnoreEnd
}
