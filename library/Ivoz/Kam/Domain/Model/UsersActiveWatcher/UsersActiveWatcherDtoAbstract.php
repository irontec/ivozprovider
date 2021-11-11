<?php

namespace Ivoz\Kam\Domain\Model\UsersActiveWatcher;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
* UsersActiveWatcherDtoAbstract
* @codeCoverageIgnore
*/
abstract class UsersActiveWatcherDtoAbstract implements DataTransferObjectInterface
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
    private $toUser = null;

    /**
     * @var string|null
     */
    private $toDomain = null;

    /**
     * @var string|null
     */
    private $event = 'presence';

    /**
     * @var string|null
     */
    private $eventId = null;

    /**
     * @var string|null
     */
    private $toTag = null;

    /**
     * @var string|null
     */
    private $fromTag = null;

    /**
     * @var string|null
     */
    private $callid = null;

    /**
     * @var int|null
     */
    private $localCseq = null;

    /**
     * @var int|null
     */
    private $remoteCseq = null;

    /**
     * @var string|null
     */
    private $contact = null;

    /**
     * @var string|null
     */
    private $recordRoute = null;

    /**
     * @var int|null
     */
    private $expires = null;

    /**
     * @var int|null
     */
    private $status = 2;

    /**
     * @var string|null
     */
    private $reason = null;

    /**
     * @var int|null
     */
    private $version = 0;

    /**
     * @var string|null
     */
    private $socketInfo = null;

    /**
     * @var string|null
     */
    private $localContact = null;

    /**
     * @var string|null
     */
    private $fromUser = null;

    /**
     * @var string|null
     */
    private $fromDomain = null;

    /**
     * @var int|null
     */
    private $updated = null;

    /**
     * @var int|null
     */
    private $updatedWinfo = null;

    /**
     * @var int|null
     */
    private $flags = 0;

    /**
     * @var string|null
     */
    private $userAgent = '';

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
            'toUser' => 'toUser',
            'toDomain' => 'toDomain',
            'event' => 'event',
            'eventId' => 'eventId',
            'toTag' => 'toTag',
            'fromTag' => 'fromTag',
            'callid' => 'callid',
            'localCseq' => 'localCseq',
            'remoteCseq' => 'remoteCseq',
            'contact' => 'contact',
            'recordRoute' => 'recordRoute',
            'expires' => 'expires',
            'status' => 'status',
            'reason' => 'reason',
            'version' => 'version',
            'socketInfo' => 'socketInfo',
            'localContact' => 'localContact',
            'fromUser' => 'fromUser',
            'fromDomain' => 'fromDomain',
            'updated' => 'updated',
            'updatedWinfo' => 'updatedWinfo',
            'flags' => 'flags',
            'userAgent' => 'userAgent',
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
            'toUser' => $this->getToUser(),
            'toDomain' => $this->getToDomain(),
            'event' => $this->getEvent(),
            'eventId' => $this->getEventId(),
            'toTag' => $this->getToTag(),
            'fromTag' => $this->getFromTag(),
            'callid' => $this->getCallid(),
            'localCseq' => $this->getLocalCseq(),
            'remoteCseq' => $this->getRemoteCseq(),
            'contact' => $this->getContact(),
            'recordRoute' => $this->getRecordRoute(),
            'expires' => $this->getExpires(),
            'status' => $this->getStatus(),
            'reason' => $this->getReason(),
            'version' => $this->getVersion(),
            'socketInfo' => $this->getSocketInfo(),
            'localContact' => $this->getLocalContact(),
            'fromUser' => $this->getFromUser(),
            'fromDomain' => $this->getFromDomain(),
            'updated' => $this->getUpdated(),
            'updatedWinfo' => $this->getUpdatedWinfo(),
            'flags' => $this->getFlags(),
            'userAgent' => $this->getUserAgent(),
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

    public function setToUser(string $toUser): static
    {
        $this->toUser = $toUser;

        return $this;
    }

    public function getToUser(): ?string
    {
        return $this->toUser;
    }

    public function setToDomain(string $toDomain): static
    {
        $this->toDomain = $toDomain;

        return $this;
    }

    public function getToDomain(): ?string
    {
        return $this->toDomain;
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

    public function setEventId(?string $eventId): static
    {
        $this->eventId = $eventId;

        return $this;
    }

    public function getEventId(): ?string
    {
        return $this->eventId;
    }

    public function setToTag(string $toTag): static
    {
        $this->toTag = $toTag;

        return $this;
    }

    public function getToTag(): ?string
    {
        return $this->toTag;
    }

    public function setFromTag(string $fromTag): static
    {
        $this->fromTag = $fromTag;

        return $this;
    }

    public function getFromTag(): ?string
    {
        return $this->fromTag;
    }

    public function setCallid(string $callid): static
    {
        $this->callid = $callid;

        return $this;
    }

    public function getCallid(): ?string
    {
        return $this->callid;
    }

    public function setLocalCseq(int $localCseq): static
    {
        $this->localCseq = $localCseq;

        return $this;
    }

    public function getLocalCseq(): ?int
    {
        return $this->localCseq;
    }

    public function setRemoteCseq(int $remoteCseq): static
    {
        $this->remoteCseq = $remoteCseq;

        return $this;
    }

    public function getRemoteCseq(): ?int
    {
        return $this->remoteCseq;
    }

    public function setContact(string $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setRecordRoute(?string $recordRoute): static
    {
        $this->recordRoute = $recordRoute;

        return $this;
    }

    public function getRecordRoute(): ?string
    {
        return $this->recordRoute;
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

    public function setVersion(int $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function getVersion(): ?int
    {
        return $this->version;
    }

    public function setSocketInfo(string $socketInfo): static
    {
        $this->socketInfo = $socketInfo;

        return $this;
    }

    public function getSocketInfo(): ?string
    {
        return $this->socketInfo;
    }

    public function setLocalContact(string $localContact): static
    {
        $this->localContact = $localContact;

        return $this;
    }

    public function getLocalContact(): ?string
    {
        return $this->localContact;
    }

    public function setFromUser(string $fromUser): static
    {
        $this->fromUser = $fromUser;

        return $this;
    }

    public function getFromUser(): ?string
    {
        return $this->fromUser;
    }

    public function setFromDomain(string $fromDomain): static
    {
        $this->fromDomain = $fromDomain;

        return $this;
    }

    public function getFromDomain(): ?string
    {
        return $this->fromDomain;
    }

    public function setUpdated(int $updated): static
    {
        $this->updated = $updated;

        return $this;
    }

    public function getUpdated(): ?int
    {
        return $this->updated;
    }

    public function setUpdatedWinfo(int $updatedWinfo): static
    {
        $this->updatedWinfo = $updatedWinfo;

        return $this;
    }

    public function getUpdatedWinfo(): ?int
    {
        return $this->updatedWinfo;
    }

    public function setFlags(int $flags): static
    {
        $this->flags = $flags;

        return $this;
    }

    public function getFlags(): ?int
    {
        return $this->flags;
    }

    public function setUserAgent(string $userAgent): static
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    public function getUserAgent(): ?string
    {
        return $this->userAgent;
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
