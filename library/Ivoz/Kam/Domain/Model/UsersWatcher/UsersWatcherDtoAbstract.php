<?php

namespace Ivoz\Kam\Domain\Model\UsersWatcher;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class UsersWatcherDtoAbstract implements DataTransferObjectInterface
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
            'event' => 'event',
            'status' => 'status',
            'reason' => 'reason',
            'insertedTime' => 'insertedTime',
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
            'event' => $this->getEvent(),
            'status' => $this->getStatus(),
            'reason' => $this->getReason(),
            'insertedTime' => $this->getInsertedTime(),
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
     * @param integer $insertedTime
     *
     * @return static
     */
    public function setInsertedTime($insertedTime = null)
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
