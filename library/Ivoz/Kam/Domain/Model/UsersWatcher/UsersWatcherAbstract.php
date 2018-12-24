<?php

namespace Ivoz\Kam\Domain\Model\UsersWatcher;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * UsersWatcherAbstract
 * @codeCoverageIgnore
 */
abstract class UsersWatcherAbstract
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
     * @var string
     */
    protected $event = 'presence';

    /**
     * @var integer
     */
    protected $status;

    /**
     * @var string | null
     */
    protected $reason;

    /**
     * column: inserted_time
     * @var integer
     */
    protected $insertedTime;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $presentityUri,
        $watcherUsername,
        $watcherDomain,
        $event,
        $status,
        $insertedTime
    ) {
        $this->setPresentityUri($presentityUri);
        $this->setWatcherUsername($watcherUsername);
        $this->setWatcherDomain($watcherDomain);
        $this->setEvent($event);
        $this->setStatus($status);
        $this->setInsertedTime($insertedTime);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "UsersWatcher",
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
     * @return UsersWatcherDto
     */
    public static function createDto($id = null)
    {
        return new UsersWatcherDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return UsersWatcherDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, UsersWatcherInterface::class);

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
         * @var $dto UsersWatcherDto
         */
        Assertion::isInstanceOf($dto, UsersWatcherDto::class);

        $self = new static(
            $dto->getPresentityUri(),
            $dto->getWatcherUsername(),
            $dto->getWatcherDomain(),
            $dto->getEvent(),
            $dto->getStatus(),
            $dto->getInsertedTime()
        );

        $self
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
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UsersWatcherDto
         */
        Assertion::isInstanceOf($dto, UsersWatcherDto::class);

        $this
            ->setPresentityUri($dto->getPresentityUri())
            ->setWatcherUsername($dto->getWatcherUsername())
            ->setWatcherDomain($dto->getWatcherDomain())
            ->setEvent($dto->getEvent())
            ->setStatus($dto->getStatus())
            ->setReason($dto->getReason())
            ->setInsertedTime($dto->getInsertedTime());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return UsersWatcherDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setPresentityUri(self::getPresentityUri())
            ->setWatcherUsername(self::getWatcherUsername())
            ->setWatcherDomain(self::getWatcherDomain())
            ->setEvent(self::getEvent())
            ->setStatus(self::getStatus())
            ->setReason(self::getReason())
            ->setInsertedTime(self::getInsertedTime());
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
            'event' => self::getEvent(),
            'status' => self::getStatus(),
            'reason' => self::getReason(),
            'inserted_time' => self::getInsertedTime()
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
        Assertion::maxLength($watcherDomain, 190, 'watcherDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * Set insertedTime
     *
     * @param integer $insertedTime
     *
     * @return self
     */
    protected function setInsertedTime($insertedTime)
    {
        Assertion::notNull($insertedTime, 'insertedTime value "%s" is null, but non null value was expected.');
        Assertion::integerish($insertedTime, 'insertedTime value "%s" is not an integer or a number castable to integer.');

        $this->insertedTime = $insertedTime;

        return $this;
    }

    /**
     * Get insertedTime
     *
     * @return integer
     */
    public function getInsertedTime()
    {
        return $this->insertedTime;
    }

    // @codeCoverageIgnoreEnd
}
