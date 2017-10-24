<?php

namespace Ivoz\Kam\Domain\Model\UsersActiveWatcher;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class UsersActiveWatcherDTO implements DataTransferObjectInterface
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
    private $status = '2';

    /**
     * @var string
     */
    private $reason;

    /**
     * @var integer
     */
    private $version = '0';

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
    private $flags = '0';

    /**
     * @var string
     */
    private $userAgent = '';

    /**
     * @var integer
     */
    private $id;

    /**
     * @return array
     */
    public function __toArray()
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
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $presentityUri
     *
     * @return UsersActiveWatcherDTO
     */
    public function setPresentityUri($presentityUri)
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
     * @return UsersActiveWatcherDTO
     */
    public function setWatcherUsername($watcherUsername)
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
     * @return UsersActiveWatcherDTO
     */
    public function setWatcherDomain($watcherDomain)
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
     * @return UsersActiveWatcherDTO
     */
    public function setToUser($toUser)
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
     * @return UsersActiveWatcherDTO
     */
    public function setToDomain($toDomain)
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
     * @return UsersActiveWatcherDTO
     */
    public function setEvent($event)
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
     * @return UsersActiveWatcherDTO
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
     * @return UsersActiveWatcherDTO
     */
    public function setToTag($toTag)
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
     * @return UsersActiveWatcherDTO
     */
    public function setFromTag($fromTag)
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
     * @return UsersActiveWatcherDTO
     */
    public function setCallid($callid)
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
     * @return UsersActiveWatcherDTO
     */
    public function setLocalCseq($localCseq)
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
     * @return UsersActiveWatcherDTO
     */
    public function setRemoteCseq($remoteCseq)
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
     * @return UsersActiveWatcherDTO
     */
    public function setContact($contact)
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
     * @return UsersActiveWatcherDTO
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
     * @return UsersActiveWatcherDTO
     */
    public function setExpires($expires)
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
     * @return UsersActiveWatcherDTO
     */
    public function setStatus($status)
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
     * @return UsersActiveWatcherDTO
     */
    public function setReason($reason)
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
     * @return UsersActiveWatcherDTO
     */
    public function setVersion($version)
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
     * @return UsersActiveWatcherDTO
     */
    public function setSocketInfo($socketInfo)
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
     * @return UsersActiveWatcherDTO
     */
    public function setLocalContact($localContact)
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
     * @return UsersActiveWatcherDTO
     */
    public function setFromUser($fromUser)
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
     * @return UsersActiveWatcherDTO
     */
    public function setFromDomain($fromDomain)
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
     * @return UsersActiveWatcherDTO
     */
    public function setUpdated($updated)
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
     * @return UsersActiveWatcherDTO
     */
    public function setUpdatedWinfo($updatedWinfo)
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
     * @return UsersActiveWatcherDTO
     */
    public function setFlags($flags)
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
     * @return UsersActiveWatcherDTO
     */
    public function setUserAgent($userAgent)
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
     * @return UsersActiveWatcherDTO
     */
    public function setId($id)
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


