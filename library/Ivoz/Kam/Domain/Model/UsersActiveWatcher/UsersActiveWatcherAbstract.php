<?php
declare(strict_types = 1);

namespace Ivoz\Kam\Domain\Model\UsersActiveWatcher;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* UsersActiveWatcherAbstract
* @codeCoverageIgnore
*/
abstract class UsersActiveWatcherAbstract
{
    use ChangelogTrait;

    /**
     * column: presentity_uri
     * @var string
     */
    protected $presentityUri;

    /**
     * column: watcher_username
     * @var string
     */
    protected $watcherUsername;

    /**
     * column: watcher_domain
     * @var string
     */
    protected $watcherDomain;

    /**
     * column: to_user
     * @var string
     */
    protected $toUser;

    /**
     * column: to_domain
     * @var string
     */
    protected $toDomain;

    /**
     * @var string
     */
    protected $event = 'presence';

    /**
     * column: event_id
     * @var string | null
     */
    protected $eventId;

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
     * @var string
     */
    protected $callid;

    /**
     * column: local_cseq
     * @var int
     */
    protected $localCseq;

    /**
     * column: remote_cseq
     * @var int
     */
    protected $remoteCseq;

    /**
     * @var string
     */
    protected $contact;

    /**
     * column: record_route
     * @var string | null
     */
    protected $recordRoute;

    /**
     * @var int
     */
    protected $expires;

    /**
     * @var int
     */
    protected $status = 2;

    /**
     * @var string | null
     */
    protected $reason;

    /**
     * @var int
     */
    protected $version = 0;

    /**
     * column: socket_info
     * @var string
     */
    protected $socketInfo;

    /**
     * column: local_contact
     * @var string
     */
    protected $localContact;

    /**
     * column: from_user
     * @var string
     */
    protected $fromUser;

    /**
     * column: from_domain
     * @var string
     */
    protected $fromDomain;

    /**
     * @var int
     */
    protected $updated;

    /**
     * column: updated_winfo
     * @var int
     */
    protected $updatedWinfo;

    /**
     * @var int
     */
    protected $flags = 0;

    /**
     * column: user_agent
     * @var string
     */
    protected $userAgent = '';

