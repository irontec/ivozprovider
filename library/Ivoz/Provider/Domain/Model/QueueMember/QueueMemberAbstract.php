<?php

namespace Ivoz\Provider\Domain\Model\QueueMember;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * QueueMemberAbstract
 * @codeCoverageIgnore
 */
abstract class QueueMemberAbstract
{
    /**
     * @var integer | null
     */
    protected $penalty;

    /**
     * @var \Ivoz\Provider\Domain\Model\Queue\QueueInterface
     */
    protected $queue;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $user;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct()
    {
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
     * @param null $id
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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, QueueMemberDto::class);

        $self = new static();

        $self
            ->setPenalty($dto->getPenalty())
            ->setQueue($fkTransformer->transform($dto->getQueue()))
            ->setUser($fkTransformer->transform($dto->getUser()))
        ;

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setQueue(\Ivoz\Provider\Domain\Model\Queue\Queue::entityToDto(self::getQueue(), $depth))
            ->setUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getUser(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'penalty' => self::getPenalty(),
            'queueId' => self::getQueue() ? self::getQueue()->getId() : null,
            'userId' => self::getUser() ? self::getUser()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set penalty
     *
     * @param integer $penalty | null
     *
     * @return static
     */
    protected function setPenalty($penalty = null)
    {
        if (!is_null($penalty)) {
            Assertion::integerish($penalty, 'penalty value "%s" is not an integer or a number castable to integer.');
            $penalty = (int) $penalty;
        }

        $this->penalty = $penalty;

        return $this;
    }

    /**
     * Get penalty
     *
     * @return integer | null
     */
    public function getPenalty()
    {
        return $this->penalty;
    }

    /**
     * Set queue
     *
     * @param \Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue
     *
     * @return static
     */
    public function setQueue(\Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue)
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * Get queue
     *
     * @return \Ivoz\Provider\Domain\Model\Queue\QueueInterface
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     *
     * @return static
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    // @codeCoverageIgnoreEnd
}
