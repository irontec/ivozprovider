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
     * @var string | null
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
     * @var string | null
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
    public static function getPropertyMap(string $context = '', string $role = null)
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

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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

    /**
     * @param string $presUri | null
     *
     * @return static
     */
    public function setPresUri(?string $presUri = null): self
    {
        $this->presUri = $presUri;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPresUri(): ?string
    {
        return $this->presUri;
    }

    /**
     * @param string $presId | null
     *
     * @return static
     */
    public function setPresId(?string $presId = null): self
    {
        $this->presId = $presId;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPresId(): ?string
    {
        return $this->presId;
    }

    /**
     * @param int $event | null
     *
     * @return static
     */
    public function setEvent(?int $event = null): self
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getEvent(): ?int
    {
        return $this->event;
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
     * @param int $desiredExpires | null
     *
     * @return static
     */
    public function setDesiredExpires(?int $desiredExpires = null): self
    {
        $this->desiredExpires = $desiredExpires;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getDesiredExpires(): ?int
    {
        return $this->desiredExpires;
    }

    /**
     * @param int $flag | null
     *
     * @return static
     */
    public function setFlag(?int $flag = null): self
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getFlag(): ?int
    {
        return $this->flag;
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
     * @param string $tupleId | null
     *
     * @return static
     */
    public function setTupleId(?string $tupleId = null): self
    {
        $this->tupleId = $tupleId;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTupleId(): ?string
    {
        return $this->tupleId;
    }

    /**
     * @param string $watcherUri | null
     *
     * @return static
     */
    public function setWatcherUri(?string $watcherUri = null): self
    {
        $this->watcherUri = $watcherUri;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getWatcherUri(): ?string
    {
        return $this->watcherUri;
    }

    /**
     * @param string $callId | null
     *
     * @return static
     */
    public function setCallId(?string $callId = null): self
    {
        $this->callId = $callId;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCallId(): ?string
    {
        return $this->callId;
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
     * @param int $cseq | null
     *
     * @return static
     */
    public function setCseq(?int $cseq = null): self
    {
        $this->cseq = $cseq;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getCseq(): ?int
    {
        return $this->cseq;
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
     * @param string $remoteContact | null
     *
     * @return static
     */
    public function setRemoteContact(?string $remoteContact = null): self
    {
        $this->remoteContact = $remoteContact;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRemoteContact(): ?string
    {
        return $this->remoteContact;
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
     * @param string $extraHeaders | null
     *
     * @return static
     */
    public function setExtraHeaders(?string $extraHeaders = null): self
    {
        $this->extraHeaders = $extraHeaders;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getExtraHeaders(): ?string
    {
        return $this->extraHeaders;
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
