<?php

declare(strict_types=1);

namespace Ivoz\Kam\Domain\Model\UsersActiveWatcher;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* UsersActiveWatcherAbstract
* @codeCoverageIgnore
*/
abstract class UsersActiveWatcherAbstract
{
    use ChangelogTrait;

    /**
     * column: presentity_uri
     */
    protected $presentityUri;

    /**
     * column: watcher_username
     */
    protected $watcherUsername;

    /**
     * column: watcher_domain
     */
    protected $watcherDomain;

    /**
     * column: to_user
     */
    protected $toUser;

    /**
     * column: to_domain
     */
    protected $toDomain;

    protected $event = 'presence';

    /**
     * column: event_id
     */
    protected $eventId;

    /**
     * column: to_tag
     */
    protected $toTag;

    /**
     * column: from_tag
     */
    protected $fromTag;

    protected $callid;

    /**
     * column: local_cseq
     */
    protected $localCseq;

    /**
     * column: remote_cseq
     */
    protected $remoteCseq;

    protected $contact;

    /**
     * column: record_route
     */
    protected $recordRoute;

    protected $expires;

    protected $status = 2;

    protected $reason;

    protected $version = 0;

    /**
     * column: socket_info
     */
    protected $socketInfo;

    /**
     * column: local_contact
     */
    protected $localContact;

    /**
     * column: from_user
     */
    protected $fromUser;

    /**
     * column: from_domain
     */
    protected $fromDomain;

    protected $updated;

    /**
     * column: updated_winfo
     */
    protected $updatedWinfo;

    protected $flags = 0;

    /**
     * column: user_agent
     */
    protected $userAgent = '';