    /**
     * Constructor
     */
    protected function __construct(
        $presentityUri,
        $watcherUsername,
        $watcherDomain,
        $toUser,
        $toDomain,
        $event,
        $toTag,
        $fromTag,
        $callid,
        $localCseq,
        $remoteCseq,
        $contact,
        $expires,
        $status,
        $version,
        $socketInfo,
        $localContact,
        $fromUser,
        $fromDomain,
        $updated,
        $updatedWinfo,
        $flags,
        $userAgent
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

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "UsersActiveWatcher",
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
     * @return UsersActiveWatcherDto
     */
    public static function createDto($id = null)
    {
        return new UsersActiveWatcherDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param UsersActiveWatcherInterface|null $entity
     * @param int $depth
     * @return UsersActiveWatcherDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var UsersActiveWatcherDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersActiveWatcherDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @param int $depth
     * @return UsersActiveWatcherDto
     */
    public function toDto($depth = 0)
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

    /**
     * @return array
     */
    protected function __toArray()
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

    /**
     * Set presentityUri
     *
     * @param string $presentityUri
     *
     * @return static
     */
    protected function setPresentityUri(string $presentityUri): UsersActiveWatcherInterface
    {
        Assertion::maxLength($presentityUri, 128, 'presentityUri value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->presentityUri = $presentityUri;

        return $this;
    }

    /**
     * Get presentityUri
     *
     * @return string
     */
    public function getPresentityUri(): string
    {
        return $this->presentityUri;
    }

    /**
     * Set watcherUsername
     *
     * @param string $watcherUsername
     *
     * @return static
     */
    protected function setWatcherUsername(string $watcherUsername): UsersActiveWatcherInterface
    {
        Assertion::maxLength($watcherUsername, 64, 'watcherUsername value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->watcherUsername = $watcherUsername;

        return $this;
    }

    /**
     * Get watcherUsername
     *
     * @return string
     */
    public function getWatcherUsername(): string
    {
        return $this->watcherUsername;
    }

    /**
     * Set watcherDomain
     *
     * @param string $watcherDomain
     *
     * @return static
     */
    protected function setWatcherDomain(string $watcherDomain): UsersActiveWatcherInterface
    {
        Assertion::maxLength($watcherDomain, 64, 'watcherDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->watcherDomain = $watcherDomain;

        return $this;
    }

    /**
     * Get watcherDomain
     *
     * @return string
     */
    public function getWatcherDomain(): string
    {
        return $this->watcherDomain;
    }

    /**
     * Set toUser
     *
     * @param string $toUser
     *
     * @return static
     */
    protected function setToUser(string $toUser): UsersActiveWatcherInterface
    {
        Assertion::maxLength($toUser, 64, 'toUser value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->toUser = $toUser;

        return $this;
    }

    /**
     * Get toUser
     *
     * @return string
     */
    public function getToUser(): string
    {
        return $this->toUser;
    }

    /**
     * Set toDomain
     *
     * @param string $toDomain
     *
     * @return static
     */
    protected function setToDomain(string $toDomain): UsersActiveWatcherInterface
    {
        Assertion::maxLength($toDomain, 190, 'toDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->toDomain = $toDomain;

        return $this;
    }

    /**
     * Get toDomain
     *
     * @return string
     */
    public function getToDomain(): string
    {
        return $this->toDomain;
    }

    /**
     * Set event
     *
     * @param string $event
     *
     * @return static
     */
    protected function setEvent(string $event): UsersActiveWatcherInterface
    {
        Assertion::maxLength($event, 64, 'event value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return string
     */
    public function getEvent(): string
    {
        return $this->event;
    }

    /**
     * Set eventId
     *
     * @param string $eventId | null
     *
     * @return static
     */
    protected function setEventId(?string $eventId = null): UsersActiveWatcherInterface
    {
        if (!is_null($eventId)) {
            Assertion::maxLength($eventId, 64, 'eventId value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return string | null
     */
    public function getEventId(): ?string
    {
        return $this->eventId;
    }

    /**
     * Set toTag
     *
     * @param string $toTag
     *
     * @return static
     */
    protected function setToTag(string $toTag): UsersActiveWatcherInterface
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
    protected function setFromTag(string $fromTag): UsersActiveWatcherInterface
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
     * Set callid
     *
     * @param string $callid
     *
     * @return static
     */
    protected function setCallid(string $callid): UsersActiveWatcherInterface
    {
        Assertion::maxLength($callid, 255, 'callid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->callid = $callid;

        return $this;
    }

    /**
     * Get callid
     *
     * @return string
     */
    public function getCallid(): string
    {
        return $this->callid;
    }

    /**
     * Set localCseq
     *
     * @param int $localCseq
     *
     * @return static
     */
    protected function setLocalCseq(int $localCseq): UsersActiveWatcherInterface
    {
        $this->localCseq = $localCseq;

        return $this;
    }

    /**
     * Get localCseq
     *
     * @return int
     */
    public function getLocalCseq(): int
    {
        return $this->localCseq;
    }

    /**
     * Set remoteCseq
     *
     * @param int $remoteCseq
     *
     * @return static
     */
    protected function setRemoteCseq(int $remoteCseq): UsersActiveWatcherInterface
    {
        $this->remoteCseq = $remoteCseq;

        return $this;
    }

    /**
     * Get remoteCseq
     *
     * @return int
     */
    public function getRemoteCseq(): int
    {
        return $this->remoteCseq;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return static
     */
    protected function setContact(string $contact): UsersActiveWatcherInterface
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
     * Set recordRoute
     *
     * @param string $recordRoute | null
     *
     * @return static
     */
    protected function setRecordRoute(?string $recordRoute = null): UsersActiveWatcherInterface
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
     * Set expires
     *
     * @param int $expires
     *
     * @return static
     */
    protected function setExpires(int $expires): UsersActiveWatcherInterface
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
     * Set status
     *
     * @param int $status
     *
     * @return static
     */
    protected function setStatus(int $status): UsersActiveWatcherInterface
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Set reason
     *
     * @param string $reason | null
     *
     * @return static
     */
    protected function setReason(?string $reason = null): UsersActiveWatcherInterface
    {
        if (!is_null($reason)) {
            Assertion::maxLength($reason, 64, 'reason value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string | null
     */
    public function getReason(): ?string
    {
        return $this->reason;
    }

    /**
     * Set version
     *
     * @param int $version
     *
     * @return static
     */
    protected function setVersion(int $version): UsersActiveWatcherInterface
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
     * Set socketInfo
     *
     * @param string $socketInfo
     *
     * @return static
     */
    protected function setSocketInfo(string $socketInfo): UsersActiveWatcherInterface
    {
        Assertion::maxLength($socketInfo, 64, 'socketInfo value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->socketInfo = $socketInfo;

        return $this;
    }

    /**
     * Get socketInfo
     *
     * @return string
     */
    public function getSocketInfo(): string
    {
        return $this->socketInfo;
    }

    /**
     * Set localContact
     *
     * @param string $localContact
     *
     * @return static
     */
    protected function setLocalContact(string $localContact): UsersActiveWatcherInterface
    {
        Assertion::maxLength($localContact, 128, 'localContact value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->localContact = $localContact;

        return $this;
    }

    /**
     * Get localContact
     *
     * @return string
     */
    public function getLocalContact(): string
    {
        return $this->localContact;
    }

    /**
     * Set fromUser
     *
     * @param string $fromUser
     *
     * @return static
     */
    protected function setFromUser(string $fromUser): UsersActiveWatcherInterface
    {
        Assertion::maxLength($fromUser, 64, 'fromUser value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->fromUser = $fromUser;

        return $this;
    }

    /**
     * Get fromUser
     *
     * @return string
     */
    public function getFromUser(): string
    {
        return $this->fromUser;
    }

    /**
     * Set fromDomain
     *
     * @param string $fromDomain
     *
     * @return static
     */
    protected function setFromDomain(string $fromDomain): UsersActiveWatcherInterface
    {
        Assertion::maxLength($fromDomain, 190, 'fromDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->fromDomain = $fromDomain;

        return $this;
    }

    /**
     * Get fromDomain
     *
     * @return string
     */
    public function getFromDomain(): string
    {
        return $this->fromDomain;
    }

    /**
     * Set updated
     *
     * @param int $updated
     *
     * @return static
     */
    protected function setUpdated(int $updated): UsersActiveWatcherInterface
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return int
     */
    public function getUpdated(): int
    {
        return $this->updated;
    }

    /**
     * Set updatedWinfo
     *
     * @param int $updatedWinfo
     *
     * @return static
     */
    protected function setUpdatedWinfo(int $updatedWinfo): UsersActiveWatcherInterface
    {
        $this->updatedWinfo = $updatedWinfo;

        return $this;
    }

    /**
     * Get updatedWinfo
     *
     * @return int
     */
    public function getUpdatedWinfo(): int
    {
        return $this->updatedWinfo;
    }

    /**
     * Set flags
     *
     * @param int $flags
     *
     * @return static
     */
    protected function setFlags(int $flags): UsersActiveWatcherInterface
    {
        $this->flags = $flags;

        return $this;
    }

    /**
     * Get flags
     *
     * @return int
     */
    public function getFlags(): int
    {
        return $this->flags;
    }

    /**
     * Set userAgent
     *
     * @param string $userAgent
     *
     * @return static
     */
    protected function setUserAgent(string $userAgent): UsersActiveWatcherInterface
    {
        Assertion::maxLength($userAgent, 255, 'userAgent value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

}
