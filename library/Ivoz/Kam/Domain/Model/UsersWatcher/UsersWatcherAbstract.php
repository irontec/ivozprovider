<?php

declare(strict_types=1);

namespace Ivoz\Kam\Domain\Model\UsersWatcher;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* UsersWatcherAbstract
* @codeCoverageIgnore
*/
abstract class UsersWatcherAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     * column: presentity_uri
     */
    protected $presentityUri;

    /**
     * @var string
     * column: watcher_username
     */
    protected $watcherUsername;

    /**
     * @var string
     * column: watcher_domain
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
     * @var ?string
     */
    protected $reason = null;

    /**
     * @var int
     * column: inserted_time
     */
    protected $insertedTime;

    /**
     * Constructor
     */
    protected function __construct(
        string $presentityUri,
        string $watcherUsername,
        string $watcherDomain,
        string $event,
        int $status,
        int $insertedTime
    ) {
        $this->setPresentityUri($presentityUri);
        $this->setWatcherUsername($watcherUsername);
        $this->setWatcherDomain($watcherDomain);
        $this->setEvent($event);
        $this->setStatus($status);
        $this->setInsertedTime($insertedTime);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "UsersWatcher",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): UsersWatcherDto
    {
        return new UsersWatcherDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|UsersWatcherInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UsersWatcherDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersWatcherDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, UsersWatcherDto::class);
        $presentityUri = $dto->getPresentityUri();
        Assertion::notNull($presentityUri, 'getPresentityUri value is null, but non null value was expected.');
        $watcherUsername = $dto->getWatcherUsername();
        Assertion::notNull($watcherUsername, 'getWatcherUsername value is null, but non null value was expected.');
        $watcherDomain = $dto->getWatcherDomain();
        Assertion::notNull($watcherDomain, 'getWatcherDomain value is null, but non null value was expected.');
        $event = $dto->getEvent();
        Assertion::notNull($event, 'getEvent value is null, but non null value was expected.');
        $status = $dto->getStatus();
        Assertion::notNull($status, 'getStatus value is null, but non null value was expected.');
        $insertedTime = $dto->getInsertedTime();
        Assertion::notNull($insertedTime, 'getInsertedTime value is null, but non null value was expected.');

        $self = new static(
            $presentityUri,
            $watcherUsername,
            $watcherDomain,
            $event,
            $status,
            $insertedTime
        );

        $self
            ->setReason($dto->getReason());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param UsersWatcherDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, UsersWatcherDto::class);

        $presentityUri = $dto->getPresentityUri();
        Assertion::notNull($presentityUri, 'getPresentityUri value is null, but non null value was expected.');
        $watcherUsername = $dto->getWatcherUsername();
        Assertion::notNull($watcherUsername, 'getWatcherUsername value is null, but non null value was expected.');
        $watcherDomain = $dto->getWatcherDomain();
        Assertion::notNull($watcherDomain, 'getWatcherDomain value is null, but non null value was expected.');
        $event = $dto->getEvent();
        Assertion::notNull($event, 'getEvent value is null, but non null value was expected.');
        $status = $dto->getStatus();
        Assertion::notNull($status, 'getStatus value is null, but non null value was expected.');
        $insertedTime = $dto->getInsertedTime();
        Assertion::notNull($insertedTime, 'getInsertedTime value is null, but non null value was expected.');

        $this
            ->setPresentityUri($presentityUri)
            ->setWatcherUsername($watcherUsername)
            ->setWatcherDomain($watcherDomain)
            ->setEvent($event)
            ->setStatus($status)
            ->setReason($dto->getReason())
            ->setInsertedTime($insertedTime);

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersWatcherDto
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

    protected function __toArray(): array
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

    protected function setPresentityUri(string $presentityUri): static
    {
        Assertion::maxLength($presentityUri, 255, 'presentityUri value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->presentityUri = $presentityUri;

        return $this;
    }

    public function getPresentityUri(): string
    {
        return $this->presentityUri;
    }

    protected function setWatcherUsername(string $watcherUsername): static
    {
        Assertion::maxLength($watcherUsername, 64, 'watcherUsername value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->watcherUsername = $watcherUsername;

        return $this;
    }

    public function getWatcherUsername(): string
    {
        return $this->watcherUsername;
    }

    protected function setWatcherDomain(string $watcherDomain): static
    {
        Assertion::maxLength($watcherDomain, 190, 'watcherDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->watcherDomain = $watcherDomain;

        return $this;
    }

    public function getWatcherDomain(): string
    {
        return $this->watcherDomain;
    }

    protected function setEvent(string $event): static
    {
        Assertion::maxLength($event, 64, 'event value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->event = $event;

        return $this;
    }

    public function getEvent(): string
    {
        return $this->event;
    }

    protected function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    protected function setReason(?string $reason = null): static
    {
        if (!is_null($reason)) {
            Assertion::maxLength($reason, 64, 'reason value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->reason = $reason;

        return $this;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    protected function setInsertedTime(int $insertedTime): static
    {
        $this->insertedTime = $insertedTime;

        return $this;
    }

    public function getInsertedTime(): int
    {
        return $this->insertedTime;
    }
}
