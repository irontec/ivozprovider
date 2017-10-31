<?php

namespace Ivoz\Kam\Domain\Model\UsersLocation;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * UsersLocationAbstract
 * @codeCoverageIgnore
 */
abstract class UsersLocationAbstract
{
    /**
     * @var string
     */
    protected $ruid = '';

    /**
     * @var string
     */
    protected $username = '';

    /**
     * @var string
     */
    protected $domain;

    /**
     * @var string
     */
    protected $contact = '';

    /**
     * @var string
     */
    protected $received;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var \DateTime
     */
    protected $expires;

    /**
     * @var float
     */
    protected $q = '1.00';

    /**
     * @var string
     */
    protected $callid = 'Default-Call-ID';

    /**
     * @var integer
     */
    protected $cseq = '1';

    /**
     * @column last_modified
     * @var \DateTime
     */
    protected $lastModified;

    /**
     * @var integer
     */
    protected $flags = '0';

    /**
     * @var integer
     */
    protected $cflags = '0';

    /**
     * @column user_agent
     * @var string
     */
    protected $userAgent = '';

    /**
     * @var string
     */
    protected $socket;

    /**
     * @var integer
     */
    protected $methods;

    /**
     * @var string
     */
    protected $instance;

    /**
     * @column reg_id
     * @var integer
     */
    protected $regId = '0';

    /**
     * @column server_id
     * @var integer
     */
    protected $serverId = '0';

    /**
     * @column connection_id
     * @var integer
     */
    protected $connectionId = '0';

    /**
     * @var integer
     */
    protected $keepalive = '0';

    /**
     * @var integer
     */
    protected $partition = '0';


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct(
        $ruid,
        $username,
        $contact,
        $expires,
        $q,
        $callid,
        $cseq,
        $lastModified,
        $flags,
        $cflags,
        $userAgent,
        $regId,
        $serverId,
        $connectionId,
        $keepalive,
        $partition
    ) {
        $this->setRuid($ruid);
        $this->setUsername($username);
        $this->setContact($contact);
        $this->setExpires($expires);
        $this->setQ($q);
        $this->setCallid($callid);
        $this->setCseq($cseq);
        $this->setLastModified($lastModified);
        $this->setFlags($flags);
        $this->setCflags($cflags);
        $this->setUserAgent($userAgent);
        $this->setRegId($regId);
        $this->setServerId($serverId);
        $this->setConnectionId($connectionId);
        $this->setKeepalive($keepalive);
        $this->setPartition($partition);

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
    public function hasChanged($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$dbFieldName] != $this->_initialValues[$dbFieldName];
    }

    public function getInitialValue($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }

        return $this->_initialValues[$dbFieldName];
    }

    /**
     * @return array
     */
    protected function getChangeSet()
    {
        $changes = [];
        $currentValues = $this->__toArray();
        foreach ($currentValues as $key => $value) {

            if ($this->_initialValues[$key] == $currentValues[$key]) {
                continue;
            }

            $value = $currentValues[$key];
            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }

            $changes[$key] = $value;
        }

        return $changes;
    }

    /**
     * @return UsersLocationDTO
     */
    public static function createDTO()
    {
        return new UsersLocationDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UsersLocationDTO
         */
        Assertion::isInstanceOf($dto, UsersLocationDTO::class);

        $self = new static(
            $dto->getRuid(),
            $dto->getUsername(),
            $dto->getContact(),
            $dto->getExpires(),
            $dto->getQ(),
            $dto->getCallid(),
            $dto->getCseq(),
            $dto->getLastModified(),
            $dto->getFlags(),
            $dto->getCflags(),
            $dto->getUserAgent(),
            $dto->getRegId(),
            $dto->getServerId(),
            $dto->getConnectionId(),
            $dto->getKeepalive(),
            $dto->getPartition());

        return $self
            ->setDomain($dto->getDomain())
            ->setReceived($dto->getReceived())
            ->setPath($dto->getPath())
            ->setSocket($dto->getSocket())
            ->setMethods($dto->getMethods())
            ->setInstance($dto->getInstance())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UsersLocationDTO
         */
        Assertion::isInstanceOf($dto, UsersLocationDTO::class);

        $this
            ->setRuid($dto->getRuid())
            ->setUsername($dto->getUsername())
            ->setDomain($dto->getDomain())
            ->setContact($dto->getContact())
            ->setReceived($dto->getReceived())
            ->setPath($dto->getPath())
            ->setExpires($dto->getExpires())
            ->setQ($dto->getQ())
            ->setCallid($dto->getCallid())
            ->setCseq($dto->getCseq())
            ->setLastModified($dto->getLastModified())
            ->setFlags($dto->getFlags())
            ->setCflags($dto->getCflags())
            ->setUserAgent($dto->getUserAgent())
            ->setSocket($dto->getSocket())
            ->setMethods($dto->getMethods())
            ->setInstance($dto->getInstance())
            ->setRegId($dto->getRegId())
            ->setServerId($dto->getServerId())
            ->setConnectionId($dto->getConnectionId())
            ->setKeepalive($dto->getKeepalive())
            ->setPartition($dto->getPartition());


        return $this;
    }

    /**
     * @return UsersLocationDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setRuid($this->getRuid())
            ->setUsername($this->getUsername())
            ->setDomain($this->getDomain())
            ->setContact($this->getContact())
            ->setReceived($this->getReceived())
            ->setPath($this->getPath())
            ->setExpires($this->getExpires())
            ->setQ($this->getQ())
            ->setCallid($this->getCallid())
            ->setCseq($this->getCseq())
            ->setLastModified($this->getLastModified())
            ->setFlags($this->getFlags())
            ->setCflags($this->getCflags())
            ->setUserAgent($this->getUserAgent())
            ->setSocket($this->getSocket())
            ->setMethods($this->getMethods())
            ->setInstance($this->getInstance())
            ->setRegId($this->getRegId())
            ->setServerId($this->getServerId())
            ->setConnectionId($this->getConnectionId())
            ->setKeepalive($this->getKeepalive())
            ->setPartition($this->getPartition());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'ruid' => self::getRuid(),
            'username' => self::getUsername(),
            'domain' => self::getDomain(),
            'contact' => self::getContact(),
            'received' => self::getReceived(),
            'path' => self::getPath(),
            'expires' => self::getExpires(),
            'q' => self::getQ(),
            'callid' => self::getCallid(),
            'cseq' => self::getCseq(),
            'last_modified' => self::getLastModified(),
            'flags' => self::getFlags(),
            'cflags' => self::getCflags(),
            'user_agent' => self::getUserAgent(),
            'socket' => self::getSocket(),
            'methods' => self::getMethods(),
            'instance' => self::getInstance(),
            'reg_id' => self::getRegId(),
            'server_id' => self::getServerId(),
            'connection_id' => self::getConnectionId(),
            'keepalive' => self::getKeepalive(),
            'partition' => self::getPartition()
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set ruid
     *
     * @param string $ruid
     *
     * @return self
     */
    public function setRuid($ruid)
    {
        Assertion::notNull($ruid, 'ruid value "%s" is null, but non null value was expected.');
        Assertion::maxLength($ruid, 64, 'ruid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ruid = $ruid;

        return $this;
    }

    /**
     * Get ruid
     *
     * @return string
     */
    public function getRuid()
    {
        return $this->ruid;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return self
     */
    public function setUsername($username)
    {
        Assertion::notNull($username, 'username value "%s" is null, but non null value was expected.');
        Assertion::maxLength($username, 64, 'username value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return self
     */
    public function setDomain($domain = null)
    {
        if (!is_null($domain)) {
            Assertion::maxLength($domain, 190, 'domain value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return self
     */
    public function setContact($contact)
    {
        Assertion::notNull($contact, 'contact value "%s" is null, but non null value was expected.');
        Assertion::maxLength($contact, 255, 'contact value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set received
     *
     * @param string $received
     *
     * @return self
     */
    public function setReceived($received = null)
    {
        if (!is_null($received)) {
            Assertion::maxLength($received, 128, 'received value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->received = $received;

        return $this;
    }

    /**
     * Get received
     *
     * @return string
     */
    public function getReceived()
    {
        return $this->received;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return self
     */
    public function setPath($path = null)
    {
        if (!is_null($path)) {
            Assertion::maxLength($path, 512, 'path value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set expires
     *
     * @param \DateTime $expires
     *
     * @return self
     */
    public function setExpires($expires)
    {
        Assertion::notNull($expires, 'expires value "%s" is null, but non null value was expected.');
        $expires = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $expires,
            '2030-05-28 21:32:15'
        );

        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return \DateTime
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Set q
     *
     * @param float $q
     *
     * @return self
     */
    public function setQ($q)
    {
        Assertion::notNull($q, 'q value "%s" is null, but non null value was expected.');
        Assertion::numeric($q);

        $this->q = $q;

        return $this;
    }

    /**
     * Get q
     *
     * @return float
     */
    public function getQ()
    {
        return $this->q;
    }

    /**
     * Set callid
     *
     * @param string $callid
     *
     * @return self
     */
    public function setCallid($callid)
    {
        Assertion::notNull($callid, 'callid value "%s" is null, but non null value was expected.');
        Assertion::maxLength($callid, 255, 'callid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->callid = $callid;

        return $this;
    }

    /**
     * Get callid
     *
     * @return string
     */
    public function getCallid()
    {
        return $this->callid;
    }

    /**
     * Set cseq
     *
     * @param integer $cseq
     *
     * @return self
     */
    public function setCseq($cseq)
    {
        Assertion::notNull($cseq, 'cseq value "%s" is null, but non null value was expected.');
        Assertion::integerish($cseq, 'cseq value "%s" is not an integer or a number castable to integer.');

        $this->cseq = $cseq;

        return $this;
    }

    /**
     * Get cseq
     *
     * @return integer
     */
    public function getCseq()
    {
        return $this->cseq;
    }

    /**
     * Set lastModified
     *
     * @param \DateTime $lastModified
     *
     * @return self
     */
    public function setLastModified($lastModified)
    {
        Assertion::notNull($lastModified, 'lastModified value "%s" is null, but non null value was expected.');
        $lastModified = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $lastModified,
            '1900-01-01 00:00:01'
        );

        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * Get lastModified
     *
     * @return \DateTime
     */
    public function getLastModified()
    {
        return $this->lastModified;
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
     * Set cflags
     *
     * @param integer $cflags
     *
     * @return self
     */
    public function setCflags($cflags)
    {
        Assertion::notNull($cflags, 'cflags value "%s" is null, but non null value was expected.');
        Assertion::integerish($cflags, 'cflags value "%s" is not an integer or a number castable to integer.');

        $this->cflags = $cflags;

        return $this;
    }

    /**
     * Get cflags
     *
     * @return integer
     */
    public function getCflags()
    {
        return $this->cflags;
    }

    /**
     * Set userAgent
     *
     * @param string $userAgent
     *
     * @return self
     */
    public function setUserAgent($userAgent)
    {
        Assertion::notNull($userAgent, 'userAgent value "%s" is null, but non null value was expected.');
        Assertion::maxLength($userAgent, 255, 'userAgent value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Set socket
     *
     * @param string $socket
     *
     * @return self
     */
    public function setSocket($socket = null)
    {
        if (!is_null($socket)) {
            Assertion::maxLength($socket, 64, 'socket value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->socket = $socket;

        return $this;
    }

    /**
     * Get socket
     *
     * @return string
     */
    public function getSocket()
    {
        return $this->socket;
    }

    /**
     * Set methods
     *
     * @param integer $methods
     *
     * @return self
     */
    public function setMethods($methods = null)
    {
        if (!is_null($methods)) {
            if (!is_null($methods)) {
                Assertion::integerish($methods, 'methods value "%s" is not an integer or a number castable to integer.');
            }
        }

        $this->methods = $methods;

        return $this;
    }

    /**
     * Get methods
     *
     * @return integer
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * Set instance
     *
     * @param string $instance
     *
     * @return self
     */
    public function setInstance($instance = null)
    {
        if (!is_null($instance)) {
            Assertion::maxLength($instance, 255, 'instance value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->instance = $instance;

        return $this;
    }

    /**
     * Get instance
     *
     * @return string
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * Set regId
     *
     * @param integer $regId
     *
     * @return self
     */
    public function setRegId($regId)
    {
        Assertion::notNull($regId, 'regId value "%s" is null, but non null value was expected.');
        Assertion::integerish($regId, 'regId value "%s" is not an integer or a number castable to integer.');

        $this->regId = $regId;

        return $this;
    }

    /**
     * Get regId
     *
     * @return integer
     */
    public function getRegId()
    {
        return $this->regId;
    }

    /**
     * Set serverId
     *
     * @param integer $serverId
     *
     * @return self
     */
    public function setServerId($serverId)
    {
        Assertion::notNull($serverId, 'serverId value "%s" is null, but non null value was expected.');
        Assertion::integerish($serverId, 'serverId value "%s" is not an integer or a number castable to integer.');

        $this->serverId = $serverId;

        return $this;
    }

    /**
     * Get serverId
     *
     * @return integer
     */
    public function getServerId()
    {
        return $this->serverId;
    }

    /**
     * Set connectionId
     *
     * @param integer $connectionId
     *
     * @return self
     */
    public function setConnectionId($connectionId)
    {
        Assertion::notNull($connectionId, 'connectionId value "%s" is null, but non null value was expected.');
        Assertion::integerish($connectionId, 'connectionId value "%s" is not an integer or a number castable to integer.');

        $this->connectionId = $connectionId;

        return $this;
    }

    /**
     * Get connectionId
     *
     * @return integer
     */
    public function getConnectionId()
    {
        return $this->connectionId;
    }

    /**
     * Set keepalive
     *
     * @param integer $keepalive
     *
     * @return self
     */
    public function setKeepalive($keepalive)
    {
        Assertion::notNull($keepalive, 'keepalive value "%s" is null, but non null value was expected.');
        Assertion::integerish($keepalive, 'keepalive value "%s" is not an integer or a number castable to integer.');

        $this->keepalive = $keepalive;

        return $this;
    }

    /**
     * Get keepalive
     *
     * @return integer
     */
    public function getKeepalive()
    {
        return $this->keepalive;
    }

    /**
     * Set partition
     *
     * @param integer $partition
     *
     * @return self
     */
    public function setPartition($partition)
    {
        Assertion::notNull($partition, 'partition value "%s" is null, but non null value was expected.');
        Assertion::integerish($partition, 'partition value "%s" is not an integer or a number castable to integer.');

        $this->partition = $partition;

        return $this;
    }

    /**
     * Get partition
     *
     * @return integer
     */
    public function getPartition()
    {
        return $this->partition;
    }



    // @codeCoverageIgnoreEnd
}

