<?php

namespace Ivoz\Kam\Domain\Model\UsersWatcher;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class UsersWatcherDTO implements DataTransferObjectInterface
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
    private $event = 'presence';

    /**
     * @var integer
     */
    private $status;

    /**
     * @var string
     */
    private $reason;

    /**
     * @var integer
     */
    private $insertedTime;

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
            'event' => $this->getEvent(),
            'status' => $this->getStatus(),
            'reason' => $this->getReason(),
            'insertedTime' => $this->getInsertedTime(),
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
     * @return UsersWatcherDTO
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
     * @return UsersWatcherDTO
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
     * @return UsersWatcherDTO
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
     * @param string $event
     *
     * @return UsersWatcherDTO
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
     * @param integer $status
     *
     * @return UsersWatcherDTO
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
     * @return UsersWatcherDTO
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
     * @param integer $insertedTime
     *
     * @return UsersWatcherDTO
     */
    public function setInsertedTime($insertedTime)
    {
        $this->insertedTime = $insertedTime;

        return $this;
    }

    /**
     * @return integer
     */
    public function getInsertedTime()
    {
        return $this->insertedTime;
    }

    /**
     * @param integer $id
     *
     * @return UsersWatcherDTO
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


