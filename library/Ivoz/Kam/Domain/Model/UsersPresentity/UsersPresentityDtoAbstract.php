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
     * @var string
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
     * @var string|null
     */
    private $ruid;

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
    public static function getPropertyMap(string $context = '', string $role = null): array
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
            'ruid' => 'ruid',
            'id' => 'id'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
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
            'ruid' => $this->getRuid(),
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

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setDomain(string $domain): static
    {
        $this->domain = $domain;

        return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setEvent(string $event): static
    {
        $this->event = $event;

        return $this;
    }

    public function getEvent(): ?string
    {
        return $this->event;
    }

    public function setEtag(string $etag): static
    {
        $this->etag = $etag;

        return $this;
    }

    public function getEtag(): ?string
    {
        return $this->etag;
    }

    public function setExpires(int $expires): static
    {
        $this->expires = $expires;

        return $this;
    }

    public function getExpires(): ?int
    {
        return $this->expires;
    }

    public function setReceivedTime(int $receivedTime): static
    {
        $this->receivedTime = $receivedTime;

        return $this;
    }

    public function getReceivedTime(): ?int
    {
        return $this->receivedTime;
    }

    public function setBody(string $body): static
    {
        $this->body = $body;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setSender(string $sender): static
    {
        $this->sender = $sender;

        return $this;
    }

    public function getSender(): ?string
    {
        return $this->sender;
    }

    public function setPriority(int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setRuid(?string $ruid): static
    {
        $this->ruid = $ruid;

        return $this;
    }

    public function getRuid(): ?string
    {
        return $this->ruid;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }
}
