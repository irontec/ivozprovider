<?php

namespace Ivoz\Kam\Domain\Model\UsersActiveWatcher;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class UsersActiveWatcherDtoAbstract implements DataTransferObjectInterface
{
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
     * @var string
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
     * @var integer
     */
    private $localCseq;

    /**
     * @var integer
     */
    private $remoteCseq;

    /**
     * @var string
     */
    private $contact;

    /**
     * @var string
     */
    private $recordRoute;

    /**
     * @var integer
     */
    private $expires;

    /**
     * @var integer
     */
    private $status = 2;

    /**
     * @var string
     */
    private $reason;

    /**
     * @var integer
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
     * @var integer
     */
    private $updated;

    /**
     * @var integer
     */
    private $updatedWinfo;

    /**
     * @var integer
     */
    private $flags = 0;

    /**
     * @var string
     */
    private $userAgent = '';

    /**
     * @var integer
     */
    private $id;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
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
        return [
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
    }

    /**
     * @param string $presentityUri
     *
     * @return static
     */
    public function setPresentityUri($presentityUri = null)
    {
        $this->presentityUri = $presentityUri;

        return $this;
    }

    /**
     * @return string
     */
    public function getPresentityUri()
    {
        return $this->presentityUri;
    }

    /**
     * @param string $watcherUsername
     *
     * @return static
     */
    public function setWatcherUsername($watcherUsername = null)
    {
        $this->watcherUsername = $watcherUsername;

        return $this;
    }

    /**
     * @return string
     */
    public function getWatcherUsername()
    {
        return $this->watcherUsername;
    }

    /**
     * @param string $watcherDomain
     *
     * @return static
     */
    public function setWatcherDomain($watcherDomain = null)
    {
        $this->watcherDomain = $watcherDomain;

        return $this;
    }

    /**
     * @return string
     */
    public function getWatcherDomain()
    {
        return $this->watcherDomain;
    }

    /**
     * @param string $toUser
     *
     * @return static
     */
    public function setToUser($toUser = null)
    {
        $this->toUser = $toUser;

        return $this;
    }

    /**
     * @return string
     */
    public function getToUser()
    {
        return $this->toUser;
    }

    /**
     * @param string $toDomain
     *
     * @return static
     */
    public function setToDomain($toDomain = null)
    {
        $this->toDomain = $toDomain;

        return $this;
    }

    /**
     * @return string
     */
    public function getToDomain()
    {
        return $this->toDomain;
    }

    /**
     * @param string $event
     *
     * @return static
     */
    public function setEvent($event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param string $eventId
     *
     * @return static
     */
    public function setEventId($eventId = null)
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * @return string
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * @param string $toTag
     *
     * @return static
     */
    public function setToTag($toTag = null)
    {
        $this->toTag = $toTag;

        return $this;
    }

    /**
     * @return string
     */
    public function getToTag()
    {
        return $this->toTag;
    }

    /**
     * @param string $fromTag
     *
     * @return static
     */
    public function setFromTag($fromTag = null)
    {
        $this->fromTag = $fromTag;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromTag()
    {
        return $this->fromTag;
    }

    /**
     * @param string $callid
     *
     * @return static
     */
    public function setCallid($callid = null)
    {
        $this->callid = $callid;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallid()
    {
        return $this->callid;
    }

    /**
     * @param integer $localCseq
     *
     * @return static
     */
    public function setLocalCseq($localCseq = null)
    {
        $this->localCseq = $localCseq;

        return $this;
    }

    /**
     * @return integer
     */
    public function getLocalCseq()
    {
        return $this->localCseq;
    }

    /**
     * @param integer $remoteCseq
     *
     * @return static
     */
    public function setRemoteCseq($remoteCseq = null)
    {
        $this->remoteCseq = $remoteCseq;

        return $this;
    }

    /**
     * @return integer
     */
    public function getRemoteCseq()
    {
        return $this->remoteCseq;
    }

    /**
     * @param string $contact
     *
     * @return static
     */
    public function setContact($contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param string $recordRoute
     *
     * @return static
     */
    public function setRecordRoute($recordRoute = null)
    {
        $this->recordRoute = $recordRoute;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecordRoute()
    {
        return $this->recordRoute;
    }

    /**
     * @param integer $expires
     *
     * @return static
     */
    public function setExpires($expires = null)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * @return integer
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * @param integer $status
     *
     * @return static
     */
    public function setStatus($status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $reason
     *
     * @return static
     */
    public function setReason($reason = null)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @param integer $version
     *
     * @return static
     */
    public function setVersion($version = null)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $socketInfo
     *
     * @return static
     */
    public function setSocketInfo($socketInfo = null)
    {
        $this->socketInfo = $socketInfo;

        return $this;
    }

    /**
     * @return string
     */
    public function getSocketInfo()
    {
        return $this->socketInfo;
    }

    /**
     * @param string $localContact
     *
     * @return static
     */
    public function setLocalContact($localContact = null)
    {
        $this->localContact = $localContact;

        return $this;
    }

    /**
     * @return string
     */
    public function getLocalContact()
    {
        return $this->localContact;
    }

    /**
     * @param string $fromUser
     *
     * @return static
     */
    public function setFromUser($fromUser = null)
    {
        $this->fromUser = $fromUser;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromUser()
    {
        return $this->fromUser;
    }

    /**
     * @param string $fromDomain
     *
     * @return static
     */
    public function setFromDomain($fromDomain = null)
    {
        $this->fromDomain = $fromDomain;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromDomain()
    {
        return $this->fromDomain;
    }

    /**
     * @param integer $updated
     *
     * @return static
     */
    public function setUpdated($updated = null)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * @return integer
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param integer $updatedWinfo
     *
     * @return static
     */
    public function setUpdatedWinfo($updatedWinfo = null)
    {
        $this->updatedWinfo = $updatedWinfo;

        return $this;
    }

    /**
     * @return integer
     */
    public function getUpdatedWinfo()
    {
        return $this->updatedWinfo;
    }

    /**
     * @param integer $flags
     *
     * @return static
     */
    public function setFlags($flags = null)
    {
        $this->flags = $flags;

        return $this;
    }

    /**
     * @return integer
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * @param string $userAgent
     *
     * @return static
     */
    public function setUserAgent($userAgent = null)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
