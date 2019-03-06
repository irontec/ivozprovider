<?php

namespace Ivoz\Kam\Domain\Model\UsersPresentity;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class UsersPresentityDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    private $event;

    /**
     * @var string
     */
    private $etag;

    /**
     * @var integer
     */
    private $expires;

    /**
     * @var integer
     */
    private $receivedTime;

    /**
     * @var string
     */
    private $body;

    /**
     * @var string
     */
    private $sender;

    /**
     * @var integer
     */
    private $priority = 0;

    /**
     * @var integer
     */
    private $id;


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
            'username' => 'username',
            'domain' => 'domain',
            'event' => 'event',
            'etag' => 'etag',
            'expires' => 'expires',
            'receivedTime' => 'receivedTime',
            'body' => 'body',
            'sender' => 'sender',
            'priority' => 'priority',
            'id' => 'id'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'username' => $this->getUsername(),
            'domain' => $this->getDomain(),
            'event' => $this->getEvent(),
            'etag' => $this->getEtag(),
            'expires' => $this->getExpires(),
            'receivedTime' => $this->getReceivedTime(),
            'body' => $this->getBody(),
            'sender' => $this->getSender(),
            'priority' => $this->getPriority(),
            'id' => $this->getId()
        ];
    }

    /**
     * @param string $username
     *
     * @return static
     */
    public function setUsername($username = null)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $domain
     *
     * @return static
     */
    public function setDomain($domain = null)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $event
     *
     * @return static
     */
    public function setEvent($event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param string $etag
     *
     * @return static
     */
    public function setEtag($etag = null)
    {
        $this->etag = $etag;

        return $this;
    }

    /**
     * @return string
     */
    public function getEtag()
    {
        return $this->etag;
    }

    /**
     * @param integer $expires
     *
     * @return static
     */
    public function setExpires($expires = null)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * @return integer
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * @param integer $receivedTime
     *
     * @return static
     */
    public function setReceivedTime($receivedTime = null)
    {
        $this->receivedTime = $receivedTime;

        return $this;
    }

    /**
     * @return integer
     */
    public function getReceivedTime()
    {
        return $this->receivedTime;
    }

    /**
     * @param string $body
     *
     * @return static
     */
    public function setBody($body = null)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $sender
     *
     * @return static
     */
    public function setSender($sender = null)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param integer $priority
     *
     * @return static
     */
    public function setPriority($priority = null)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
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
}
