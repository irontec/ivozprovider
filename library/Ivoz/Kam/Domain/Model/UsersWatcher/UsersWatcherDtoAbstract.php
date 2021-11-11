<?php

namespace Ivoz\Kam\Domain\Model\UsersWatcher;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
* UsersWatcherDtoAbstract
* @codeCoverageIgnore
*/
abstract class UsersWatcherDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $presentityUri = null;

    /**
     * @var string|null
     */
    private $watcherUsername = null;

    /**
     * @var string|null
     */
    private $watcherDomain = null;

    /**
     * @var string|null
     */
    private $event = 'presence';

    /**
     * @var int|null
     */
    private $status = null;

    /**
     * @var string|null
     */
    private $reason = null;

    /**
     * @var int|null
     */
    private $insertedTime = null;

    /**
     * @var int|null
     */
    private $id = null;

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
            'presentityUri' => 'presentityUri',
            'watcherUsername' => 'watcherUsername',
            'watcherDomain' => 'watcherDomain',
            'event' => 'event',
            'status' => 'status',
            'reason' => 'reason',
            'insertedTime' => 'insertedTime',
            'id' => 'id'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'presentityUri' => $this->getPresentityUri(),
            'watcherUsername' => $this->getWatcherUsername(),
            'watcherDomain' => $this->getWatcherDomain(),
            'event' => $this->getEvent(),
            'status' => $this->getStatus(),
            'reason' => $this->getReason(),
            'insertedTime' => $this->getInsertedTime(),
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

    public function setPresentityUri(string $presentityUri): static
    {
        $this->presentityUri = $presentityUri;

        return $this;
    }

    public function getPresentityUri(): ?string
    {
        return $this->presentityUri;
    }

    public function setWatcherUsername(string $watcherUsername): static
    {
        $this->watcherUsername = $watcherUsername;

        return $this;
    }

    public function getWatcherUsername(): ?string
    {
        return $this->watcherUsername;
    }

    public function setWatcherDomain(string $watcherDomain): static
    {
        $this->watcherDomain = $watcherDomain;

        return $this;
    }

    public function getWatcherDomain(): ?string
    {
        return $this->watcherDomain;
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

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setReason(?string $reason): static
    {
        $this->reason = $reason;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setInsertedTime(int $insertedTime): static
    {
        $this->insertedTime = $insertedTime;

        return $this;
    }

    public function getInsertedTime(): ?int
    {
        return $this->insertedTime;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
