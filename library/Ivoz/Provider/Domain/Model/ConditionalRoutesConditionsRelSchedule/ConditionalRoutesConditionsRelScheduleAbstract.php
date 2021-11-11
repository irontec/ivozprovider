<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface;
use Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesCondition;
use Ivoz\Provider\Domain\Model\Schedule\Schedule;

/**
* ConditionalRoutesConditionsRelScheduleAbstract
* @codeCoverageIgnore
*/
abstract class ConditionalRoutesConditionsRelScheduleAbstract
{
    use ChangelogTrait;

    /**
     * @var ConditionalRoutesConditionInterface | null
     * inversedBy relSchedules
     */
    protected $condition;

    /**
     * @var ScheduleInterface
     */
    protected $schedule;

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
            "ConditionalRoutesConditionsRelSchedule",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): ConditionalRoutesConditionsRelScheduleDto
    {
        return new ConditionalRoutesConditionsRelScheduleDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ConditionalRoutesConditionsRelScheduleInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ConditionalRoutesConditionsRelScheduleDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ConditionalRoutesConditionsRelScheduleInterface::class);

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
     * @param ConditionalRoutesConditionsRelScheduleDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionsRelScheduleDto::class);

        $self = new static();

        $self
            ->setCondition($fkTransformer->transform($dto->getCondition()))
            ->setSchedule($fkTransformer->transform($dto->getSchedule()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionsRelScheduleDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionsRelScheduleDto::class);

        $this
            ->setCondition($fkTransformer->transform($dto->getCondition()))
            ->setSchedule($fkTransformer->transform($dto->getSchedule()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ConditionalRoutesConditionsRelScheduleDto
    {
        return self::createDto()
            ->setCondition(ConditionalRoutesCondition::entityToDto(self::getCondition(), $depth))
            ->setSchedule(Schedule::entityToDto(self::getSchedule(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'conditionId' => self::getCondition() ? self::getCondition()->getId() : null,
            'scheduleId' => self::getSchedule()->getId()
        ];
    }

    public function setCondition(?ConditionalRoutesConditionInterface $condition = null): static
    {
        $this->condition = $condition;

        return $this;
    }

    public function getCondition(): ?ConditionalRoutesConditionInterface
    {
        return $this->condition;
    }

    protected function setSchedule(ScheduleInterface $schedule): static
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getSchedule(): ScheduleInterface
    {
        return $this->schedule;
    }
}
