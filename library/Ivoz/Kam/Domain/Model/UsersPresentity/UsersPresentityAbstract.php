<?php

namespace Ivoz\Kam\Domain\Model\UsersPresentity;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

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
     * @column received_time
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
    protected $priority = '0';


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct(
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
     * @return UsersPresentityDTO
     */
    public static function createDTO()
    {
        return new UsersPresentityDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UsersPresentityDTO
         */
        Assertion::isInstanceOf($dto, UsersPresentityDTO::class);

        $self = new static(
            $dto->getUsername(),
            $dto->getDomain(),
            $dto->getEvent(),
            $dto->getEtag(),
            $dto->getExpires(),
            $dto->getReceivedTime(),
            $dto->getBody(),
            $dto->getSender(),
            $dto->getPriority());

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UsersPresentityDTO
         */
        Assertion::isInstanceOf($dto, UsersPresentityDTO::class);

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
     * @return UsersPresentityDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setUsername($this->getUsername())
            ->setDomain($this->getDomain())
            ->setEvent($this->getEvent())
            ->setEtag($this->getEtag())
            ->setExpires($this->getExpires())
            ->setReceivedTime($this->getReceivedTime())
            ->setBody($this->getBody())
            ->setSender($this->getSender())
            ->setPriority($this->getPriority());
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
    public function setDomain($domain)
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
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set event
     *
     * @param string $event
     *
     * @return self
     */
    public function setEvent($event)
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
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set etag
     *
     * @param string $etag
     *
     * @return self
     */
    public function setEtag($etag)
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
    public function getEtag()
    {
        return $this->etag;
    }

    /**
     * Set expires
     *
     * @param integer $expires
     *
     * @return self
     */
    public function setExpires($expires)
    {
        Assertion::notNull($expires, 'expires value "%s" is null, but non null value was expected.');
        Assertion::integerish($expires, 'expires value "%s" is not an integer or a number castable to integer.');

        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return integer
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Set receivedTime
     *
     * @param integer $receivedTime
     *
     * @return self
     */
    public function setReceivedTime($receivedTime)
    {
        Assertion::notNull($receivedTime, 'receivedTime value "%s" is null, but non null value was expected.');
        Assertion::integerish($receivedTime, 'receivedTime value "%s" is not an integer or a number castable to integer.');

        $this->receivedTime = $receivedTime;

        return $this;
    }

    /**
     * Get receivedTime
     *
     * @return integer
     */
    public function getReceivedTime()
    {
        return $this->receivedTime;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return self
     */
    public function setBody($body)
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
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set sender
     *
     * @param string $sender
     *
     * @return self
     */
    public function setSender($sender)
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
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return self
     */
    public function setPriority($priority)
    {
        Assertion::notNull($priority, 'priority value "%s" is null, but non null value was expected.');
        Assertion::integerish($priority, 'priority value "%s" is not an integer or a number castable to integer.');

        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }



    // @codeCoverageIgnoreEnd
}

