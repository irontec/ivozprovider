<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * ExternalCallFilterTrait
 * @codeCoverageIgnore
 */
trait ExternalCallFilterTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $calendars;

    /**
     * @var Collection
     */
    protected $blackLists;

    /**
     * @var Collection
     */
    protected $whiteLists;

    /**
     * @var Collection
     */
    protected $schedules;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->calendars = new ArrayCollection();
        $this->blackLists = new ArrayCollection();
        $this->whiteLists = new ArrayCollection();
        $this->schedules = new ArrayCollection();
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ExternalCallFilterDto
         */
        $self = parent::fromDto($dto);
        if ($dto->getCalendars()) {
            $self->replaceCalendars($dto->getCalendars());
        }

        if ($dto->getBlackLists()) {
            $self->replaceBlackLists($dto->getBlackLists());
        }

        if ($dto->getWhiteLists()) {
            $self->replaceWhiteLists($dto->getWhiteLists());
        }

        if ($dto->getSchedules()) {
            $self->replaceSchedules($dto->getSchedules());
        }
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ExternalCallFilterDto
         */
        parent::updateFromDto($dto);
        if ($dto->getCalendars()) {
            $this->replaceCalendars($dto->getCalendars());
        }
        if ($dto->getBlackLists()) {
            $this->replaceBlackLists($dto->getBlackLists());
        }
        if ($dto->getWhiteLists()) {
            $this->replaceWhiteLists($dto->getWhiteLists());
        }
        if ($dto->getSchedules()) {
            $this->replaceSchedules($dto->getSchedules());
        }
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ExternalCallFilterDto
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
     * Add calendar
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface $calendar
     *
     * @return ExternalCallFilterTrait
     */
    public function addCalendar(\Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface $calendar)
    {
        $this->calendars->add($calendar);

        return $this;
    }

    /**
     * Remove calendar
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface $calendar
     */
    public function removeCalendar(\Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface $calendar)
    {
        $this->calendars->removeElement($calendar);
    }

    /**
     * Replace calendars
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface[] $calendars
     * @return self
     */
    public function replaceCalendars(Collection $calendars)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($calendars as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setFilter($this);
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
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface[]
     */
    public function getCalendars(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->calendars->matching($criteria)->toArray();
        }

        return $this->calendars->toArray();
    }

    /**
     * Add blackList
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface $blackList
     *
     * @return ExternalCallFilterTrait
     */
    public function addBlackList(\Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface $blackList)
    {
        $this->blackLists->add($blackList);

        return $this;
    }

    /**
     * Remove blackList
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface $blackList
     */
    public function removeBlackList(\Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface $blackList)
    {
        $this->blackLists->removeElement($blackList);
    }

    /**
     * Replace blackLists
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface[] $blackLists
     * @return self
     */
    public function replaceBlackLists(Collection $blackLists)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($blackLists as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setFilter($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->blackLists as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->blackLists->set($key, $updatedEntities[$identity]);
            } else {
                $this->blackLists->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addBlackList($entity);
        }

        return $this;
    }

    /**
     * Get blackLists
     *
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface[]
     */
    public function getBlackLists(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->blackLists->matching($criteria)->toArray();
        }

        return $this->blackLists->toArray();
    }

    /**
     * Add whiteList
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface $whiteList
     *
     * @return ExternalCallFilterTrait
     */
    public function addWhiteList(\Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface $whiteList)
    {
        $this->whiteLists->add($whiteList);

        return $this;
    }

    /**
     * Remove whiteList
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface $whiteList
     */
    public function removeWhiteList(\Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface $whiteList)
    {
        $this->whiteLists->removeElement($whiteList);
    }

    /**
     * Replace whiteLists
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface[] $whiteLists
     * @return self
     */
    public function replaceWhiteLists(Collection $whiteLists)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($whiteLists as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setFilter($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->whiteLists as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->whiteLists->set($key, $updatedEntities[$identity]);
            } else {
                $this->whiteLists->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addWhiteList($entity);
        }

        return $this;
    }

    /**
     * Get whiteLists
     *
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface[]
     */
    public function getWhiteLists(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->whiteLists->matching($criteria)->toArray();
        }

        return $this->whiteLists->toArray();
    }

    /**
     * Add schedule
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface $schedule
     *
     * @return ExternalCallFilterTrait
     */
    public function addSchedule(\Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface $schedule)
    {
        $this->schedules->add($schedule);

        return $this;
    }

    /**
     * Remove schedule
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface $schedule
     */
    public function removeSchedule(\Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface $schedule)
    {
        $this->schedules->removeElement($schedule);
    }

    /**
     * Replace schedules
     *
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface[] $schedules
     * @return self
     */
    public function replaceSchedules(Collection $schedules)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($schedules as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setFilter($this);
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
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface[]
     */
    public function getSchedules(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->schedules->matching($criteria)->toArray();
        }

        return $this->schedules->toArray();
    }
}
