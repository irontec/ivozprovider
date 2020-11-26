<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var CalendarPeriodInterface
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
    protected function __construct(

    ) {

    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "CalendarPeriodsRelSchedule",
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
     * @return CalendarPeriodsRelScheduleDto
     */
    public static function createDto($id = null)
    {
        return new CalendarPeriodsRelScheduleDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param CalendarPeriodsRelScheduleInterface|null $entity
     * @param int $depth
     * @return CalendarPeriodsRelScheduleDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var CalendarPeriodsRelScheduleDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CalendarPeriodsRelScheduleDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CalendarPeriodsRelScheduleDto::class);

        $self = new static(

        );

        $self
            ->setCalendarPeriod($fkTransformer->transform($dto->getCalendarPeriod()))
            ->setSchedule($fkTransformer->transform($dto->getSchedule()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CalendarPeriodsRelScheduleDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CalendarPeriodsRelScheduleDto::class);

        $this
            ->setCalendarPeriod($fkTransformer->transform($dto->getCalendarPeriod()))
            ->setSchedule($fkTransformer->transform($dto->getSchedule()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CalendarPeriodsRelScheduleDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCalendarPeriod(CalendarPeriod::entityToDto(self::getCalendarPeriod(), $depth))
            ->setSchedule(Schedule::entityToDto(self::getSchedule(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'calendarPeriodId' => self::getCalendarPeriod() ? self::getCalendarPeriod()->getId() : null,
            'scheduleId' => self::getSchedule()->getId()
        ];
    }

    /**
     * Set calendarPeriod
     *
     * @param CalendarPeriodInterface | null
     *
     * @return static
     */
    public function setCalendarPeriod(?CalendarPeriodInterface $calendarPeriod = null): CalendarPeriodsRelScheduleInterface
    {
        $this->calendarPeriod = $calendarPeriod;

        return $this;
    }

    /**
     * Get calendarPeriod
     *
     * @return CalendarPeriodInterface | null
     */
    public function getCalendarPeriod(): ?CalendarPeriodInterface
    {
        return $this->calendarPeriod;
    }

    /**
     * Set schedule
     *
     * @param ScheduleInterface
     *
     * @return static
     */
    protected function setSchedule(ScheduleInterface $schedule): CalendarPeriodsRelScheduleInterface
    {
        $this->schedule = $schedule;

        return $this;
    }

    /**
     * Get schedule
     *
     * @return ScheduleInterface
     */
    public function getSchedule(): ScheduleInterface
    {
        return $this->schedule;
    }

}
