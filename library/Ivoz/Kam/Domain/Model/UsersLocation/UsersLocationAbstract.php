<?php

namespace Ivoz\Kam\Domain\Model\UsersLocation;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

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
     * @var string | null
     */
    protected $domain;

    /**
     * @var string
     */
    protected $contact = '';

    /**
     * @var string | null
     */
    protected $received;

    /**
     * @var string | null
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
     * column: last_modified
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
     * column: user_agent
     * @var string
     */
    protected $userAgent = '';

    /**
     * @var string | null
     */
    protected $socket;

    /**
     * @var integer | null
     */
    protected $methods;

    /**
     * @var string | null
     */
    protected $instance;

    /**
     * column: reg_id
     * @var integer
     */
    protected $regId = '0';

    /**
     * column: server_id
     * @var integer
     */
    protected $serverId = '0';

    /**
     * column: connection_id
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


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
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
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "UsersLocation",
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
     * @return UsersLocationDto
     */
    public static function createDto($id = null)
    {
        return new UsersLocationDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return UsersLocationDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, UsersLocationInterface::class);

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
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto UsersLocationDto
         */
        Assertion::isInstanceOf($dto, UsersLocationDto::class);

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
            $dto->getPartition()
        );

        $self
            ->setDomain($dto->getDomain())
            ->setReceived($dto->getReceived())
            ->setPath($dto->getPath())
            ->setSocket($dto->getSocket())
            ->setMethods($dto->getMethods())
            ->setInstance($dto->getInstance())
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
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto UsersLocationDto
         */
        Assertion::isInstanceOf($dto, UsersLocationDto::class);

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



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return UsersLocationDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setRuid(self::getRuid())
            ->setUsername(self::getUsername())
            ->setDomain(self::getDomain())
            ->setContact(self::getContact())
            ->setReceived(self::getReceived())
            ->setPath(self::getPath())
            ->setExpires(self::getExpires())
            ->setQ(self::getQ())
            ->setCallid(self::getCallid())
            ->setCseq(self::getCseq())
            ->setLastModified(self::getLastModified())
            ->setFlags(self::getFlags())
            ->setCflags(self::getCflags())
            ->setUserAgent(self::getUserAgent())
            ->setSocket(self::getSocket())
            ->setMethods(self::getMethods())
            ->setInstance(self::getInstance())
            ->setRegId(self::getRegId())
            ->setServerId(self::getServerId())
            ->setConnectionId(self::getConnectionId())
            ->setKeepalive(self::getKeepalive())
            ->setPartition(self::getPartition());
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
    protected function setRuid($ruid)
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
    protected function setUsername($username)
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
    protected function setDomain($domain = null)
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
     * @return string | null
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
    protected function setContact($contact)
    {
        Assertion::notNull($contact, 'contact value "%s" is null, but non null value was expected.');
        Assertion::maxLength($contact, 512, 'contact value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setReceived($received = null)
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
     * @return string | null
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
    protected function setPath($path = null)
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
     * @return string | null
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
    protected function setExpires($expires)
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
        return clone $this->expires;
    }

    /**
     * Set q
     *
     * @param float $q
     *
     * @return self
     */
    protected function setQ($q)
    {
        Assertion::notNull($q, 'q value "%s" is null, but non null value was expected.');
        Assertion::numeric($q);
        $q = (float) $q;

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
    protected function setCallid($callid)
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
    protected function setCseq($cseq)
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
    protected function setLastModified($lastModified)
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
        return clone $this->lastModified;
    }

    /**
     * Set flags
     *
     * @param integer $flags
     *
     * @return self
     */
    protected function setFlags($flags)
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
    protected function setCflags($cflags)
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
    protected function setUserAgent($userAgent)
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
    protected function setSocket($socket = null)
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
     * @return string | null
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
    protected function setMethods($methods = null)
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
     * @return integer | null
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
    protected function setInstance($instance = null)
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
     * @return string | null
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
    protected function setRegId($regId)
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
    protected function setServerId($serverId)
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
    protected function setConnectionId($connectionId)
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
    protected function setKeepalive($keepalive)
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
    protected function setPartition($partition)
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
