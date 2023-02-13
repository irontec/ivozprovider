<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\QueueMember;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Queue\QueueInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Queue\Queue;
use Ivoz\Provider\Domain\Model\User\User;

/**
* QueueMemberAbstract
* @codeCoverageIgnore
*/
abstract class QueueMemberAbstract
{
    use ChangelogTrait;

    /**
     * @var ?int
     */
    protected $penalty = null;

    /**
     * @var QueueInterface
     */
    protected $queue;

    /**
     * @var UserInterface
     * inversedBy queueMembers
     */
    protected $user;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "QueueMember",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): QueueMemberDto
    {
        return new QueueMemberDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|QueueMemberInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?QueueMemberDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, QueueMemberInterface::class);

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
     * @param QueueMemberDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, QueueMemberDto::class);
        $queue = $dto->getQueue();
        Assertion::notNull($queue, 'getQueue value is null, but non null value was expected.');
        $user = $dto->getUser();
        Assertion::notNull($user, 'getUser value is null, but non null value was expected.');

        $self = new static();

        $self
            ->setPenalty($dto->getPenalty())
            ->setQueue($fkTransformer->transform($queue))
            ->setUser($fkTransformer->transform($user));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param QueueMemberDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, QueueMemberDto::class);

        $queue = $dto->getQueue();
        Assertion::notNull($queue, 'getQueue value is null, but non null value was expected.');
        $user = $dto->getUser();
        Assertion::notNull($user, 'getUser value is null, but non null value was expected.');

        $this
            ->setPenalty($dto->getPenalty())
            ->setQueue($fkTransformer->transform($queue))
            ->setUser($fkTransformer->transform($user));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): QueueMemberDto
    {
        return self::createDto()
            ->setPenalty(self::getPenalty())
            ->setQueue(Queue::entityToDto(self::getQueue(), $depth))
            ->setUser(User::entityToDto(self::getUser(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'penalty' => self::getPenalty(),
            'queueId' => self::getQueue()->getId(),
            'userId' => self::getUser()->getId()
        ];
    }

    protected function setPenalty(?int $penalty = null): static
    {
        $this->penalty = $penalty;

        return $this;
    }

    public function getPenalty(): ?int
    {
        return $this->penalty;
    }

    protected function setQueue(QueueInterface $queue): static
    {
        $this->queue = $queue;

        return $this;
    }

    public function getQueue(): QueueInterface
    {
        return $this->queue;
    }

    public function setUser(UserInterface $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }
}
