<?php
declare(strict_types = 1);

namespace Ivoz\Kam\Domain\Model\UsersPua;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* UsersPuaAbstract
* @codeCoverageIgnore
*/
abstract class UsersPuaAbstract
{
    use ChangelogTrait;

    /**
     * column: pres_uri
     * @var string
     */
    protected $presUri;

    /**
     * column: pres_id
     * @var string
     */
    protected $presId;

    /**
     * @var int
     */
    protected $event;

    /**
     * @var int
     */
    protected $expires;

    /**
     * column: desired_expires
     * @var int
     */
    protected $desiredExpires;

    /**
     * @var int
     */
    protected $flag;

    /**
     * @var string
     */
    protected $etag;

    /**
     * column: tuple_id
     * @var string | null
     */
    protected $tupleId;

    /**
     * column: watcher_uri
     * @var string
     */
    protected $watcherUri;

    /**
     * column: call_id
     * @var string
     */
    protected $callId;

    /**
     * column: to_tag
     * @var string
     */
    protected $toTag;

    /**
     * column: from_tag
     * @var string
     */
    protected $fromTag;

    /**
     * @var int
     */
    protected $cseq;

    /**
     * column: record_route
     * @var string | null
     */
    protected $recordRoute;

    /**
     * @var string
     */
    protected $contact;

    /**
     * column: remote_contact
     * @var string
     */
    protected $remoteContact;

    /**
     * @var int
     */
    protected $version;

    /**
     * column: extra_headers
     * @var string
     */
    protected $extraHeaders;

    /**
     * Constructor
     */
    protected function __construct(
        $presUri,
        $presId,
        $event,
        $expires,
        $desiredExpires,
        $flag,
        $etag,
        $watcherUri,
        $callId,
        $toTag,
        $fromTag,
        $cseq,
        $contact,
        $remoteContact,
        $version,
        $extraHeaders
    ) {
        $this->setPresUri($presUri);
        $this->setPresId($presId);
        $this->setEvent($event);
        $this->setExpires($expires);
        $this->setDesiredExpires($desiredExpires);
        $this->setFlag($flag);
        $this->setEtag($etag);
        $this->setWatcherUri($watcherUri);
        $this->setCallId($callId);
        $this->setToTag($toTag);
        $this->setFromTag($fromTag);
        $this->setCseq($cseq);
        $this->setContact($contact);
        $this->setRemoteContact($remoteContact);
        $this->setVersion($version);
        $this->setExtraHeaders($extraHeaders);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "UsersPua",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return UsersPuaDto
     */
    public static function createDto($id = null)
    {
        return new UsersPuaDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param UsersPuaInterface|null $entity
     * @param int $depth
     * @return UsersPuaDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, UsersPuaInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var UsersPuaDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersPuaDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, UsersPuaDto::class);

        $self = new static(
            $dto->getPresUri(),
            $dto->getPresId(),
            $dto->getEvent(),
            $dto->getExpires(),
            $dto->getDesiredExpires(),
            $dto->getFlag(),
            $dto->getEtag(),
            $dto->getWatcherUri(),
            $dto->getCallId(),
            $dto->getToTag(),
            $dto->getFromTag(),
            $dto->getCseq(),
            $dto->getContact(),
            $dto->getRemoteContact(),
            $dto->getVersion(),
            $dto->getExtraHeaders()
        );

        $self
            ->setTupleId($dto->getTupleId())
            ->setRecordRoute($dto->getRecordRoute());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param UsersPuaDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, UsersPuaDto::class);

