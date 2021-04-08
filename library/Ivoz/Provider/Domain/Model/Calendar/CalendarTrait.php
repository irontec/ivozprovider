<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Calendar;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface;

/**
* @codeCoverageIgnore
*/
trait CalendarTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * HolidayDateInterface mappedBy calendar
     */
    protected $holidayDates;

    /**
     * @var ArrayCollection
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

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CalendarDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getHolidayDates())) {
            $self->replaceHolidayDates(
                $fkTransformer->transformCollection(
                    $dto->getHolidayDates()
                )
            );
        }

        if (!is_null($dto->getCalendarPeriods())) {
            $self->replaceCalendarPeriods(
                $fkTransformer->transformCollection(
                    $dto->getCalendarPeriods()
                )
            );
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
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getHolidayDates())) {
            $this->replaceHolidayDates(
                $fkTransformer->transformCollection(
                    $dto->getHolidayDates()
                )
            );
        }

        if (!is_null($dto->getCalendarPeriods())) {
            $this->replaceCalendarPeriods(
                $fkTransformer->transformCollection(
                    $dto->getCalendarPeriods()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CalendarDto
     */
    public function toDto($depth = 0)
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array
     */
    protected function __toArray()
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

    public function replaceHolidayDates(ArrayCollection $holidayDates): CalendarInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($holidayDates as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCalendar($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->holidayDates as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->holidayDates->set($key, $updatedEntities[$identity]);
            } else {
                $this->holidayDates->remove($key);
            }
            unset($updatedEntities[$identity]);
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

    public function replaceCalendarPeriods(ArrayCollection $calendarPeriods): CalendarInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($calendarPeriods as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCalendar($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->calendarPeriods as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->calendarPeriods->set($key, $updatedEntities[$identity]);
            } else {
                $this->calendarPeriods->remove($key);
            }
            unset($updatedEntities[$identity]);
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
