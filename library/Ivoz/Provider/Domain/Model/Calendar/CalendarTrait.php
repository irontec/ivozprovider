<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Calendar;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface;

/**
* @codeCoverageIgnore
*/
trait CalendarTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, HolidayDateInterface> & Selectable<array-key, HolidayDateInterface>
     * HolidayDateInterface mappedBy calendar
     */
    protected $holidayDates;

    /**
     * @var Collection<array-key, CalendarPeriodInterface> & Selectable<array-key, CalendarPeriodInterface>
     * CalendarPeriodInterface mappedBy calendar
     */
    protected $calendarPeriods;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->holidayDates = new ArrayCollection();
        $this->calendarPeriods = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CalendarDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $holidayDates = $dto->getHolidayDates();
        if (!is_null($holidayDates)) {

            /** @var Collection<array-key, HolidayDateInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $holidayDates
            );
            $self->replaceHolidayDates($replacement);
        }

        $calendarPeriods = $dto->getCalendarPeriods();
        if (!is_null($calendarPeriods)) {

            /** @var Collection<array-key, CalendarPeriodInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $calendarPeriods
            );
            $self->replaceCalendarPeriods($replacement);
        }

        $self->sanitizeValues();
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CalendarDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $holidayDates = $dto->getHolidayDates();
        if (!is_null($holidayDates)) {

            /** @var Collection<array-key, HolidayDateInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $holidayDates
            );
            $this->replaceHolidayDates($replacement);
        }

        $calendarPeriods = $dto->getCalendarPeriods();
        if (!is_null($calendarPeriods)) {

            /** @var Collection<array-key, CalendarPeriodInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $calendarPeriods
            );
            $this->replaceCalendarPeriods($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CalendarDto
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    protected function __toArray(): array
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }

    public function addHolidayDate(HolidayDateInterface $holidayDate): CalendarInterface
    {
        $this->holidayDates->add($holidayDate);

        return $this;
    }

    public function removeHolidayDate(HolidayDateInterface $holidayDate): CalendarInterface
    {
        $this->holidayDates->removeElement($holidayDate);

        return $this;
    }

    /**
     * @param Collection<array-key, HolidayDateInterface> $holidayDates
     */
    public function replaceHolidayDates(Collection $holidayDates): CalendarInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($holidayDates as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCalendar($this);
        }

        foreach ($this->holidayDates as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->holidayDates->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->holidayDates->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->holidayDates->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addHolidayDate($entity);
        }

        return $this;
    }

    public function getHolidayDates(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->holidayDates->matching($criteria)->toArray();
        }

        return $this->holidayDates->toArray();
    }

    public function addCalendarPeriod(CalendarPeriodInterface $calendarPeriod): CalendarInterface
    {
        $this->calendarPeriods->add($calendarPeriod);

        return $this;
    }

    public function removeCalendarPeriod(CalendarPeriodInterface $calendarPeriod): CalendarInterface
    {
        $this->calendarPeriods->removeElement($calendarPeriod);

        return $this;
    }

    /**
     * @param Collection<array-key, CalendarPeriodInterface> $calendarPeriods
     */
    public function replaceCalendarPeriods(Collection $calendarPeriods): CalendarInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($calendarPeriods as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCalendar($this);
        }

        foreach ($this->calendarPeriods as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->calendarPeriods->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->calendarPeriods->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->calendarPeriods->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addCalendarPeriod($entity);
        }

        return $this;
    }

    public function getCalendarPeriods(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->calendarPeriods->matching($criteria)->toArray();
        }

        return $this->calendarPeriods->toArray();
    }
}
