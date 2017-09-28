<?php

namespace Ivoz\Provider\Domain\Model\PeerServer;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * PeerServerAbstract
 * @codeCoverageIgnore
 */
abstract class PeerServerAbstract
{
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
     * @var boolean
     */
    protected $sendPAI = 0;

    /**
     * @var boolean
     */
    protected $sendRPID = 0;

    /**
     * @column auth_needed
     * @var string
     */
    protected $authNeeded = 'no';

    /**
     * @column auth_user
     * @var string
     */
    protected $authUser;

    /**
     * @column auth_password
     * @var string
     */
    protected $authPassword;

    /**
     * @column sip_proxy
     * @var string
     */
    protected $sipProxy;

    /**
     * @column outbound_proxy
     * @var string
     */
    protected $outboundProxy;

    /**
     * @column from_user
     * @var string
     */
    protected $fromUser;

    /**
     * @column from_domain
     * @var string
     */
    protected $fromDomain;

    /**
     * @var \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface
     */
    protected $peeringContract;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($authNeeded)
    {
        $this->setAuthNeeded($authNeeded);

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
     * @return PeerServerDTO
     */
    public static function createDTO()
    {
        return new PeerServerDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PeerServerDTO
         */
        Assertion::isInstanceOf($dto, PeerServerDTO::class);

        $self = new static(
            $dto->getAuthNeeded());

        return $self
            ->setIp($dto->getIp())
            ->setHostname($dto->getHostname())
            ->setPort($dto->getPort())
            ->setParams($dto->getParams())
            ->setUriScheme($dto->getUriScheme())
            ->setTransport($dto->getTransport())
            ->setStrip($dto->getStrip())
            ->setPrefix($dto->getPrefix())
            ->setSendPAI($dto->getSendPAI())
            ->setSendRPID($dto->getSendRPID())
            ->setAuthUser($dto->getAuthUser())
            ->setAuthPassword($dto->getAuthPassword())
            ->setSipProxy($dto->getSipProxy())
            ->setOutboundProxy($dto->getOutboundProxy())
            ->setFromUser($dto->getFromUser())
            ->setFromDomain($dto->getFromDomain())
            ->setPeeringContract($dto->getPeeringContract())
            ->setBrand($dto->getBrand())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PeerServerDTO
         */
        Assertion::isInstanceOf($dto, PeerServerDTO::class);

        $this
            ->setIp($dto->getIp())
            ->setHostname($dto->getHostname())
            ->setPort($dto->getPort())
            ->setParams($dto->getParams())
            ->setUriScheme($dto->getUriScheme())
            ->setTransport($dto->getTransport())
            ->setStrip($dto->getStrip())
            ->setPrefix($dto->getPrefix())
            ->setSendPAI($dto->getSendPAI())
            ->setSendRPID($dto->getSendRPID())
            ->setAuthNeeded($dto->getAuthNeeded())
            ->setAuthUser($dto->getAuthUser())
            ->setAuthPassword($dto->getAuthPassword())
            ->setSipProxy($dto->getSipProxy())
            ->setOutboundProxy($dto->getOutboundProxy())
            ->setFromUser($dto->getFromUser())
            ->setFromDomain($dto->getFromDomain())
            ->setPeeringContract($dto->getPeeringContract())
            ->setBrand($dto->getBrand());


        return $this;
    }

    /**
     * @return PeerServerDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setIp($this->getIp())
            ->setHostname($this->getHostname())
            ->setPort($this->getPort())
            ->setParams($this->getParams())
            ->setUriScheme($this->getUriScheme())
            ->setTransport($this->getTransport())
            ->setStrip($this->getStrip())
            ->setPrefix($this->getPrefix())
            ->setSendPAI($this->getSendPAI())
            ->setSendRPID($this->getSendRPID())
            ->setAuthNeeded($this->getAuthNeeded())
            ->setAuthUser($this->getAuthUser())
            ->setAuthPassword($this->getAuthPassword())
            ->setSipProxy($this->getSipProxy())
            ->setOutboundProxy($this->getOutboundProxy())
            ->setFromUser($this->getFromUser())
            ->setFromDomain($this->getFromDomain())
            ->setPeeringContractId($this->getPeeringContract() ? $this->getPeeringContract()->getId() : null)
            ->setBrandId($this->getBrand() ? $this->getBrand()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'ip' => $this->getIp(),
            'hostname' => $this->getHostname(),
            'port' => $this->getPort(),
            'params' => $this->getParams(),
            'uriScheme' => $this->getUriScheme(),
            'transport' => $this->getTransport(),
            'strip' => $this->getStrip(),
            'prefix' => $this->getPrefix(),
            'sendPAI' => $this->getSendPAI(),
            'sendRPID' => $this->getSendRPID(),
            'authNeeded' => $this->getAuthNeeded(),
            'authUser' => $this->getAuthUser(),
            'authPassword' => $this->getAuthPassword(),
            'sipProxy' => $this->getSipProxy(),
            'outboundProxy' => $this->getOutboundProxy(),
            'fromUser' => $this->getFromUser(),
            'fromDomain' => $this->getFromDomain(),
            'peeringContractId' => $this->getPeeringContract() ? $this->getPeeringContract()->getId() : null,
            'brandId' => $this->getBrand() ? $this->getBrand()->getId() : null
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
     * Set sendPAI
     *
     * @param boolean $sendPAI
     *
     * @return self
     */
    public function setSendPAI($sendPAI = null)
    {
        if (!is_null($sendPAI)) {
            Assertion::between(intval($sendPAI), 0, 1);
        }

        $this->sendPAI = $sendPAI;

        return $this;
    }

    /**
     * Get sendPAI
     *
     * @return boolean
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
    public function setSendRPID($sendRPID = null)
    {
        if (!is_null($sendRPID)) {
            Assertion::between(intval($sendRPID), 0, 1);
        }

        $this->sendRPID = $sendRPID;

        return $this;
    }

    /**
     * Get sendRPID
     *
     * @return boolean
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
    public function setAuthNeeded($authNeeded)
    {
        Assertion::notNull($authNeeded);

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
    public function setAuthUser($authUser = null)
    {
        if (!is_null($authUser)) {
            Assertion::maxLength($authUser, 64);
        }

        $this->authUser = $authUser;

        return $this;
    }

    /**
     * Get authUser
     *
     * @return string
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
    public function setAuthPassword($authPassword = null)
    {
        if (!is_null($authPassword)) {
            Assertion::maxLength($authPassword, 64);
        }

        $this->authPassword = $authPassword;

        return $this;
    }

    /**
     * Get authPassword
     *
     * @return string
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
    public function setSipProxy($sipProxy = null)
    {
        if (!is_null($sipProxy)) {
            Assertion::maxLength($sipProxy, 128);
        }

        $this->sipProxy = $sipProxy;

        return $this;
    }

    /**
     * Get sipProxy
     *
     * @return string
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
    public function setOutboundProxy($outboundProxy = null)
    {
        if (!is_null($outboundProxy)) {
            Assertion::maxLength($outboundProxy, 128);
        }

        $this->outboundProxy = $outboundProxy;

        return $this;
    }

    /**
     * Get outboundProxy
     *
     * @return string
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
    public function setFromUser($fromUser = null)
    {
        if (!is_null($fromUser)) {
            Assertion::maxLength($fromUser, 64);
        }

        $this->fromUser = $fromUser;

        return $this;
    }

    /**
     * Get fromUser
     *
     * @return string
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
    public function setFromDomain($fromDomain = null)
    {
        if (!is_null($fromDomain)) {
            Assertion::maxLength($fromDomain, 190);
        }

        $this->fromDomain = $fromDomain;

        return $this;
    }

    /**
     * Get fromDomain
     *
     * @return string
     */
    public function getFromDomain()
    {
        return $this->fromDomain;
    }

    /**
     * Set peeringContract
     *
     * @param \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface $peeringContract
     *
     * @return self
     */
    public function setPeeringContract(\Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface $peeringContract = null)
    {
        $this->peeringContract = $peeringContract;

        return $this;
    }

    /**
     * Get peeringContract
     *
     * @return \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface
     */
    public function getPeeringContract()
    {
        return $this->peeringContract;
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

