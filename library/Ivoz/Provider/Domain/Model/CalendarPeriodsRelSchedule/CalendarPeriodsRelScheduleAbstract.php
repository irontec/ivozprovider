<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * CalendarPeriodsRelScheduleAbstract
 * @codeCoverageIgnore
 */
abstract class CalendarPeriodsRelScheduleAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface | null
     */
    protected $calendarPeriod;

    /**
     * @var \Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface
     */
    protected $schedule;


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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CalendarPeriodsRelScheduleDto::class);

        $self = new static();

        $self
            ->setCalendarPeriod($fkTransformer->transform($dto->getCalendarPeriod()))
            ->setSchedule($fkTransformer->transform($dto->getSchedule()))
        ;

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setCalendarPeriod(\Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriod::entityToDto(self::getCalendarPeriod(), $depth))
            ->setSchedule(\Ivoz\Provider\Domain\Model\Schedule\Schedule::entityToDto(self::getSchedule(), $depth));
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
    // @codeCoverageIgnoreStart

    /**
     * Set calendarPeriod
     *
     * @param \Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface $calendarPeriod | null
     *
     * @return static
     */
    public function setCalendarPeriod(\Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface $calendarPeriod = null)
    {
        $this->calendarPeriod = $calendarPeriod;

        return $this;
    }

    /**
     * Get calendarPeriod
     *
     * @return \Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface | null
     */
    public function getCalendarPeriod()
    {
        return $this->calendarPeriod;
    }

    /**
     * Set schedule
     *
     * @param \Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface $schedule
     *
     * @return static
     */
    protected function setSchedule(\Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface $schedule)
    {
        $this->schedule = $schedule;

        return $this;
    }

    /**
     * Get schedule
     *
     * @return \Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface
     */
    public function getSchedule()
    {
        return $this->schedule;
    }

    // @codeCoverageIgnoreEnd
}
