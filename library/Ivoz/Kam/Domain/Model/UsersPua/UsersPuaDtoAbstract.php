<?php

namespace Ivoz\Kam\Domain\Model\UsersPua;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class UsersPuaDtoAbstract implements DataTransferObjectInterface
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
     * @param string $presUri
     *
     * @return static
     */
    public function setPresUri($presUri = null)
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
     * @return static
     */
    public function setPresId($presId = null)
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
     * @return static
     */
    public function setEvent($event = null)
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
     * @param integer $desiredExpires
     *
     * @return static
     */
    public function setDesiredExpires($desiredExpires = null)
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
     * @return static
     */
    public function setFlag($flag = null)
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
     * @return static
     */
    public function setEtag($etag = null)
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
     * @return static
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
     * @return static
     */
    public function setWatcherUri($watcherUri = null)
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
     * @return static
     */
    public function setCallId($callId = null)
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
     * @param integer $cseq
     *
     * @return static
     */
    public function setCseq($cseq = null)
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
     * @param string $remoteContact
     *
     * @return static
     */
    public function setRemoteContact($remoteContact = null)
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
     * @param string $extraHeaders
     *
     * @return static
     */
    public function setExtraHeaders($extraHeaders = null)
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
