<?php

namespace Ivoz\Kam\Domain\Model\UsersPua;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
* UsersPuaDtoAbstract
* @codeCoverageIgnore
*/
abstract class UsersPuaDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $presUri;

    /**
     * @var string
     */
    private $presId;

    /**
     * @var int
     */
    private $event;

    /**
     * @var int
     */
    private $expires;

    /**
     * @var int
     */
    private $desiredExpires;

    /**
     * @var int
     */
    private $flag;

    /**
     * @var string
     */
    private $etag;

    /**
     * @var string|null
     */
    private $tupleId;

    /**
     * @var string
     */
    private $watcherUri;

    /**
     * @var string
     */
    private $callId;

    /**
     * @var string
     */
    private $toTag;

    /**
     * @var string
     */
    private $fromTag;

    /**
     * @var int
     */
    private $cseq;

    /**
     * @var string|null
     */
    private $recordRoute;

    /**
     * @var string
     */
    private $contact;

    /**
     * @var string
     */
    private $remoteContact;

    /**
     * @var int
     */
    private $version;

    /**
     * @var string
     */
    private $extraHeaders;

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
            'presUri' => 'presUri',
            'presId' => 'presId',
            'event' => 'event',
            'expires' => 'expires',
            'desiredExpires' => 'desiredExpires',
            'flag' => 'flag',
            'etag' => 'etag',
            'tupleId' => 'tupleId',
            'watcherUri' => 'watcherUri',
            'callId' => 'callId',
            'toTag' => 'toTag',
            'fromTag' => 'fromTag',
            'cseq' => 'cseq',
            'recordRoute' => 'recordRoute',
            'contact' => 'contact',
            'remoteContact' => 'remoteContact',
            'version' => 'version',
            'extraHeaders' => 'extraHeaders',
            'id' => 'id'
        ];
    }

    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'presUri' => $this->getPresUri(),
            'presId' => $this->getPresId(),
            'event' => $this->getEvent(),
            'expires' => $this->getExpires(),
            'desiredExpires' => $this->getDesiredExpires(),
            'flag' => $this->getFlag(),
            'etag' => $this->getEtag(),
            'tupleId' => $this->getTupleId(),
            'watcherUri' => $this->getWatcherUri(),
            'callId' => $this->getCallId(),
            'toTag' => $this->getToTag(),
            'fromTag' => $this->getFromTag(),
            'cseq' => $this->getCseq(),
            'recordRoute' => $this->getRecordRoute(),
            'contact' => $this->getContact(),
            'remoteContact' => $this->getRemoteContact(),
            'version' => $this->getVersion(),
            'extraHeaders' => $this->getExtraHeaders(),
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

    public function setPresUri(string $presUri): static
    {
        $this->presUri = $presUri;

        return $this;
    }

    public function getPresUri(): ?string
    {
        return $this->presUri;
    }

    public function setPresId(string $presId): static
    {
        $this->presId = $presId;

        return $this;
    }

    public function getPresId(): ?string
    {
        return $this->presId;
    }

    public function setEvent(int $event): static
    {
        $this->event = $event;

        return $this;
    }

    public function getEvent(): ?int
    {
        return $this->event;
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

    public function setDesiredExpires(int $desiredExpires): static
    {
        $this->desiredExpires = $desiredExpires;

        return $this;
    }

    public function getDesiredExpires(): ?int
    {
        return $this->desiredExpires;
    }

    public function setFlag(int $flag): static
    {
        $this->flag = $flag;

        return $this;
    }

    public function getFlag(): ?int
    {
        return $this->flag;
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

    public function setTupleId(?string $tupleId): static
    {
        $this->tupleId = $tupleId;

        return $this;
    }

    public function getTupleId(): ?string
    {
        return $this->tupleId;
    }

    public function setWatcherUri(string $watcherUri): static
    {
        $this->watcherUri = $watcherUri;

        return $this;
    }

    public function getWatcherUri(): ?string
    {
        return $this->watcherUri;
    }

    public function setCallId(string $callId): static
    {
        $this->callId = $callId;

        return $this;
    }

    public function getCallId(): ?string
    {
        return $this->callId;
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

    public function setCseq(int $cseq): static
    {
        $this->cseq = $cseq;

        return $this;
    }

    public function getCseq(): ?int
    {
        return $this->cseq;
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

    public function setContact(string $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setRemoteContact(string $remoteContact): static
    {
        $this->remoteContact = $remoteContact;

        return $this;
    }

    public function getRemoteContact(): ?string
    {
        return $this->remoteContact;
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

    public function setExtraHeaders(string $extraHeaders): static
    {
        $this->extraHeaders = $extraHeaders;

        return $this;
    }

    public function getExtraHeaders(): ?string
    {
        return $this->extraHeaders;
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
