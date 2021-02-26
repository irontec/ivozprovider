<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\QueueMember;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var int | null
     */
    protected $penalty;

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
    protected function __construct(

    ) {

    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "QueueMember",
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
     * @param mixed $id
     * @return QueueMemberDto
     */
    public static function createDto($id = null)
    {
        return new QueueMemberDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param QueueMemberInterface|null $entity
     * @param int $depth
     * @return QueueMemberDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var QueueMemberDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param QueueMemberDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, QueueMemberDto::class);

        $self = new static(

        );

        $self
            ->setPenalty($dto->getPenalty())
            ->setQueue($fkTransformer->transform($dto->getQueue()))
            ->setUser($fkTransformer->transform($dto->getUser()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param QueueMemberDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, QueueMemberDto::class);

        $this
            ->setPenalty($dto->getPenalty())
            ->setQueue($fkTransformer->transform($dto->getQueue()))
            ->setUser($fkTransformer->transform($dto->getUser()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return QueueMemberDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setPenalty(self::getPenalty())
            ->setQueue(Queue::entityToDto(self::getQueue(), $depth))
            ->setUser(User::entityToDto(self::getUser(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
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

        /** @var  $this */
        return $this;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

}
