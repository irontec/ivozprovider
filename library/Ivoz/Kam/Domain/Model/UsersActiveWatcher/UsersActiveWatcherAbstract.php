<?php

namespace Ivoz\Kam\Domain\Model\UsersActiveWatcher;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * UsersActiveWatcherAbstract
 * @codeCoverageIgnore
 */
abstract class UsersActiveWatcherAbstract
{
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
     * @var integer
     */
    protected $localCseq;

    /**
     * column: remote_cseq
     * @var integer
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
     * @var integer
     */
    protected $expires;

    /**
     * @var integer
     */
    protected $status = '2';

    /**
     * @var string | null
     */
    protected $reason;

    /**
     * @var integer
     */
    protected $version = '0';

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
     * @var integer
     */
    protected $updated;

    /**
     * column: updated_winfo
     * @var integer
     */
    protected $updatedWinfo;

    /**
     * @var integer
     */
    protected $flags = '0';

    /**
     * column: user_agent
     * @var string
     */
    protected $userAgent = '';


    use ChangelogTrait;

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
     * @param EntityInterface|null $entity
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto UsersActiveWatcherDto
         */
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
            ->setReason($dto->getReason())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto UsersActiveWatcherDto
         */
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



        $this->sanitizeValues();
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
    // @codeCoverageIgnoreStart

