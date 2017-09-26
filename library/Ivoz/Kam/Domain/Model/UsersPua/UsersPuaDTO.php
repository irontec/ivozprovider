<?php

namespace Ivoz\Kam\Domain\Model\UsersPua;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class UsersPuaDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $presUri;

    /**
     * @var string
     */
    private $presId;

    /**
     * @var integer
     */
    private $event;

    /**
     * @var integer
     */
    private $expires;

    /**
     * @var integer
     */
    private $desiredExpires;

    /**
     * @var integer
     */
    private $flag;

    /**
     * @var string
     */
    private $etag;

    /**
     * @var string
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
     * @var integer
     */
    private $cseq;

    /**
     * @var string
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
     * @var integer
     */
    private $version;

    /**
     * @var string
     */
    private $extraHeaders;

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
     * @param string $presUri
     *
     * @return UsersPuaDTO
     */
    public function setPresUri($presUri)
    {
        $this->presUri = $presUri;

        return $this;
    }

    /**
     * @return string
     */
    public function getPresUri()
    {
        return $this->presUri;
    }

    /**
     * @param string $presId
     *
     * @return UsersPuaDTO
     */
    public function setPresId($presId)
    {
        $this->presId = $presId;

        return $this;
    }

    /**
     * @return string
     */
    public function getPresId()
    {
        return $this->presId;
    }

    /**
     * @param integer $event
     *
     * @return UsersPuaDTO
     */
    public function setEvent($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return integer
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param integer $expires
     *
     * @return UsersPuaDTO
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
     * @param integer $desiredExpires
     *
     * @return UsersPuaDTO
     */
    public function setDesiredExpires($desiredExpires)
    {
        $this->desiredExpires = $desiredExpires;

        return $this;
    }

    /**
     * @return integer
     */
    public function getDesiredExpires()
    {
        return $this->desiredExpires;
    }

    /**
     * @param integer $flag
     *
     * @return UsersPuaDTO
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * @return integer
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * @param string $etag
     *
     * @return UsersPuaDTO
     */
    public function setEtag($etag)
    {
        $this->etag = $etag;

        return $this;
    }

    /**
     * @return string
     */
    public function getEtag()
    {
        return $this->etag;
    }

    /**
     * @param string $tupleId
     *
     * @return UsersPuaDTO
     */
    public function setTupleId($tupleId = null)
    {
        $this->tupleId = $tupleId;

        return $this;
    }

    /**
     * @return string
     */
    public function getTupleId()
    {
        return $this->tupleId;
    }

    /**
     * @param string $watcherUri
     *
     * @return UsersPuaDTO
     */
    public function setWatcherUri($watcherUri)
    {
        $this->watcherUri = $watcherUri;

        return $this;
    }

    /**
     * @return string
     */
    public function getWatcherUri()
    {
        return $this->watcherUri;
    }

    /**
     * @param string $callId
     *
     * @return UsersPuaDTO
     */
    public function setCallId($callId)
    {
        $this->callId = $callId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallId()
    {
        return $this->callId;
    }

    /**
     * @param string $toTag
     *
     * @return UsersPuaDTO
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
     * @return UsersPuaDTO
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
     * @param integer $cseq
     *
     * @return UsersPuaDTO
     */
    public function setCseq($cseq)
    {
        $this->cseq = $cseq;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCseq()
    {
        return $this->cseq;
    }

    /**
     * @param string $recordRoute
     *
     * @return UsersPuaDTO
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
     * @param string $contact
     *
     * @return UsersPuaDTO
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
     * @param string $remoteContact
     *
     * @return UsersPuaDTO
     */
    public function setRemoteContact($remoteContact)
    {
        $this->remoteContact = $remoteContact;

        return $this;
    }

    /**
     * @return string
     */
    public function getRemoteContact()
    {
        return $this->remoteContact;
    }

    /**
     * @param integer $version
     *
     * @return UsersPuaDTO
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
     * @param string $extraHeaders
     *
     * @return UsersPuaDTO
     */
    public function setExtraHeaders($extraHeaders)
    {
        $this->extraHeaders = $extraHeaders;

        return $this;
    }

    /**
     * @return string
     */
    public function getExtraHeaders()
    {
        return $this->extraHeaders;
    }

    /**
     * @param integer $id
     *
     * @return UsersPuaDTO
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

