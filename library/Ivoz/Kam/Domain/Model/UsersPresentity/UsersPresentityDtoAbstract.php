<?php

namespace Ivoz\Kam\Domain\Model\UsersPresentity;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
* UsersPresentityDtoAbstract
* @codeCoverageIgnore
*/
abstract class UsersPresentityDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

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
     * @var int
     */
    private $expires;

    /**
     * @var int
     */
    private $receivedTime;

    /**
     * @var 
     */
    private $body;

    /**
     * @var string
     */
    private $sender;

    /**
     * @var int
     */
    private $priority = 0;

    /**
     * @var int
     */
    private $id;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
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
        $response = [
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

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    /**
     * @param string $username | null
     *
     * @return static
     */
    public function setUsername(?string $username = null): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $domain | null
     *
     * @return static
     */
    public function setDomain(?string $domain = null): self
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @param string $event | null
     *
     * @return static
     */
    public function setEvent(?string $event = null): self
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEvent(): ?string
    {
        return $this->event;
    }

    /**
     * @param string $etag | null
     *
     * @return static
     */
    public function setEtag(?string $etag = null): self
    {
        $this->etag = $etag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEtag(): ?string
    {
        return $this->etag;
    }

    /**
     * @param int $expires | null
     *
     * @return static
     */
    public function setExpires(?int $expires = null): self
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getExpires(): ?int
    {
        return $this->expires;
    }

    /**
     * @param int $receivedTime | null
     *
     * @return static
     */
    public function setReceivedTime(?int $receivedTime = null): self
    {
        $this->receivedTime = $receivedTime;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getReceivedTime(): ?int
    {
        return $this->receivedTime;
    }

    /**
     * @param  $body | null
     *
     * @return static
     */
    public function setBody(? $body = null): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return  | null
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $sender | null
     *
     * @return static
     */
    public function setSender(?string $sender = null): self
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSender(): ?string
    {
        return $this->sender;
    }

    /**
     * @param int $priority | null
     *
     * @return static
     */
    public function setPriority(?int $priority = null): self
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

}
