<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * ConditionalRoutesConditionTrait
 * @codeCoverageIgnore
 */
trait ConditionalRoutesConditionTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $matchlists;

    /**
     * @var Collection
     */
    protected $schedules;

    /**
     * @var Collection
     */
    protected $calendars;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->matchlists = new ArrayCollection();
        $this->schedules = new ArrayCollection();
        $this->calendars = new ArrayCollection();
    }

    /**
     * @return ConditionalRoutesConditionDTO
     */
    public static function createDTO()
    {
        return new ConditionalRoutesConditionDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ConditionalRoutesConditionDTO
         */
        $self = parent::fromDTO($dto);
        if ($dto->getMatchlists()) {
            $self->replaceMatchlists($dto->getMatchlists());
        }

        if ($dto->getSchedules()) {
            $self->replaceSchedules($dto->getSchedules());
        }

        if ($dto->getCalendars()) {
            $self->replaceCalendars($dto->getCalendars());
        }
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ConditionalRoutesConditionDTO
         */
        parent::updateFromDTO($dto);
        if ($dto->getMatchlists()) {
            $this->replaceMatchlists($dto->getMatchlists());
        }
        if ($dto->getSchedules()) {
            $this->replaceSchedules($dto->getSchedules());
        }
        if ($dto->getCalendars()) {
            $this->replaceCalendars($dto->getCalendars());
        }
        return $this;
    }

    /**
     * @return ConditionalRoutesConditionDTO
     */
    public function toDTO()
    {
        $dto = parent::toDTO();
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
     * Add matchlist
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface $matchlist
     *
     * @return ConditionalRoutesConditionTrait
     */
    public function addMatchlist(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface $matchlist)
    {
        $this->matchlists->add($matchlist);

        return $this;
    }

    /**
     * Remove matchlist
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface $matchlist
     */
    public function removeMatchlist(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface $matchlist)
    {
        $this->matchlists->removeElement($matchlist);
    }

    /**
     * Replace matchlists
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface[] $matchlists
     * @return self
     */
    public function replaceMatchlists(Collection $matchlists)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($matchlists as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCondition($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->matchlists as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->matchlists->set($key, $updatedEntities[$identity]);
            } else {
                $this->matchlists->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addMatchlist($entity);
        }

        return $this;
    }

    /**
     * Get matchlists
     *
     * @return array
     */
    public function getMatchlists(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->matchlists->matching($criteria)->toArray();
        }

        return $this->matchlists->toArray();
    }

    /**
     * Add schedule
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface $schedule
     *
     * @return ConditionalRoutesConditionTrait
     */
    public function addSchedule(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface $schedule)
    {
        $this->schedules->add($schedule);

        return $this;
    }

    /**
     * Remove schedule
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface $schedule
     */
    public function removeSchedule(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface $schedule)
    {
        $this->schedules->removeElement($schedule);
    }

    /**
     * Replace schedules
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface[] $schedules
     * @return self
     */
    public function replaceSchedules(Collection $schedules)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($schedules as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCondition($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->schedules as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->schedules->set($key, $updatedEntities[$identity]);
            } else {
                $this->schedules->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addSchedule($entity);
        }

        return $this;
    }

    /**
     * Get schedules
     *
     * @return array
     */
    public function getSchedules(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->schedules->matching($criteria)->toArray();
        }

        return $this->schedules->toArray();
    }

    /**
     * Add calendar
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface $calendar
     *
     * @return ConditionalRoutesConditionTrait
     */
    public function addCalendar(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface $calendar)
    {
        $this->calendars->add($calendar);

        return $this;
    }

    /**
     * Remove calendar
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface $calendar
     */
    public function removeCalendar(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface $calendar)
    {
        $this->calendars->removeElement($calendar);
    }

    /**
     * Replace calendars
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface[] $calendars
     * @return self
     */
    public function replaceCalendars(Collection $calendars)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($calendars as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCondition($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->calendars as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->calendars->set($key, $updatedEntities[$identity]);
            } else {
                $this->calendars->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addCalendar($entity);
        }

        return $this;
    }

    /**
     * Get calendars
     *
     * @return array
     */
    public function getCalendars(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->calendars->matching($criteria)->toArray();
        }

        return $this->calendars->toArray();
    }


}

