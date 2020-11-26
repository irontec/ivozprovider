<?php
declare(strict_types = 1);

namespace Ivoz\Kam\Domain\Model\UsersWatcher;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* UsersWatcherAbstract
* @codeCoverageIgnore
*/
abstract class UsersWatcherAbstract
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
     * @var string
     */
    protected $event = 'presence';

    /**
     * @var int
     */
    protected $status;

    /**
     * @var string | null
     */
    protected $reason;

    /**
     * column: inserted_time
     * @var int
     */
    protected $insertedTime;

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
     * @param UsersWatcherInterface|null $entity
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

        /** @var UsersWatcherDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersWatcherDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setReason($dto->getReason());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param UsersWatcherDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, UsersWatcherDto::class);

        $this
            ->setPresentityUri($dto->getPresentityUri())
            ->setWatcherUsername($dto->getWatcherUsername())
            ->setWatcherDomain($dto->getWatcherDomain())
            ->setEvent($dto->getEvent())
            ->setStatus($dto->getStatus())
            ->setReason($dto->getReason())
            ->setInsertedTime($dto->getInsertedTime());

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

    /**
     * Set presentityUri
     *
     * @param string $presentityUri
     *
     * @return static
     */
    protected function setPresentityUri(string $presentityUri): UsersWatcherInterface
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
    protected function setWatcherUsername(string $watcherUsername): UsersWatcherInterface
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
    protected function setWatcherDomain(string $watcherDomain): UsersWatcherInterface
    {
        Assertion::maxLength($watcherDomain, 190, 'watcherDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * Set event
     *
     * @param string $event
     *
     * @return static
     */
    protected function setEvent(string $event): UsersWatcherInterface
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
     * Set status
     *
     * @param int $status
     *
     * @return static
     */
    protected function setStatus(int $status): UsersWatcherInterface
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
    protected function setReason(?string $reason = null): UsersWatcherInterface
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
     * Set insertedTime
     *
     * @param int $insertedTime
     *
     * @return static
     */
    protected function setInsertedTime(int $insertedTime): UsersWatcherInterface
    {
        $this->insertedTime = $insertedTime;

        return $this;
    }

    /**
     * Get insertedTime
     *
     * @return int
     */
    public function getInsertedTime(): int
    {
        return $this->insertedTime;
    }

}
