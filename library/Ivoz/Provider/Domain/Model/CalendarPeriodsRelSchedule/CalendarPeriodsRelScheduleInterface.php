<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface;
use Ivoz\Provider\Domain\Model\Schedule\ScheduleInterface;

/**
* CalendarPeriodsRelScheduleInterface
*/
interface CalendarPeriodsRelScheduleInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): CalendarPeriodsRelScheduleDto;

    /**
     * @internal use EntityTools instead
     * @param null|CalendarPeriodsRelScheduleInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CalendarPeriodsRelScheduleDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CalendarPeriodsRelScheduleDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CalendarPeriodsRelScheduleDto;

    public function setCalendarPeriod(?CalendarPeriodInterface $calendarPeriod = null): static;

    public function getCalendarPeriod(): ?CalendarPeriodInterface;

    public function getSchedule(): ScheduleInterface;
}
