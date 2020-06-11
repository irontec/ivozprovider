<?php

namespace Ivoz\Kam\Domain\Model\UsersPresentity;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * UsersPresentityAbstract
 * @codeCoverageIgnore
 */
abstract class UsersPresentityAbstract
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $domain;

    /**
     * @var string
     */
    protected $event;

    /**
     * @var string
     */
    protected $etag;

    /**
     * @var integer
     */
    protected $expires;

    /**
     * column: received_time
     * @var integer
     */
    protected $receivedTime;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var string
     */
    protected $sender;

    /**
     * @var integer
     */
    protected $priority = 0;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $username,
        $domain,
        $event,
        $etag,
        $expires,
        $receivedTime,
        $body,
        $sender,
        $priority
    ) {
        $this->setUsername($username);
        $this->setDomain($domain);
        $this->setEvent($event);
        $this->setEtag($etag);
        $this->setExpires($expires);
        $this->setReceivedTime($receivedTime);
        $this->setBody($body);
        $this->setSender($sender);
        $this->setPriority($priority);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "UsersPresentity",
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
     * @return UsersPresentityDto
     */
    public static function createDto($id = null)
    {
        return new UsersPresentityDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param UsersPresentityInterface|null $entity
     * @param int $depth
     * @return UsersPresentityDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, UsersPresentityInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var UsersPresentityDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersPresentityDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, UsersPresentityDto::class);

        $self = new static(
            $dto->getUsername(),
            $dto->getDomain(),
            $dto->getEvent(),
            $dto->getEtag(),
            $dto->getExpires(),
            $dto->getReceivedTime(),
            $dto->getBody(),
            $dto->getSender(),
            $dto->getPriority()
        );

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param UsersPresentityDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, UsersPresentityDto::class);

        $this
            ->setUsername($dto->getUsername())
            ->setDomain($dto->getDomain())
            ->setEvent($dto->getEvent())
            ->setEtag($dto->getEtag())
            ->setExpires($dto->getExpires())
            ->setReceivedTime($dto->getReceivedTime())
            ->setBody($dto->getBody())
            ->setSender($dto->getSender())
            ->setPriority($dto->getPriority());



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return UsersPresentityDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setUsername(self::getUsername())
            ->setDomain(self::getDomain())
            ->setEvent(self::getEvent())
            ->setEtag(self::getEtag())
            ->setExpires(self::getExpires())
            ->setReceivedTime(self::getReceivedTime())
            ->setBody(self::getBody())
            ->setSender(self::getSender())
            ->setPriority(self::getPriority());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'username' => self::getUsername(),
            'domain' => self::getDomain(),
            'event' => self::getEvent(),
            'etag' => self::getEtag(),
            'expires' => self::getExpires(),
            'received_time' => self::getReceivedTime(),
            'body' => self::getBody(),
            'sender' => self::getSender(),
            'priority' => self::getPriority()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set username
     *
     * @param string $username
     *
     * @return static
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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return static
     */
    protected function setDomain($domain)
    {
        Assertion::notNull($domain, 'domain value "%s" is null, but non null value was expected.');
        Assertion::maxLength($domain, 190, 'domain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * Set event
     *
     * @param string $event
     *
     * @return static
     */
    protected function setEvent($event)
    {
        Assertion::notNull($event, 'event value "%s" is null, but non null value was expected.');
        Assertion::maxLength($event, 64, 'event value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return string
     */
    public function getEvent(): string
    {
        return $this->event;
    }

    /**
     * Set etag
     *
     * @param string $etag
     *
     * @return static
     */
    protected function setEtag($etag)
    {
        Assertion::notNull($etag, 'etag value "%s" is null, but non null value was expected.');
        Assertion::maxLength($etag, 64, 'etag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->etag = $etag;

        return $this;
    }

    /**
     * Get etag
     *
     * @return string
     */
    public function getEtag(): string
    {
        return $this->etag;
    }

    /**
     * Set expires
     *
     * @param integer $expires
     *
     * @return static
     */
    protected function setExpires($expires)
    {
        Assertion::notNull($expires, 'expires value "%s" is null, but non null value was expected.');
        Assertion::integerish($expires, 'expires value "%s" is not an integer or a number castable to integer.');

        $this->expires = (int) $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return integer
     */
    public function getExpires(): int
    {
        return $this->expires;
    }

    /**
     * Set receivedTime
     *
     * @param integer $receivedTime
     *
     * @return static
     */
    protected function setReceivedTime($receivedTime)
    {
        Assertion::notNull($receivedTime, 'receivedTime value "%s" is null, but non null value was expected.');
        Assertion::integerish($receivedTime, 'receivedTime value "%s" is not an integer or a number castable to integer.');

        $this->receivedTime = (int) $receivedTime;

        return $this;
    }

    /**
     * Get receivedTime
     *
     * @return integer
     */
    public function getReceivedTime(): int
    {
        return $this->receivedTime;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return static
     */
    protected function setBody($body)
    {
        Assertion::notNull($body, 'body value "%s" is null, but non null value was expected.');

        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Set sender
     *
     * @param string $sender
     *
     * @return static
     */
    protected function setSender($sender)
    {
        Assertion::notNull($sender, 'sender value "%s" is null, but non null value was expected.');
        Assertion::maxLength($sender, 128, 'sender value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return string
     */
    public function getSender(): string
    {
        return $this->sender;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return static
     */
    protected function setPriority($priority)
    {
        Assertion::notNull($priority, 'priority value "%s" is null, but non null value was expected.');
        Assertion::integerish($priority, 'priority value "%s" is not an integer or a number castable to integer.');

        $this->priority = (int) $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    // @codeCoverageIgnoreEnd
}
