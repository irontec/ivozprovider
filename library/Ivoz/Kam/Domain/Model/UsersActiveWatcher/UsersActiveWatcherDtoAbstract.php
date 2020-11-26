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
    private $toUser;

    /**
     * @var string
     */
    private $toDomain;

    /**
     * @var string
     */
    private $event = 'presence';

    /**
     * @var string | null
     */
    private $eventId;

    /**
     * @var string
     */
    private $toTag;

    /**
     * @var string
     */
    private $fromTag;

    /**
     * @var string
     */
    private $callid;

    /**
     * @var int
     */
    private $localCseq;

    /**
     * @var int
     */
    private $remoteCseq;

    /**
     * @var string
     */
    private $contact;

    /**
     * @var string | null
     */
    private $recordRoute;

    /**
     * @var int
     */
    private $expires;

    /**
     * @var int
     */
    private $status = 2;

    /**
     * @var string | null
     */
    private $reason;

    /**
     * @var int
     */
    private $version = 0;

    /**
     * @var string
     */
    private $socketInfo;

    /**
     * @var string
     */
    private $localContact;

    /**
     * @var string
     */
    private $fromUser;

    /**
     * @var string
     */
    private $fromDomain;

    /**
     * @var int
     */
    private $updated;

    /**
     * @var int
     */
    private $updatedWinfo;

    /**
     * @var int
     */
    private $flags = 0;

    /**
     * @var string
     */
    private $userAgent = '';

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
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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
     * @param string $toUser | null
     *
     * @return static
     */
    public function setToUser(?string $toUser = null): self
    {
        $this->toUser = $toUser;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getToUser(): ?string
    {
        return $this->toUser;
    }

    /**
     * @param string $toDomain | null
     *
     * @return static
     */
    public function setToDomain(?string $toDomain = null): self
    {
        $this->toDomain = $toDomain;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getToDomain(): ?string
    {
        return $this->toDomain;
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
     * @param string $eventId | null
     *
     * @return static
     */
    public function setEventId(?string $eventId = null): self
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEventId(): ?string
    {
        return $this->eventId;
    }

    /**
     * @param string $toTag | null
     *
     * @return static
     */
    public function setToTag(?string $toTag = null): self
    {
        $this->toTag = $toTag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getToTag(): ?string
    {
        return $this->toTag;
    }

    /**
     * @param string $fromTag | null
     *
     * @return static
     */
    public function setFromTag(?string $fromTag = null): self
    {
        $this->fromTag = $fromTag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFromTag(): ?string
    {
        return $this->fromTag;
    }

    /**
     * @param string $callid | null
     *
     * @return static
     */
    public function setCallid(?string $callid = null): self
    {
        $this->callid = $callid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCallid(): ?string
    {
        return $this->callid;
    }

    /**
     * @param int $localCseq | null
     *
     * @return static
     */
    public function setLocalCseq(?int $localCseq = null): self
    {
        $this->localCseq = $localCseq;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getLocalCseq(): ?int
    {
        return $this->localCseq;
    }

    /**
     * @param int $remoteCseq | null
     *
     * @return static
     */
    public function setRemoteCseq(?int $remoteCseq = null): self
    {
        $this->remoteCseq = $remoteCseq;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getRemoteCseq(): ?int
    {
        return $this->remoteCseq;
    }

    /**
     * @param string $contact | null
     *
     * @return static
     */
    public function setContact(?string $contact = null): self
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getContact(): ?string
    {
        return $this->contact;
    }

    /**
     * @param string $recordRoute | null
     *
     * @return static
     */
    public function setRecordRoute(?string $recordRoute = null): self
    {
        $this->recordRoute = $recordRoute;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRecordRoute(): ?string
    {
        return $this->recordRoute;
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
     * @param int $version | null
     *
     * @return static
     */
    public function setVersion(?int $version = null): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getVersion(): ?int
    {
        return $this->version;
    }

    /**
     * @param string $socketInfo | null
     *
     * @return static
     */
    public function setSocketInfo(?string $socketInfo = null): self
    {
        $this->socketInfo = $socketInfo;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSocketInfo(): ?string
    {
        return $this->socketInfo;
    }

    /**
     * @param string $localContact | null
     *
     * @return static
     */
    public function setLocalContact(?string $localContact = null): self
    {
        $this->localContact = $localContact;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLocalContact(): ?string
    {
        return $this->localContact;
    }

    /**
     * @param string $fromUser | null
     *
     * @return static
     */
    public function setFromUser(?string $fromUser = null): self
    {
        $this->fromUser = $fromUser;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFromUser(): ?string
    {
        return $this->fromUser;
    }

    /**
     * @param string $fromDomain | null
     *
     * @return static
     */
    public function setFromDomain(?string $fromDomain = null): self
    {
        $this->fromDomain = $fromDomain;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFromDomain(): ?string
    {
        return $this->fromDomain;
    }

    /**
     * @param int $updated | null
     *
     * @return static
     */
    public function setUpdated(?int $updated = null): self
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getUpdated(): ?int
    {
        return $this->updated;
    }

    /**
     * @param int $updatedWinfo | null
     *
     * @return static
     */
    public function setUpdatedWinfo(?int $updatedWinfo = null): self
    {
        $this->updatedWinfo = $updatedWinfo;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getUpdatedWinfo(): ?int
    {
        return $this->updatedWinfo;
    }

    /**
     * @param int $flags | null
     *
     * @return static
     */
    public function setFlags(?int $flags = null): self
    {
        $this->flags = $flags;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getFlags(): ?int
    {
        return $this->flags;
    }

    /**
     * @param string $userAgent | null
     *
     * @return static
     */
    public function setUserAgent(?string $userAgent = null): self
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUserAgent(): ?string
    {
        return $this->userAgent;
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
