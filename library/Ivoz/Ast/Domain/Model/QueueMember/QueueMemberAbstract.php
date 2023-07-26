<?php

declare(strict_types=1);

namespace Ivoz\Ast\Domain\Model\QueueMember;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMember;

/**
* QueueMemberAbstract
* @codeCoverageIgnore
*/
abstract class QueueMemberAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $uniqueid;

    /**
     * @var string
     * column: queue_name
     */
    protected $queueName;

    /**
     * @var string
     */
    protected $interface;

    /**
     * @var string
     */
    protected $membername;

    /**
     * @var string
     * column: state_interface
     */
    protected $stateInterface;

    /**
     * @var int
     */
    protected $penalty;

    /**
     * @var int
     */
    protected $paused = 0;

    /**
     * @var ?\Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface
     */
    protected $queueMember = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $uniqueid,
        string $queueName,
        string $interface,
        string $membername,
        string $stateInterface,
        int $penalty,
        int $paused
    ) {
        $this->setUniqueid($uniqueid);
        $this->setQueueName($queueName);
        $this->setInterface($interface);
        $this->setMembername($membername);
        $this->setStateInterface($stateInterface);
        $this->setPenalty($penalty);
        $this->setPaused($paused);
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
        $uniqueid = $dto->getUniqueid();
        Assertion::notNull($uniqueid, 'getUniqueid value is null, but non null value was expected.');
        $queueName = $dto->getQueueName();
        Assertion::notNull($queueName, 'getQueueName value is null, but non null value was expected.');
        $interface = $dto->getInterface();
        Assertion::notNull($interface, 'getInterface value is null, but non null value was expected.');
        $membername = $dto->getMembername();
        Assertion::notNull($membername, 'getMembername value is null, but non null value was expected.');
        $stateInterface = $dto->getStateInterface();
        Assertion::notNull($stateInterface, 'getStateInterface value is null, but non null value was expected.');
        $penalty = $dto->getPenalty();
        Assertion::notNull($penalty, 'getPenalty value is null, but non null value was expected.');
        $paused = $dto->getPaused();
        Assertion::notNull($paused, 'getPaused value is null, but non null value was expected.');

        $self = new static(
            $uniqueid,
            $queueName,
            $interface,
            $membername,
            $stateInterface,
            $penalty,
            $paused
        );

        $self
            ->setQueueMember($fkTransformer->transform($dto->getQueueMember()));

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

        $uniqueid = $dto->getUniqueid();
        Assertion::notNull($uniqueid, 'getUniqueid value is null, but non null value was expected.');
        $queueName = $dto->getQueueName();
        Assertion::notNull($queueName, 'getQueueName value is null, but non null value was expected.');
        $interface = $dto->getInterface();
        Assertion::notNull($interface, 'getInterface value is null, but non null value was expected.');
        $membername = $dto->getMembername();
        Assertion::notNull($membername, 'getMembername value is null, but non null value was expected.');
        $stateInterface = $dto->getStateInterface();
        Assertion::notNull($stateInterface, 'getStateInterface value is null, but non null value was expected.');
        $penalty = $dto->getPenalty();
        Assertion::notNull($penalty, 'getPenalty value is null, but non null value was expected.');
        $paused = $dto->getPaused();
        Assertion::notNull($paused, 'getPaused value is null, but non null value was expected.');

        $this
            ->setUniqueid($uniqueid)
            ->setQueueName($queueName)
            ->setInterface($interface)
            ->setMembername($membername)
            ->setStateInterface($stateInterface)
            ->setPenalty($penalty)
            ->setPaused($paused)
            ->setQueueMember($fkTransformer->transform($dto->getQueueMember()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): QueueMemberDto
    {
        return self::createDto()
            ->setUniqueid(self::getUniqueid())
            ->setQueueName(self::getQueueName())
            ->setInterface(self::getInterface())
            ->setMembername(self::getMembername())
            ->setStateInterface(self::getStateInterface())
            ->setPenalty(self::getPenalty())
            ->setPaused(self::getPaused())
            ->setQueueMember(QueueMember::entityToDto(self::getQueueMember(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'uniqueid' => self::getUniqueid(),
            'queue_name' => self::getQueueName(),
            'interface' => self::getInterface(),
            'membername' => self::getMembername(),
            'state_interface' => self::getStateInterface(),
            'penalty' => self::getPenalty(),
            'paused' => self::getPaused(),
            'queueMemberId' => self::getQueueMember()?->getId()
        ];
    }

    protected function setUniqueid(string $uniqueid): static
    {
        Assertion::maxLength($uniqueid, 80, 'uniqueid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->uniqueid = $uniqueid;

        return $this;
    }

    public function getUniqueid(): string
    {
        return $this->uniqueid;
    }

    protected function setQueueName(string $queueName): static
    {
        Assertion::maxLength($queueName, 128, 'queueName value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->queueName = $queueName;

        return $this;
    }

    public function getQueueName(): string
    {
        return $this->queueName;
    }

    protected function setInterface(string $interface): static
    {
        Assertion::maxLength($interface, 80, 'interface value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->interface = $interface;

        return $this;
    }

    public function getInterface(): string
    {
        return $this->interface;
    }

    protected function setMembername(string $membername): static
    {
        Assertion::maxLength($membername, 256, 'membername value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->membername = $membername;

        return $this;
    }

    public function getMembername(): string
    {
        return $this->membername;
    }

    protected function setStateInterface(string $stateInterface): static
    {
        Assertion::maxLength($stateInterface, 80, 'stateInterface value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->stateInterface = $stateInterface;

        return $this;
    }

    public function getStateInterface(): string
    {
        return $this->stateInterface;
    }

    protected function setPenalty(int $penalty): static
    {
        $this->penalty = $penalty;

        return $this;
    }

    public function getPenalty(): int
    {
        return $this->penalty;
    }

    protected function setPaused(int $paused): static
    {
        $this->paused = $paused;

        return $this;
    }

    public function getPaused(): int
    {
        return $this->paused;
    }

    protected function setQueueMember(?\Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface $queueMember = null): static
    {
        $this->queueMember = $queueMember;

        return $this;
    }

    public function getQueueMember(): ?\Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface
    {
        return $this->queueMember;
    }
}
