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

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "ConditionalRoutesConditionsRelSchedule",
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
     * @return ConditionalRoutesConditionsRelScheduleDto
     */
    public static function createDto($id = null)
    {
        return new ConditionalRoutesConditionsRelScheduleDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionsRelScheduleInterface|null $entity
     * @param int $depth
     * @return ConditionalRoutesConditionsRelScheduleDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var ConditionalRoutesConditionsRelScheduleDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionsRelScheduleDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionsRelScheduleDto::class);

        $this
            ->setCondition($fkTransformer->transform($dto->getCondition()))
            ->setSchedule($fkTransformer->transform($dto->getSchedule()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ConditionalRoutesConditionsRelScheduleDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCondition(ConditionalRoutesCondition::entityToDto(self::getCondition(), $depth))
            ->setSchedule(Schedule::entityToDto(self::getSchedule(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'conditionId' => self::getCondition() ? self::getCondition()->getId() : null,
            'scheduleId' => self::getSchedule()->getId()
        ];
    }

    public function setCondition(?ConditionalRoutesConditionInterface $condition = null): static
    {
        $this->condition = $condition;

        /** @var  $this */
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
