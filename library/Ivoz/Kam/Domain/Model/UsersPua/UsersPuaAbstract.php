<?php

namespace Ivoz\Kam\Domain\Model\UsersPua;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * UsersPuaAbstract
 * @codeCoverageIgnore
 */
abstract class UsersPuaAbstract
{
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
     * @var integer
     */
    protected $event;

    /**
     * @var integer
     */
    protected $expires;

    /**
     * column: desired_expires
     * @var integer
     */
    protected $desiredExpires;

    /**
     * @var integer
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
     * @var integer
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
     * @var integer
     */
    protected $version;

    /**
     * column: extra_headers
     * @var string
     */
    protected $extraHeaders;


    use ChangelogTrait;

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
     * @param EntityInterface|null $entity
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UsersPuaDto
         */
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
            ->setRecordRoute($dto->getRecordRoute())
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
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UsersPuaDto
         */
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



        $this->sanitizeValues();
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
    // @codeCoverageIgnoreStart

    /**
     * Set presUri
     *
     * @param string $presUri
     *
     * @return self
     */
    protected function setPresUri($presUri)
    {
        Assertion::notNull($presUri, 'presUri value "%s" is null, but non null value was expected.');
        Assertion::maxLength($presUri, 128, 'presUri value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->presUri = $presUri;

        return $this;
    }

    /**
     * Get presUri
     *
     * @return string
     */
    public function getPresUri()
    {
        return $this->presUri;
    }

    /**
     * Set presId
     *
     * @param string $presId
     *
     * @return self
     */
    protected function setPresId($presId)
    {
        Assertion::notNull($presId, 'presId value "%s" is null, but non null value was expected.');
        Assertion::maxLength($presId, 255, 'presId value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->presId = $presId;

        return $this;
    }

    /**
     * Get presId
     *
     * @return string
     */
    public function getPresId()
    {
        return $this->presId;
    }

    /**
     * Set event
     *
     * @param integer $event
     *
     * @return self
     */
    protected function setEvent($event)
    {
        Assertion::notNull($event, 'event value "%s" is null, but non null value was expected.');
        Assertion::integerish($event, 'event value "%s" is not an integer or a number castable to integer.');

        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return integer
     */
    public function getEvent()
    {
        return $this->event;
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
     * Set desiredExpires
     *
     * @param integer $desiredExpires
     *
     * @return self
     */
    protected function setDesiredExpires($desiredExpires)
    {
        Assertion::notNull($desiredExpires, 'desiredExpires value "%s" is null, but non null value was expected.');
        Assertion::integerish($desiredExpires, 'desiredExpires value "%s" is not an integer or a number castable to integer.');

        $this->desiredExpires = $desiredExpires;

        return $this;
    }

    /**
     * Get desiredExpires
     *
     * @return integer
     */
    public function getDesiredExpires()
    {
        return $this->desiredExpires;
    }

    /**
     * Set flag
     *
     * @param integer $flag
     *
     * @return self
     */
    protected function setFlag($flag)
    {
        Assertion::notNull($flag, 'flag value "%s" is null, but non null value was expected.');
        Assertion::integerish($flag, 'flag value "%s" is not an integer or a number castable to integer.');

        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return integer
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Set etag
     *
     * @param string $etag
     *
     * @return self
     */
    protected function setEtag($etag)
    {
        Assertion::notNull($etag, 'etag value "%s" is null, but non null value was expected.');
        Assertion::maxLength($etag, 64, 'etag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->etag = $etag;

        return $this;
    }

    /**
     * Get etag
     *
     * @return string
     */
    public function getEtag()
    {
        return $this->etag;
    }

    /**
     * Set tupleId
     *
     * @param string $tupleId
     *
     * @return self
     */
    protected function setTupleId($tupleId = null)
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
    public function getTupleId()
    {
        return $this->tupleId;
    }

    /**
     * Set watcherUri
     *
     * @param string $watcherUri
     *
     * @return self
     */
    protected function setWatcherUri($watcherUri)
    {
        Assertion::notNull($watcherUri, 'watcherUri value "%s" is null, but non null value was expected.');
        Assertion::maxLength($watcherUri, 128, 'watcherUri value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->watcherUri = $watcherUri;

        return $this;
    }

    /**
     * Get watcherUri
     *
     * @return string
     */
    public function getWatcherUri()
    {
        return $this->watcherUri;
    }

    /**
     * Set callId
     *
     * @param string $callId
     *
     * @return self
     */
    protected function setCallId($callId)
    {
        Assertion::notNull($callId, 'callId value "%s" is null, but non null value was expected.');
        Assertion::maxLength($callId, 255, 'callId value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->callId = $callId;

        return $this;
    }

    /**
     * Get callId
     *
     * @return string
     */
    public function getCallId()
    {
        return $this->callId;
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
     * Set cseq
     *
     * @param integer $cseq
     *
     * @return self
     */
    protected function setCseq($cseq)
    {
        Assertion::notNull($cseq, 'cseq value "%s" is null, but non null value was expected.');
        Assertion::integerish($cseq, 'cseq value "%s" is not an integer or a number castable to integer.');

        $this->cseq = $cseq;

        return $this;
    }

    /**
     * Get cseq
     *
     * @return integer
     */
    public function getCseq()
    {
        return $this->cseq;
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
     * Set remoteContact
     *
     * @param string $remoteContact
     *
     * @return self
     */
    protected function setRemoteContact($remoteContact)
    {
        Assertion::notNull($remoteContact, 'remoteContact value "%s" is null, but non null value was expected.');
        Assertion::maxLength($remoteContact, 128, 'remoteContact value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->remoteContact = $remoteContact;

        return $this;
    }

    /**
     * Get remoteContact
     *
     * @return string
     */
    public function getRemoteContact()
    {
        return $this->remoteContact;
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
     * Set extraHeaders
     *
     * @param string $extraHeaders
     *
     * @return self
     */
    protected function setExtraHeaders($extraHeaders)
    {
        Assertion::notNull($extraHeaders, 'extraHeaders value "%s" is null, but non null value was expected.');
        Assertion::maxLength($extraHeaders, 65535, 'extraHeaders value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->extraHeaders = $extraHeaders;

        return $this;
    }

    /**
     * Get extraHeaders
     *
     * @return string
     */
    public function getExtraHeaders()
    {
        return $this->extraHeaders;
    }

    // @codeCoverageIgnoreEnd
}
