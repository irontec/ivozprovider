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
     * @var string
     */
    private $presentityUri;

    /**
     * @var string
     */
    private $watcherUsername;

    /**
     * @var string
     */
    private $watcherDomain;

    /**
     * @var string
     */
    private $event = 'presence';

    /**
     * @var int
     */
    private $status;

    /**
     * @var string | null
     */
    private $reason;

    /**
     * @var int
     */
    private $insertedTime;

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
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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

    /**
     * @param string $presentityUri | null
     *
     * @return static
     */
    public function setPresentityUri(?string $presentityUri = null): self
    {
        $this->presentityUri = $presentityUri;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPresentityUri(): ?string
    {
        return $this->presentityUri;
    }

    /**
     * @param string $watcherUsername | null
     *
     * @return static
     */
    public function setWatcherUsername(?string $watcherUsername = null): self
    {
        $this->watcherUsername = $watcherUsername;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getWatcherUsername(): ?string
    {
        return $this->watcherUsername;
    }

    /**
     * @param string $watcherDomain | null
     *
     * @return static
     */
    public function setWatcherDomain(?string $watcherDomain = null): self
    {
        $this->watcherDomain = $watcherDomain;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getWatcherDomain(): ?string
    {
        return $this->watcherDomain;
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
     * @param int $status | null
     *
     * @return static
     */
    public function setStatus(?int $status = null): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param string $reason | null
     *
     * @return static
     */
    public function setReason(?string $reason = null): self
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getReason(): ?string
    {
        return $this->reason;
    }

    /**
     * @param int $insertedTime | null
     *
     * @return static
     */
    public function setInsertedTime(?int $insertedTime = null): self
    {
        $this->insertedTime = $insertedTime;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getInsertedTime(): ?int
    {
        return $this->insertedTime;
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