    /**
     * Constructor
     */
    protected function __construct(
        string $presentityUri,
        string $watcherUsername,
        string $watcherDomain,
        string $toUser,
        string $toDomain,
        string $event,
        string $toTag,
        string $fromTag,
        string $callid,
        int $localCseq,
        int $remoteCseq,
        string $contact,
        int $expires,
        int $status,
        int $version,
        string $socketInfo,
        string $localContact,
        string $fromUser,
        string $fromDomain,
        int $updated,
        int $updatedWinfo,
        int $flags,
        string $userAgent
    ) {
        $this->setPresentityUri($presentityUri);
        $this->setWatcherUsername($watcherUsername);
        $this->setWatcherDomain($watcherDomain);
        $this->setToUser($toUser);
        $this->setToDomain($toDomain);
        $this->setEvent($event);
        $this->setToTag($toTag);
        $this->setFromTag($fromTag);
        $this->setCallid($callid);
        $this->setLocalCseq($localCseq);
        $this->setRemoteCseq($remoteCseq);
        $this->setContact($contact);
        $this->setExpires($expires);
        $this->setStatus($status);
        $this->setVersion($version);
        $this->setSocketInfo($socketInfo);
        $this->setLocalContact($localContact);
        $this->setFromUser($fromUser);
        $this->setFromDomain($fromDomain);
        $this->setUpdated($updated);
        $this->setUpdatedWinfo($updatedWinfo);
        $this->setFlags($flags);
        $this->setUserAgent($userAgent);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "UsersActiveWatcher",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): UsersActiveWatcherDto
    {
        return new UsersActiveWatcherDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|UsersActiveWatcherInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UsersActiveWatcherDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, UsersActiveWatcherInterface::class);

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
     * @param UsersActiveWatcherDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, UsersActiveWatcherDto::class);

        $self = new static(
            $dto->getPresentityUri(),
            $dto->getWatcherUsername(),
            $dto->getWatcherDomain(),
            $dto->getToUser(),
            $dto->getToDomain(),
            $dto->getEvent(),
            $dto->getToTag(),
            $dto->getFromTag(),
            $dto->getCallid(),
            $dto->getLocalCseq(),
            $dto->getRemoteCseq(),
            $dto->getContact(),
            $dto->getExpires(),
            $dto->getStatus(),
            $dto->getVersion(),
            $dto->getSocketInfo(),
            $dto->getLocalContact(),
            $dto->getFromUser(),
            $dto->getFromDomain(),
            $dto->getUpdated(),
            $dto->getUpdatedWinfo(),
            $dto->getFlags(),
            $dto->getUserAgent()
        );

        $self
            ->setEventId($dto->getEventId())
            ->setRecordRoute($dto->getRecordRoute())
            ->setReason($dto->getReason());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param UsersActiveWatcherDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, UsersActiveWatcherDto::class);

        $this
            ->setPresentityUri($dto->getPresentityUri())
            ->setWatcherUsername($dto->getWatcherUsername())
            ->setWatcherDomain($dto->getWatcherDomain())
            ->setToUser($dto->getToUser())
            ->setToDomain($dto->getToDomain())
            ->setEvent($dto->getEvent())
            ->setEventId($dto->getEventId())
            ->setToTag($dto->getToTag())
            ->setFromTag($dto->getFromTag())
            ->setCallid($dto->getCallid())
            ->setLocalCseq($dto->getLocalCseq())
            ->setRemoteCseq($dto->getRemoteCseq())
            ->setContact($dto->getContact())
            ->setRecordRoute($dto->getRecordRoute())
            ->setExpires($dto->getExpires())
            ->setStatus($dto->getStatus())
            ->setReason($dto->getReason())
            ->setVersion($dto->getVersion())
            ->setSocketInfo($dto->getSocketInfo())
            ->setLocalContact($dto->getLocalContact())
            ->setFromUser($dto->getFromUser())
            ->setFromDomain($dto->getFromDomain())
            ->setUpdated($dto->getUpdated())
            ->setUpdatedWinfo($dto->getUpdatedWinfo())
            ->setFlags($dto->getFlags())
            ->setUserAgent($dto->getUserAgent());

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersActiveWatcherDto
    {
        return self::createDto()
            ->setPresentityUri(self::getPresentityUri())
            ->setWatcherUsername(self::getWatcherUsername())
            ->setWatcherDomain(self::getWatcherDomain())
            ->setToUser(self::getToUser())
            ->setToDomain(self::getToDomain())
            ->setEvent(self::getEvent())
            ->setEventId(self::getEventId())
            ->setToTag(self::getToTag())
            ->setFromTag(self::getFromTag())
            ->setCallid(self::getCallid())
            ->setLocalCseq(self::getLocalCseq())
            ->setRemoteCseq(self::getRemoteCseq())
            ->setContact(self::getContact())
            ->setRecordRoute(self::getRecordRoute())
            ->setExpires(self::getExpires())
            ->setStatus(self::getStatus())
            ->setReason(self::getReason())
            ->setVersion(self::getVersion())
            ->setSocketInfo(self::getSocketInfo())
            ->setLocalContact(self::getLocalContact())
            ->setFromUser(self::getFromUser())
            ->setFromDomain(self::getFromDomain())
            ->setUpdated(self::getUpdated())
            ->setUpdatedWinfo(self::getUpdatedWinfo())
            ->setFlags(self::getFlags())
            ->setUserAgent(self::getUserAgent());
    }

    protected function __toArray(): array
    {
        return [
            'presentity_uri' => self::getPresentityUri(),
            'watcher_username' => self::getWatcherUsername(),
            'watcher_domain' => self::getWatcherDomain(),
            'to_user' => self::getToUser(),
            'to_domain' => self::getToDomain(),
            'event' => self::getEvent(),
            'event_id' => self::getEventId(),
            'to_tag' => self::getToTag(),
            'from_tag' => self::getFromTag(),
            'callid' => self::getCallid(),
            'local_cseq' => self::getLocalCseq(),
            'remote_cseq' => self::getRemoteCseq(),
            'contact' => self::getContact(),
            'record_route' => self::getRecordRoute(),
            'expires' => self::getExpires(),
            'status' => self::getStatus(),
            'reason' => self::getReason(),
            'version' => self::getVersion(),
            'socket_info' => self::getSocketInfo(),
            'local_contact' => self::getLocalContact(),
            'from_user' => self::getFromUser(),
            'from_domain' => self::getFromDomain(),
            'updated' => self::getUpdated(),
            'updated_winfo' => self::getUpdatedWinfo(),
            'flags' => self::getFlags(),
            'user_agent' => self::getUserAgent()
        ];
    }

    protected function setPresentityUri(string $presentityUri): static
    {
        Assertion::maxLength($presentityUri, 255, 'presentityUri value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->presentityUri = $presentityUri;

        return $this;
    }

    public function getPresentityUri(): string
    {
        return $this->presentityUri;
    }

    protected function setWatcherUsername(string $watcherUsername): static
    {
        Assertion::maxLength($watcherUsername, 64, 'watcherUsername value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->watcherUsername = $watcherUsername;

        return $this;
    }

    public function getWatcherUsername(): string
    {
        return $this->watcherUsername;
    }

    protected function setWatcherDomain(string $watcherDomain): static
    {
        Assertion::maxLength($watcherDomain, 64, 'watcherDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->watcherDomain = $watcherDomain;

        return $this;
    }

    public function getWatcherDomain(): string
    {
        return $this->watcherDomain;
    }

    protected function setToUser(string $toUser): static
    {
        Assertion::maxLength($toUser, 64, 'toUser value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->toUser = $toUser;

        return $this;
    }

    public function getToUser(): string
    {
        return $this->toUser;
    }

    protected function setToDomain(string $toDomain): static
    {
        Assertion::maxLength($toDomain, 190, 'toDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->toDomain = $toDomain;

        return $this;
    }

    public function getToDomain(): string
    {
        return $this->toDomain;
    }

    protected function setEvent(string $event): static
    {
        Assertion::maxLength($event, 64, 'event value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->event = $event;

        return $this;
    }

    public function getEvent(): string
    {
        return $this->event;
    }

    protected function setEventId(?string $eventId = null): static
    {
        if (!is_null($eventId)) {
            Assertion::maxLength($eventId, 64, 'eventId value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->eventId = $eventId;

        return $this;
    }

    public function getEventId(): ?string
    {
        return $this->eventId;
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

    protected function setCallid(string $callid): static
    {
        Assertion::maxLength($callid, 255, 'callid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->callid = $callid;

        return $this;
    }

    public function getCallid(): string
    {
        return $this->callid;
    }

    protected function setLocalCseq(int $localCseq): static
    {
        $this->localCseq = $localCseq;

        return $this;
    }

    public function getLocalCseq(): int
    {
        return $this->localCseq;
    }

    protected function setRemoteCseq(int $remoteCseq): static
    {
        $this->remoteCseq = $remoteCseq;

        return $this;
    }

    public function getRemoteCseq(): int
    {
        return $this->remoteCseq;
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

    protected function setExpires(int $expires): static
    {
        $this->expires = $expires;

        return $this;
    }

    public function getExpires(): int
    {
        return $this->expires;
    }

    protected function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    protected function setReason(?string $reason = null): static
    {
        if (!is_null($reason)) {
            Assertion::maxLength($reason, 64, 'reason value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->reason = $reason;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
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

    protected function setSocketInfo(string $socketInfo): static
    {
        Assertion::maxLength($socketInfo, 64, 'socketInfo value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->socketInfo = $socketInfo;

        return $this;
    }

    public function getSocketInfo(): string
    {
        return $this->socketInfo;
    }

    protected function setLocalContact(string $localContact): static
    {
        Assertion::maxLength($localContact, 255, 'localContact value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->localContact = $localContact;

        return $this;
    }

    public function getLocalContact(): string
    {
        return $this->localContact;
    }

    protected function setFromUser(string $fromUser): static
    {
        Assertion::maxLength($fromUser, 64, 'fromUser value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->fromUser = $fromUser;

        return $this;
    }

    public function getFromUser(): string
    {
        return $this->fromUser;
    }

    protected function setFromDomain(string $fromDomain): static
    {
        Assertion::maxLength($fromDomain, 190, 'fromDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->fromDomain = $fromDomain;

        return $this;
    }

    public function getFromDomain(): string
    {
        return $this->fromDomain;
    }

    protected function setUpdated(int $updated): static
    {
        $this->updated = $updated;

        return $this;
    }

    public function getUpdated(): int
    {
        return $this->updated;
    }

    protected function setUpdatedWinfo(int $updatedWinfo): static
    {
        $this->updatedWinfo = $updatedWinfo;

        return $this;
    }

    public function getUpdatedWinfo(): int
    {
        return $this->updatedWinfo;
    }

    protected function setFlags(int $flags): static
    {
        $this->flags = $flags;

        return $this;
    }

    public function getFlags(): int
    {
        return $this->flags;
    }

    protected function setUserAgent(string $userAgent): static
    {
        Assertion::maxLength($userAgent, 255, 'userAgent value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->userAgent = $userAgent;

        return $this;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }
}