        $this
            ->setPresUri($dto->getPresUri())
            ->setPresId($dto->getPresId())
            ->setEvent($dto->getEvent())
            ->setExpires($dto->getExpires())
            ->setDesiredExpires($dto->getDesiredExpires())
            ->setFlag($dto->getFlag())
            ->setEtag($dto->getEtag())
            ->setTupleId($dto->getTupleId())
            ->setWatcherUri($dto->getWatcherUri())
            ->setCallId($dto->getCallId())
            ->setToTag($dto->getToTag())
            ->setFromTag($dto->getFromTag())
            ->setCseq($dto->getCseq())
            ->setRecordRoute($dto->getRecordRoute())
            ->setContact($dto->getContact())
            ->setRemoteContact($dto->getRemoteContact())
            ->setVersion($dto->getVersion())
            ->setExtraHeaders($dto->getExtraHeaders());

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return UsersPuaDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setPresUri(self::getPresUri())
            ->setPresId(self::getPresId())
            ->setEvent(self::getEvent())
            ->setExpires(self::getExpires())
            ->setDesiredExpires(self::getDesiredExpires())
            ->setFlag(self::getFlag())
            ->setEtag(self::getEtag())
            ->setTupleId(self::getTupleId())
            ->setWatcherUri(self::getWatcherUri())
            ->setCallId(self::getCallId())
            ->setToTag(self::getToTag())
            ->setFromTag(self::getFromTag())
            ->setCseq(self::getCseq())
            ->setRecordRoute(self::getRecordRoute())
            ->setContact(self::getContact())
            ->setRemoteContact(self::getRemoteContact())
            ->setVersion(self::getVersion())
            ->setExtraHeaders(self::getExtraHeaders());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'pres_uri' => self::getPresUri(),
            'pres_id' => self::getPresId(),
            'event' => self::getEvent(),
            'expires' => self::getExpires(),
            'desired_expires' => self::getDesiredExpires(),
            'flag' => self::getFlag(),
            'etag' => self::getEtag(),
            'tuple_id' => self::getTupleId(),
            'watcher_uri' => self::getWatcherUri(),
            'call_id' => self::getCallId(),
            'to_tag' => self::getToTag(),
            'from_tag' => self::getFromTag(),
            'cseq' => self::getCseq(),
            'record_route' => self::getRecordRoute(),
            'contact' => self::getContact(),
            'remote_contact' => self::getRemoteContact(),
            'version' => self::getVersion(),
            'extra_headers' => self::getExtraHeaders()
        ];
    }

    /**
     * Set presUri
     *
     * @param string $presUri
     *
     * @return static
     */
    protected function setPresUri(string $presUri): UsersPuaInterface
    {
        Assertion::maxLength($presUri, 128, 'presUri value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->presUri = $presUri;

        return $this;
    }

    /**
     * Get presUri
     *
     * @return string
     */
    public function getPresUri(): string
    {
        return $this->presUri;
    }

    /**
     * Set presId
     *
     * @param string $presId
     *
     * @return static
     */
    protected function setPresId(string $presId): UsersPuaInterface
    {
        Assertion::maxLength($presId, 255, 'presId value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->presId = $presId;

        return $this;
    }

    /**
     * Get presId
     *
     * @return string
     */
    public function getPresId(): string
    {
        return $this->presId;
    }

    /**
     * Set event
     *
     * @param int $event
     *
     * @return static
     */
    protected function setEvent(int $event): UsersPuaInterface
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return int
     */
    public function getEvent(): int
    {
        return $this->event;
    }

    /**
     * Set expires
     *
     * @param int $expires
     *
     * @return static
     */
    protected function setExpires(int $expires): UsersPuaInterface
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return int
     */
    public function getExpires(): int
    {
        return $this->expires;
    }

    /**
     * Set desiredExpires
     *
     * @param int $desiredExpires
     *
     * @return static
     */
    protected function setDesiredExpires(int $desiredExpires): UsersPuaInterface
    {
        $this->desiredExpires = $desiredExpires;

        return $this;
    }

    /**
     * Get desiredExpires
     *
     * @return int
     */
    public function getDesiredExpires(): int
    {
        return $this->desiredExpires;
    }

    /**
     * Set flag
     *
     * @param int $flag
     *
     * @return static
     */
    protected function setFlag(int $flag): UsersPuaInterface
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return int
     */
    public function getFlag(): int
    {
        return $this->flag;
    }

    /**
     * Set etag
     *
     * @param string $etag
     *
     * @return static
     */
    protected function setEtag(string $etag): UsersPuaInterface
    {
        Assertion::maxLength($etag, 64, 'etag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->etag = $etag;

        return $this;
    }

    /**
     * Get etag
     *
     * @return string
     */
    public function getEtag(): string
    {
        return $this->etag;
    }

    /**
     * Set tupleId
     *
     * @param string $tupleId | null
     *
     * @return static
     */
    protected function setTupleId(?string $tupleId = null): UsersPuaInterface
    {
        if (!is_null($tupleId)) {
            Assertion::maxLength($tupleId, 64, 'tupleId value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->tupleId = $tupleId;

        return $this;
    }

    /**
     * Get tupleId
     *
     * @return string | null
     */
    public function getTupleId(): ?string
    {
        return $this->tupleId;
    }

    /**
     * Set watcherUri
     *
     * @param string $watcherUri
     *
     * @return static
     */
    protected function setWatcherUri(string $watcherUri): UsersPuaInterface
    {
        Assertion::maxLength($watcherUri, 128, 'watcherUri value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->watcherUri = $watcherUri;

        return $this;
    }

    /**
     * Get watcherUri
     *
     * @return string
     */
    public function getWatcherUri(): string
    {
        return $this->watcherUri;
    }

    /**
     * Set callId
     *
     * @param string $callId
     *
     * @return static
     */
    protected function setCallId(string $callId): UsersPuaInterface
    {
        Assertion::maxLength($callId, 255, 'callId value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->callId = $callId;

        return $this;
    }

    /**
     * Get callId
     *
     * @return string
     */
    public function getCallId(): string
    {
        return $this->callId;
    }

    /**
     * Set toTag
     *
     * @param string $toTag
     *
     * @return static
     */
    protected function setToTag(string $toTag): UsersPuaInterface
    {
        Assertion::maxLength($toTag, 64, 'toTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->toTag = $toTag;

        return $this;
    }

    /**
     * Get toTag
     *
     * @return string
     */
    public function getToTag(): string
    {
        return $this->toTag;
    }

    /**
     * Set fromTag
     *
     * @param string $fromTag
     *
     * @return static
     */
    protected function setFromTag(string $fromTag): UsersPuaInterface
    {
        Assertion::maxLength($fromTag, 64, 'fromTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->fromTag = $fromTag;

        return $this;
    }

    /**
     * Get fromTag
     *
     * @return string
     */
    public function getFromTag(): string
    {
        return $this->fromTag;
    }

    /**
     * Set cseq
     *
     * @param int $cseq
     *
     * @return static
     */
    protected function setCseq(int $cseq): UsersPuaInterface
    {
        $this->cseq = $cseq;

        return $this;
    }

    /**
     * Get cseq
     *
     * @return int
     */
    public function getCseq(): int
    {
        return $this->cseq;
    }

    /**
     * Set recordRoute
     *
     * @param string $recordRoute | null
     *
     * @return static
     */
    protected function setRecordRoute(?string $recordRoute = null): UsersPuaInterface
    {
        if (!is_null($recordRoute)) {
            Assertion::maxLength($recordRoute, 65535, 'recordRoute value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->recordRoute = $recordRoute;

        return $this;
    }

    /**
     * Get recordRoute
     *
     * @return string | null
     */
    public function getRecordRoute(): ?string
    {
        return $this->recordRoute;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return static
     */
    protected function setContact(string $contact): UsersPuaInterface
    {
        Assertion::maxLength($contact, 128, 'contact value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact(): string
    {
        return $this->contact;
    }

    /**
     * Set remoteContact
     *
     * @param string $remoteContact
     *
     * @return static
     */
    protected function setRemoteContact(string $remoteContact): UsersPuaInterface
    {
        Assertion::maxLength($remoteContact, 128, 'remoteContact value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->remoteContact = $remoteContact;

        return $this;
    }

    /**
     * Get remoteContact
     *
     * @return string
     */
    public function getRemoteContact(): string
    {
        return $this->remoteContact;
    }

    /**
     * Set version
     *
     * @param int $version
     *
     * @return static
     */
    protected function setVersion(int $version): UsersPuaInterface
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * Set extraHeaders
     *
     * @param string $extraHeaders
     *
     * @return static
     */
    protected function setExtraHeaders(string $extraHeaders): UsersPuaInterface
    {
        Assertion::maxLength($extraHeaders, 65535, 'extraHeaders value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->extraHeaders = $extraHeaders;

        return $this;
    }

    /**
     * Get extraHeaders
     *
     * @return string
     */
    public function getExtraHeaders(): string
    {
        return $this->extraHeaders;
    }

}
