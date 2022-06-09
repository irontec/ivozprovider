<?php

namespace Ivoz\Provider\Domain\Model\Calendar;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use DateTimeInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface;

/**
* CalendarInterface
*/
interface CalendarInterface extends LoggableEntityInterface
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

    /**
     * Check if the given day is registered as Holiday
     *
     * @param \DateTime $datetime
     * @return bool
     */
    public function isHolidayDate(DateTimeInterface $datetime);

    /**
     * Return the first HolidayDate matching the given date
     *
     * @param \DateTime $dateTime
     * @return \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface|null
     */
    public function getHolidayDate(DateTimeInterface $dateTime);

    public static function createDto(string|int|null $id = null): CalendarDto;

    /**
     * @internal use EntityTools instead
     * @param null|CalendarInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CalendarDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CalendarDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CalendarDto;

    public function getName(): string;

    public function getCompany(): CompanyInterface;

    public function isInitialized(): bool;

    public function addHolidayDate(HolidayDateInterface $holidayDate): CalendarInterface;

    public function removeHolidayDate(HolidayDateInterface $holidayDate): CalendarInterface;

    /**
     * @param Collection<array-key, HolidayDateInterface> $holidayDates
     */
    public function replaceHolidayDates(Collection $holidayDates): CalendarInterface;

    /**
     * @return array<array-key, HolidayDateInterface>
     */
    public function getHolidayDates(?Criteria $criteria = null): array;

    public function addCalendarPeriod(CalendarPeriodInterface $calendarPeriod): CalendarInterface;

    public function removeCalendarPeriod(CalendarPeriodInterface $calendarPeriod): CalendarInterface;

    /**
     * @param Collection<array-key, CalendarPeriodInterface> $calendarPeriods
     */
    public function replaceCalendarPeriods(Collection $calendarPeriods): CalendarInterface;

    /**
     * @return array<array-key, CalendarPeriodInterface>
     */
    public function getCalendarPeriods(?Criteria $criteria = null): array;
}
