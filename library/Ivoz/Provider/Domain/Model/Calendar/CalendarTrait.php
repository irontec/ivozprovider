<?php

namespace Ivoz\Provider\Domain\Model\Calendar;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * CalendarTrait
 * @codeCoverageIgnore
 */
trait CalendarTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    protected $holidayDates;

    /**
     * @var ArrayCollection
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
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
    /**
     * Add holidayDate
     *
     * @param \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface $holidayDate
     *
     * @return static
     */
    public function addHolidayDate(\Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface $holidayDate)
    {
        $this->holidayDates->add($holidayDate);

        return $this;
    }

    /**
     * Remove holidayDate
     *
     * @param \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface $holidayDate
     */
    public function removeHolidayDate(\Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface $holidayDate)
    {
        $this->holidayDates->removeElement($holidayDate);
    }

    /**
     * Replace holidayDates
     *
     * @param ArrayCollection $holidayDates of Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface
     * @return static
     */
    public function replaceHolidayDates(ArrayCollection $holidayDates)
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

    /**
     * Get holidayDates
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface[]
     */
    public function getHolidayDates(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->holidayDates->matching($criteria)->toArray();
        }

        return $this->holidayDates->toArray();
    }

    /**
     * Add calendarPeriod
     *
     * @param \Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface $calendarPeriod
     *
     * @return static
     */
    public function addCalendarPeriod(\Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface $calendarPeriod)
    {
        $this->calendarPeriods->add($calendarPeriod);

        return $this;
    }

    /**
     * Remove calendarPeriod
     *
     * @param \Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface $calendarPeriod
     */
    public function removeCalendarPeriod(\Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface $calendarPeriod)
    {
        $this->calendarPeriods->removeElement($calendarPeriod);
    }

    /**
     * Replace calendarPeriods
     *
     * @param ArrayCollection $calendarPeriods of Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface
     * @return static
     */
    public function replaceCalendarPeriods(ArrayCollection $calendarPeriods)
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

    /**
     * Get calendarPeriods
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface[]
     */
    public function getCalendarPeriods(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->calendarPeriods->matching($criteria)->toArray();
        }

        return $this->calendarPeriods->toArray();
    }
}
