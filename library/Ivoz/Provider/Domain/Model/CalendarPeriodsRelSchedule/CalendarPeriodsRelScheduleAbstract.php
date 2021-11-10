<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface;
use Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriod;
use Ivoz\Provider\Domain\Model\Schedule\Schedule;

/**
* CalendarPeriodsRelScheduleAbstract
* @codeCoverageIgnore
*/
abstract class CalendarPeriodsRelScheduleAbstract
{
    use ChangelogTrait;

    /**
     * @var CalendarPeriodInterface | null
     * inversedBy relSchedules
     */
    protected $calendarPeriod;

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
            "CalendarPeriodsRelSchedule",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): CalendarPeriodsRelScheduleDto
    {
        return new CalendarPeriodsRelScheduleDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|CalendarPeriodsRelScheduleInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CalendarPeriodsRelScheduleDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CalendarPeriodsRelScheduleInterface::class);

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
     * @param CalendarPeriodsRelScheduleDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CalendarPeriodsRelScheduleDto::class);

        $self = new static();

        $self
            ->setCalendarPeriod($fkTransformer->transform($dto->getCalendarPeriod()))
            ->setSchedule($fkTransformer->transform($dto->getSchedule()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CalendarPeriodsRelScheduleDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CalendarPeriodsRelScheduleDto::class);

        $this
            ->setCalendarPeriod($fkTransformer->transform($dto->getCalendarPeriod()))
            ->setSchedule($fkTransformer->transform($dto->getSchedule()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CalendarPeriodsRelScheduleDto
    {
        return self::createDto()
            ->setCalendarPeriod(CalendarPeriod::entityToDto(self::getCalendarPeriod(), $depth))
            ->setSchedule(Schedule::entityToDto(self::getSchedule(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'calendarPeriodId' => self::getCalendarPeriod() ? self::getCalendarPeriod()->getId() : null,
            'scheduleId' => self::getSchedule()->getId()
        ];
    }

    public function setCalendarPeriod(?CalendarPeriodInterface $calendarPeriod = null): static
    {
        $this->calendarPeriod = $calendarPeriod;

        return $this;
    }

    public function getCalendarPeriod(): ?CalendarPeriodInterface
    {
        return $this->calendarPeriod;
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