    /**
     * Set presentityUri
     *
     * @param string $presentityUri
     *
     * @return self
     */
    protected function setPresentityUri($presentityUri)
    {
        Assertion::notNull($presentityUri, 'presentityUri value "%s" is null, but non null value was expected.');
        Assertion::maxLength($presentityUri, 128, 'presentityUri value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->presentityUri = $presentityUri;

        return $this;
    }

    /**
     * Get presentityUri
     *
     * @return string
     */
    public function getPresentityUri()
    {
        return $this->presentityUri;
    }

    /**
     * Set watcherUsername
     *
     * @param string $watcherUsername
     *
     * @return self
     */
    protected function setWatcherUsername($watcherUsername)
    {
        Assertion::notNull($watcherUsername, 'watcherUsername value "%s" is null, but non null value was expected.');
        Assertion::maxLength($watcherUsername, 64, 'watcherUsername value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->watcherUsername = $watcherUsername;

        return $this;
    }

    /**
     * Get watcherUsername
     *
     * @return string
     */
    public function getWatcherUsername()
    {
        return $this->watcherUsername;
    }

    /**
     * Set watcherDomain
     *
     * @param string $watcherDomain
     *
     * @return self
     */
    protected function setWatcherDomain($watcherDomain)
    {
        Assertion::notNull($watcherDomain, 'watcherDomain value "%s" is null, but non null value was expected.');
        Assertion::maxLength($watcherDomain, 64, 'watcherDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->watcherDomain = $watcherDomain;

        return $this;
    }

    /**
     * Get watcherDomain
     *
     * @return string
     */
    public function getWatcherDomain()
    {
        return $this->watcherDomain;
    }

    /**
     * Set toUser
     *
     * @param string $toUser
     *
     * @return self
     */
    protected function setToUser($toUser)
    {
        Assertion::notNull($toUser, 'toUser value "%s" is null, but non null value was expected.');
        Assertion::maxLength($toUser, 64, 'toUser value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->toUser = $toUser;

        return $this;
    }

    /**
     * Get toUser
     *
     * @return string
     */
    public function getToUser()
    {
        return $this->toUser;
    }

    /**
     * Set toDomain
     *
     * @param string $toDomain
     *
     * @return self
     */
    protected function setToDomain($toDomain)
    {
        Assertion::notNull($toDomain, 'toDomain value "%s" is null, but non null value was expected.');
        Assertion::maxLength($toDomain, 190, 'toDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->toDomain = $toDomain;

        return $this;
    }

    /**
     * Get toDomain
     *
     * @return string
     */
    public function getToDomain()
    {
        return $this->toDomain;
    }

    /**
     * Set event
     *
     * @param string $event
     *
     * @return self
     */
    protected function setEvent($event)
    {
        Assertion::notNull($event, 'event value "%s" is null, but non null value was expected.');
        Assertion::maxLength($event, 64, 'event value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set eventId
     *
     * @param string $eventId
     *
     * @return self
     */
    protected function setEventId($eventId = null)
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
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Set toTag
     *
     * @param string $toTag
     *
     * @return self
     */
    protected function setToTag($toTag)
    {
        Assertion::notNull($toTag, 'toTag value "%s" is null, but non null value was expected.');
        Assertion::maxLength($toTag, 64, 'toTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->toTag = $toTag;

        return $this;
    }

    /**
     * Get toTag
     *
     * @return string
     */
    public function getToTag()
    {
        return $this->toTag;
    }

    /**
     * Set fromTag
     *
     * @param string $fromTag
     *
     * @return self
     */
    protected function setFromTag($fromTag)
    {
        Assertion::notNull($fromTag, 'fromTag value "%s" is null, but non null value was expected.');
        Assertion::maxLength($fromTag, 64, 'fromTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->fromTag = $fromTag;

        return $this;
    }

    /**
     * Get fromTag
     *
     * @return string
     */
    public function getFromTag()
    {
        return $this->fromTag;
    }

    /**
     * Set callid
     *
     * @param string $callid
     *
     * @return self
     */
    protected function setCallid($callid)
    {
        Assertion::notNull($callid, 'callid value "%s" is null, but non null value was expected.');
        Assertion::maxLength($callid, 255, 'callid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->callid = $callid;

        return $this;
    }

    /**
     * Get callid
     *
     * @return string
     */
    public function getCallid()
    {
        return $this->callid;
    }

    /**
     * Set localCseq
     *
     * @param integer $localCseq
     *
     * @return self
     */
    protected function setLocalCseq($localCseq)
    {
        Assertion::notNull($localCseq, 'localCseq value "%s" is null, but non null value was expected.');
        Assertion::integerish($localCseq, 'localCseq value "%s" is not an integer or a number castable to integer.');

        $this->localCseq = $localCseq;

        return $this;
    }

    /**
     * Get localCseq
     *
     * @return integer
     */
    public function getLocalCseq()
    {
        return $this->localCseq;
    }

    /**
     * Set remoteCseq
     *
     * @param integer $remoteCseq
     *
     * @return self
     */
    protected function setRemoteCseq($remoteCseq)
    {
        Assertion::notNull($remoteCseq, 'remoteCseq value "%s" is null, but non null value was expected.');
        Assertion::integerish($remoteCseq, 'remoteCseq value "%s" is not an integer or a number castable to integer.');

        $this->remoteCseq = $remoteCseq;

        return $this;
    }

    /**
     * Get remoteCseq
     *
     * @return integer
     */
    public function getRemoteCseq()
    {
        return $this->remoteCseq;
    }

    /**
     * Set contact
     *
     * @param string $contact
     *
     * @return self
     */
    protected function setContact($contact)
    {
        Assertion::notNull($contact, 'contact value "%s" is null, but non null value was expected.');
        Assertion::maxLength($contact, 128, 'contact value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set recordRoute
     *
     * @param string $recordRoute
     *
     * @return self
     */
    protected function setRecordRoute($recordRoute = null)
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
    public function getRecordRoute()
    {
        return $this->recordRoute;
    }

    /**
     * Set expires
     *
     * @param integer $expires
     *
     * @return self
     */
    protected function setExpires($expires)
    {
        Assertion::notNull($expires, 'expires value "%s" is null, but non null value was expected.');
        Assertion::integerish($expires, 'expires value "%s" is not an integer or a number castable to integer.');

        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return integer
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return self
     */
    protected function setStatus($status)
    {
        Assertion::notNull($status, 'status value "%s" is null, but non null value was expected.');
        Assertion::integerish($status, 'status value "%s" is not an integer or a number castable to integer.');

        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set reason
     *
     * @param string $reason
     *
     * @return self
     */
    protected function setReason($reason = null)
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
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return self
     */
    protected function setVersion($version)
    {
        Assertion::notNull($version, 'version value "%s" is null, but non null value was expected.');
        Assertion::integerish($version, 'version value "%s" is not an integer or a number castable to integer.');

        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set socketInfo
     *
     * @param string $socketInfo
     *
     * @return self
     */
    protected function setSocketInfo($socketInfo)
    {
        Assertion::notNull($socketInfo, 'socketInfo value "%s" is null, but non null value was expected.');
        Assertion::maxLength($socketInfo, 64, 'socketInfo value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->socketInfo = $socketInfo;

        return $this;
    }

    /**
     * Get socketInfo
     *
     * @return string
     */
    public function getSocketInfo()
    {
        return $this->socketInfo;
    }

    /**
     * Set localContact
     *
     * @param string $localContact
     *
     * @return self
     */
    protected function setLocalContact($localContact)
    {
        Assertion::notNull($localContact, 'localContact value "%s" is null, but non null value was expected.');
        Assertion::maxLength($localContact, 128, 'localContact value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->localContact = $localContact;

        return $this;
    }

    /**
     * Get localContact
     *
     * @return string
     */
    public function getLocalContact()
    {
        return $this->localContact;
    }

    /**
     * Set fromUser
     *
     * @param string $fromUser
     *
     * @return self
     */
    protected function setFromUser($fromUser)
    {
        Assertion::notNull($fromUser, 'fromUser value "%s" is null, but non null value was expected.');
        Assertion::maxLength($fromUser, 64, 'fromUser value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->fromUser = $fromUser;

        return $this;
    }

    /**
     * Get fromUser
     *
     * @return string
     */
    public function getFromUser()
    {
        return $this->fromUser;
    }

    /**
     * Set fromDomain
     *
     * @param string $fromDomain
     *
     * @return self
     */
    protected function setFromDomain($fromDomain)
    {
        Assertion::notNull($fromDomain, 'fromDomain value "%s" is null, but non null value was expected.');
        Assertion::maxLength($fromDomain, 190, 'fromDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->fromDomain = $fromDomain;

        return $this;
    }

    /**
     * Get fromDomain
     *
     * @return string
     */
    public function getFromDomain()
    {
        return $this->fromDomain;
    }

    /**
     * Set updated
     *
     * @param integer $updated
     *
     * @return self
     */
    protected function setUpdated($updated)
    {
        Assertion::notNull($updated, 'updated value "%s" is null, but non null value was expected.');
        Assertion::integerish($updated, 'updated value "%s" is not an integer or a number castable to integer.');

        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return integer
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set updatedWinfo
     *
     * @param integer $updatedWinfo
     *
     * @return self
     */
    protected function setUpdatedWinfo($updatedWinfo)
    {
        Assertion::notNull($updatedWinfo, 'updatedWinfo value "%s" is null, but non null value was expected.');
        Assertion::integerish($updatedWinfo, 'updatedWinfo value "%s" is not an integer or a number castable to integer.');

        $this->updatedWinfo = $updatedWinfo;

        return $this;
    }

    /**
     * Get updatedWinfo
     *
     * @return integer
     */
    public function getUpdatedWinfo()
    {
        return $this->updatedWinfo;
    }

    /**
     * Set flags
     *
     * @param integer $flags
     *
     * @return self
     */
    protected function setFlags($flags)
    {
        Assertion::notNull($flags, 'flags value "%s" is null, but non null value was expected.');
        Assertion::integerish($flags, 'flags value "%s" is not an integer or a number castable to integer.');

        $this->flags = $flags;

        return $this;
    }

    /**
     * Get flags
     *
     * @return integer
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * Set userAgent
     *
     * @param string $userAgent
     *
     * @return self
     */
    protected function setUserAgent($userAgent)
    {
        Assertion::notNull($userAgent, 'userAgent value "%s" is null, but non null value was expected.');
        Assertion::maxLength($userAgent, 255, 'userAgent value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    // @codeCoverageIgnoreEnd
}
