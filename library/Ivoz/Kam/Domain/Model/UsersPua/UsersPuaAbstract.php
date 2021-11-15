<?php

declare(strict_types=1);

namespace Ivoz\Kam\Domain\Model\UsersPua;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* UsersPuaAbstract
* @codeCoverageIgnore
*/
abstract class UsersPuaAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     * column: pres_uri
     */
    protected $presUri;

    /**
     * @var string
     * column: pres_id
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
     * @var int
     * column: desired_expires
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
     * @var ?string
     * column: tuple_id
     */
    protected $tupleId = null;

    /**
     * @var string
     * column: watcher_uri
     */
    protected $watcherUri;

    /**
     * @var string
     * column: call_id
     */
    protected $callId;

    /**
     * @var string
     * column: to_tag
     */
    protected $toTag;

    /**
     * @var string
     * column: from_tag
     */
    protected $fromTag;

    /**
     * @var int
     */
    protected $cseq;

    /**
     * @var ?string
     * column: record_route
     */
    protected $recordRoute = null;

    /**
     * @var string
     */
    protected $contact;

    /**
     * @var string
     * column: remote_contact
     */
    protected $remoteContact;

    /**
     * @var int
     */
    protected $version;

    /**
     * @var string
     * column: extra_headers
     */
    protected $extraHeaders;

    /**
     * Constructor
     */
    protected function __construct(
        string $presUri,
        string $presId,
        int $event,
        int $expires,
        int $desiredExpires,
        int $flag,
        string $etag,
        string $watcherUri,
        string $callId,
        string $toTag,
        string $fromTag,
        int $cseq,
        string $contact,
        string $remoteContact,
        int $version,
        string $extraHeaders
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

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "UsersPua",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): UsersPuaDto
    {
        return new UsersPuaDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|UsersPuaInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UsersPuaDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersPuaDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, UsersPuaDto::class);
        $presUri = $dto->getPresUri();
        Assertion::notNull($presUri, 'getPresUri value is null, but non null value was expected.');
        $presId = $dto->getPresId();
        Assertion::notNull($presId, 'getPresId value is null, but non null value was expected.');
        $event = $dto->getEvent();
        Assertion::notNull($event, 'getEvent value is null, but non null value was expected.');
        $expires = $dto->getExpires();
        Assertion::notNull($expires, 'getExpires value is null, but non null value was expected.');
        $desiredExpires = $dto->getDesiredExpires();
        Assertion::notNull($desiredExpires, 'getDesiredExpires value is null, but non null value was expected.');
        $flag = $dto->getFlag();
        Assertion::notNull($flag, 'getFlag value is null, but non null value was expected.');
        $etag = $dto->getEtag();
        Assertion::notNull($etag, 'getEtag value is null, but non null value was expected.');
        $watcherUri = $dto->getWatcherUri();
        Assertion::notNull($watcherUri, 'getWatcherUri value is null, but non null value was expected.');
        $callId = $dto->getCallId();
        Assertion::notNull($callId, 'getCallId value is null, but non null value was expected.');
        $toTag = $dto->getToTag();
        Assertion::notNull($toTag, 'getToTag value is null, but non null value was expected.');
        $fromTag = $dto->getFromTag();
        Assertion::notNull($fromTag, 'getFromTag value is null, but non null value was expected.');
        $cseq = $dto->getCseq();
        Assertion::notNull($cseq, 'getCseq value is null, but non null value was expected.');
        $contact = $dto->getContact();
        Assertion::notNull($contact, 'getContact value is null, but non null value was expected.');
        $remoteContact = $dto->getRemoteContact();
        Assertion::notNull($remoteContact, 'getRemoteContact value is null, but non null value was expected.');
        $version = $dto->getVersion();
        Assertion::notNull($version, 'getVersion value is null, but non null value was expected.');
        $extraHeaders = $dto->getExtraHeaders();
        Assertion::notNull($extraHeaders, 'getExtraHeaders value is null, but non null value was expected.');

        $self = new static(
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, UsersPuaDto::class);

        $presUri = $dto->getPresUri();
        Assertion::notNull($presUri, 'getPresUri value is null, but non null value was expected.');
        $presId = $dto->getPresId();
        Assertion::notNull($presId, 'getPresId value is null, but non null value was expected.');
        $event = $dto->getEvent();
        Assertion::notNull($event, 'getEvent value is null, but non null value was expected.');
        $expires = $dto->getExpires();
        Assertion::notNull($expires, 'getExpires value is null, but non null value was expected.');
        $desiredExpires = $dto->getDesiredExpires();
        Assertion::notNull($desiredExpires, 'getDesiredExpires value is null, but non null value was expected.');
        $flag = $dto->getFlag();
        Assertion::notNull($flag, 'getFlag value is null, but non null value was expected.');
        $etag = $dto->getEtag();
        Assertion::notNull($etag, 'getEtag value is null, but non null value was expected.');
        $watcherUri = $dto->getWatcherUri();
        Assertion::notNull($watcherUri, 'getWatcherUri value is null, but non null value was expected.');
        $callId = $dto->getCallId();
        Assertion::notNull($callId, 'getCallId value is null, but non null value was expected.');
        $toTag = $dto->getToTag();
        Assertion::notNull($toTag, 'getToTag value is null, but non null value was expected.');
        $fromTag = $dto->getFromTag();
        Assertion::notNull($fromTag, 'getFromTag value is null, but non null value was expected.');
        $cseq = $dto->getCseq();
        Assertion::notNull($cseq, 'getCseq value is null, but non null value was expected.');
        $contact = $dto->getContact();
        Assertion::notNull($contact, 'getContact value is null, but non null value was expected.');
        $remoteContact = $dto->getRemoteContact();
        Assertion::notNull($remoteContact, 'getRemoteContact value is null, but non null value was expected.');
        $version = $dto->getVersion();
        Assertion::notNull($version, 'getVersion value is null, but non null value was expected.');
        $extraHeaders = $dto->getExtraHeaders();
        Assertion::notNull($extraHeaders, 'getExtraHeaders value is null, but non null value was expected.');

        $this
            ->setPresUri($presUri)
            ->setPresId($presId)
            ->setEvent($event)
            ->setExpires($expires)
            ->setDesiredExpires($desiredExpires)
            ->setFlag($flag)
            ->setEtag($etag)
            ->setTupleId($dto->getTupleId())
            ->setWatcherUri($watcherUri)
            ->setCallId($callId)
            ->setToTag($toTag)
            ->setFromTag($fromTag)
            ->setCseq($cseq)
            ->setRecordRoute($dto->getRecordRoute())
            ->setContact($contact)
            ->setRemoteContact($remoteContact)
            ->setVersion($version)
            ->setExtraHeaders($extraHeaders);

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersPuaDto
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

    protected function __toArray(): array
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

    protected function setPresUri(string $presUri): static
    {
        Assertion::maxLength($presUri, 255, 'presUri value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->presUri = $presUri;

        return $this;
    }

    public function getPresUri(): string
    {
        return $this->presUri;
    }

    protected function setPresId(string $presId): static
    {
        Assertion::maxLength($presId, 255, 'presId value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->presId = $presId;

        return $this;
    }

    public function getPresId(): string
    {
        return $this->presId;
    }

    protected function setEvent(int $event): static
    {
        $this->event = $event;

        return $this;
    }

    public function getEvent(): int
    {
        return $this->event;
    }

    protected function setExpires(int $expires): static
    {
        $this->expires = $expires;

        return $this;
    }

    public function getExpires(): int
    {
        return $this->expires;
    }

    protected function setDesiredExpires(int $desiredExpires): static
    {
        $this->desiredExpires = $desiredExpires;

        return $this;
    }

    public function getDesiredExpires(): int
    {
        return $this->desiredExpires;
    }

    protected function setFlag(int $flag): static
    {
        $this->flag = $flag;

        return $this;
    }

    public function getFlag(): int
    {
        return $this->flag;
    }

    protected function setEtag(string $etag): static
    {
        Assertion::maxLength($etag, 128, 'etag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->etag = $etag;

        return $this;
    }

    public function getEtag(): string
    {
        return $this->etag;
    }

    protected function setTupleId(?string $tupleId = null): static
    {
        if (!is_null($tupleId)) {
            Assertion::maxLength($tupleId, 64, 'tupleId value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->tupleId = $tupleId;

        return $this;
    }

    public function getTupleId(): ?string
    {
        return $this->tupleId;
    }

    protected function setWatcherUri(string $watcherUri): static
    {
        Assertion::maxLength($watcherUri, 255, 'watcherUri value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->watcherUri = $watcherUri;

        return $this;
    }

    public function getWatcherUri(): string
    {
        return $this->watcherUri;
    }

    protected function setCallId(string $callId): static
    {
        Assertion::maxLength($callId, 255, 'callId value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->callId = $callId;

        return $this;
    }

    public function getCallId(): string
    {
        return $this->callId;
    }

    protected function setToTag(string $toTag): static
    {
        Assertion::maxLength($toTag, 128, 'toTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->toTag = $toTag;

        return $this;
    }

    public function getToTag(): string
    {
        return $this->toTag;
    }

    protected function setFromTag(string $fromTag): static
    {
        Assertion::maxLength($fromTag, 128, 'fromTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->fromTag = $fromTag;

        return $this;
    }

    public function getFromTag(): string
    {
        return $this->fromTag;
    }

    protected function setCseq(int $cseq): static
    {
        $this->cseq = $cseq;

        return $this;
    }

    public function getCseq(): int
    {
        return $this->cseq;
    }

    protected function setRecordRoute(?string $recordRoute = null): static
    {
        if (!is_null($recordRoute)) {
            Assertion::maxLength($recordRoute, 65535, 'recordRoute value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->recordRoute = $recordRoute;

        return $this;
    }

    public function getRecordRoute(): ?string
    {
        return $this->recordRoute;
    }

    protected function setContact(string $contact): static
    {
        Assertion::maxLength($contact, 255, 'contact value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->contact = $contact;

        return $this;
    }

    public function getContact(): string
    {
        return $this->contact;
    }

    protected function setRemoteContact(string $remoteContact): static
    {
        Assertion::maxLength($remoteContact, 255, 'remoteContact value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->remoteContact = $remoteContact;

        return $this;
    }

    public function getRemoteContact(): string
    {
        return $this->remoteContact;
    }

    protected function setVersion(int $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    protected function setExtraHeaders(string $extraHeaders): static
    {
        Assertion::maxLength($extraHeaders, 65535, 'extraHeaders value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->extraHeaders = $extraHeaders;

        return $this;
    }

    public function getExtraHeaders(): string
    {
        return $this->extraHeaders;
    }
}
