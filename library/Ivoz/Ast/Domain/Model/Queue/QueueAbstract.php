<?php

declare(strict_types=1);

namespace Ivoz\Ast\Domain\Model\Queue;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Queue\Queue;

/**
* QueueAbstract
* @codeCoverageIgnore
*/
abstract class QueueAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var ?string
     * column: periodic_announce
     */
    protected $periodicAnnounce = null;

    /**
     * @var ?int
     * column: periodic_announce_frequency
     */
    protected $periodicAnnounceFrequency = null;

    /**
     * @var ?string
     * column: announce_position
     */
    protected $announcePosition = 'no';

    /**
     * @var ?int
     * column: announce_frequency
     */
    protected $announceFrequency = null;

    /**
     * @var ?int
     */
    protected $timeout = null;

    /**
     * @var string
     * comment: enum:yes|no|all
     */
    protected $autopause = 'no';

    /**
     * @var string
     * comment: enum:yes|no
     */
    protected $ringinuse = 'no';

    /**
     * @var ?int
     */
    protected $wrapuptime = null;

    /**
     * @var ?int
     */
    protected $maxlen = null;

    /**
     * @var ?string
     * comment: enum:ringall|leastrecent|fewestcalls|random|rrmemory|linear|wrandom|rrordered
     */
    protected $strategy = null;

    /**
     * @var ?int
     */
    protected $weight = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\Queue\QueueInterface
     */
    protected $queue;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        string $autopause,
        string $ringinuse
    ) {
        $this->setName($name);
        $this->setAutopause($autopause);
        $this->setRinginuse($ringinuse);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Queue",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): QueueDto
    {
        return new QueueDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|QueueInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?QueueDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, QueueInterface::class);

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
     * @param QueueDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, QueueDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $autopause = $dto->getAutopause();
        Assertion::notNull($autopause, 'getAutopause value is null, but non null value was expected.');
        $ringinuse = $dto->getRinginuse();
        Assertion::notNull($ringinuse, 'getRinginuse value is null, but non null value was expected.');
        $queue = $dto->getQueue();
        Assertion::notNull($queue, 'getQueue value is null, but non null value was expected.');

        $self = new static(
            $name,
            $autopause,
            $ringinuse
        );

        $self
            ->setPeriodicAnnounce($dto->getPeriodicAnnounce())
            ->setPeriodicAnnounceFrequency($dto->getPeriodicAnnounceFrequency())
            ->setAnnouncePosition($dto->getAnnouncePosition())
            ->setAnnounceFrequency($dto->getAnnounceFrequency())
            ->setTimeout($dto->getTimeout())
            ->setWrapuptime($dto->getWrapuptime())
            ->setMaxlen($dto->getMaxlen())
            ->setStrategy($dto->getStrategy())
            ->setWeight($dto->getWeight())
            ->setQueue($fkTransformer->transform($queue));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param QueueDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, QueueDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $autopause = $dto->getAutopause();
        Assertion::notNull($autopause, 'getAutopause value is null, but non null value was expected.');
        $ringinuse = $dto->getRinginuse();
        Assertion::notNull($ringinuse, 'getRinginuse value is null, but non null value was expected.');
        $queue = $dto->getQueue();
        Assertion::notNull($queue, 'getQueue value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setPeriodicAnnounce($dto->getPeriodicAnnounce())
            ->setPeriodicAnnounceFrequency($dto->getPeriodicAnnounceFrequency())
            ->setAnnouncePosition($dto->getAnnouncePosition())
            ->setAnnounceFrequency($dto->getAnnounceFrequency())
            ->setTimeout($dto->getTimeout())
            ->setAutopause($autopause)
            ->setRinginuse($ringinuse)
            ->setWrapuptime($dto->getWrapuptime())
            ->setMaxlen($dto->getMaxlen())
            ->setStrategy($dto->getStrategy())
            ->setWeight($dto->getWeight())
            ->setQueue($fkTransformer->transform($queue));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): QueueDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setPeriodicAnnounce(self::getPeriodicAnnounce())
            ->setPeriodicAnnounceFrequency(self::getPeriodicAnnounceFrequency())
            ->setAnnouncePosition(self::getAnnouncePosition())
            ->setAnnounceFrequency(self::getAnnounceFrequency())
            ->setTimeout(self::getTimeout())
            ->setAutopause(self::getAutopause())
            ->setRinginuse(self::getRinginuse())
            ->setWrapuptime(self::getWrapuptime())
            ->setMaxlen(self::getMaxlen())
            ->setStrategy(self::getStrategy())
            ->setWeight(self::getWeight())
            ->setQueue(Queue::entityToDto(self::getQueue(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'periodic_announce' => self::getPeriodicAnnounce(),
            'periodic_announce_frequency' => self::getPeriodicAnnounceFrequency(),
            'announce_position' => self::getAnnouncePosition(),
            'announce_frequency' => self::getAnnounceFrequency(),
            'timeout' => self::getTimeout(),
            'autopause' => self::getAutopause(),
            'ringinuse' => self::getRinginuse(),
            'wrapuptime' => self::getWrapuptime(),
            'maxlen' => self::getMaxlen(),
            'strategy' => self::getStrategy(),
            'weight' => self::getWeight(),
            'queueId' => self::getQueue()->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 128, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setPeriodicAnnounce(?string $periodicAnnounce = null): static
    {
        if (!is_null($periodicAnnounce)) {
            Assertion::maxLength($periodicAnnounce, 128, 'periodicAnnounce value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->periodicAnnounce = $periodicAnnounce;

        return $this;
    }

    public function getPeriodicAnnounce(): ?string
    {
        return $this->periodicAnnounce;
    }

    protected function setPeriodicAnnounceFrequency(?int $periodicAnnounceFrequency = null): static
    {
        $this->periodicAnnounceFrequency = $periodicAnnounceFrequency;

        return $this;
    }

    public function getPeriodicAnnounceFrequency(): ?int
    {
        return $this->periodicAnnounceFrequency;
    }

    protected function setAnnouncePosition(?string $announcePosition = null): static
    {
        if (!is_null($announcePosition)) {
            Assertion::maxLength($announcePosition, 128, 'announcePosition value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->announcePosition = $announcePosition;

        return $this;
    }

    public function getAnnouncePosition(): ?string
    {
        return $this->announcePosition;
    }

    protected function setAnnounceFrequency(?int $announceFrequency = null): static
    {
        $this->announceFrequency = $announceFrequency;

        return $this;
    }

    public function getAnnounceFrequency(): ?int
    {
        return $this->announceFrequency;
    }

    protected function setTimeout(?int $timeout = null): static
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function getTimeout(): ?int
    {
        return $this->timeout;
    }

    protected function setAutopause(string $autopause): static
    {
        Assertion::maxLength($autopause, 25, 'autopause value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $autopause,
            [
                QueueInterface::AUTOPAUSE_YES,
                QueueInterface::AUTOPAUSE_NO,
                QueueInterface::AUTOPAUSE_ALL,
            ],
            'autopausevalue "%s" is not an element of the valid values: %s'
        );

        $this->autopause = $autopause;

        return $this;
    }

    public function getAutopause(): string
    {
        return $this->autopause;
    }

    protected function setRinginuse(string $ringinuse): static
    {
        Assertion::maxLength($ringinuse, 25, 'ringinuse value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $ringinuse,
            [
                QueueInterface::RINGINUSE_YES,
                QueueInterface::RINGINUSE_NO,
            ],
            'ringinusevalue "%s" is not an element of the valid values: %s'
        );

        $this->ringinuse = $ringinuse;

        return $this;
    }

    public function getRinginuse(): string
    {
        return $this->ringinuse;
    }

    protected function setWrapuptime(?int $wrapuptime = null): static
    {
        $this->wrapuptime = $wrapuptime;

        return $this;
    }

    public function getWrapuptime(): ?int
    {
        return $this->wrapuptime;
    }

    protected function setMaxlen(?int $maxlen = null): static
    {
        $this->maxlen = $maxlen;

        return $this;
    }

    public function getMaxlen(): ?int
    {
        return $this->maxlen;
    }

    protected function setStrategy(?string $strategy = null): static
    {
        if (!is_null($strategy)) {
            Assertion::maxLength($strategy, 25, 'strategy value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $strategy,
                [
                    QueueInterface::STRATEGY_RINGALL,
                    QueueInterface::STRATEGY_LEASTRECENT,
                    QueueInterface::STRATEGY_FEWESTCALLS,
                    QueueInterface::STRATEGY_RANDOM,
                    QueueInterface::STRATEGY_RRMEMORY,
                    QueueInterface::STRATEGY_LINEAR,
                    QueueInterface::STRATEGY_WRANDOM,
                    QueueInterface::STRATEGY_RRORDERED,
                ],
                'strategyvalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->strategy = $strategy;

        return $this;
    }

    public function getStrategy(): ?string
    {
        return $this->strategy;
    }

    protected function setWeight(?int $weight = null): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    protected function setQueue(\Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue): static
    {
        $this->queue = $queue;

        return $this;
    }

    public function getQueue(): \Ivoz\Provider\Domain\Model\Queue\QueueInterface
    {
        return $this->queue;
    }
}
