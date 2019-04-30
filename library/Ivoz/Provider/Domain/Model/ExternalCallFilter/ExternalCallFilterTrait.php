<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @var ArrayCollection
     */
    protected $calendars;

    /**
     * @var ArrayCollection
     */
    protected $blackLists;

    /**
     * @var ArrayCollection
     */
    protected $whiteLists;

    /**
     * @var ArrayCollection
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

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ExternalCallFilterDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getCalendars())) {
            $self->replaceCalendars(
                $fkTransformer->transformCollection(
                    $dto->getCalendars()
                )
            );
        }

        if (!is_null($dto->getBlackLists())) {
            $self->replaceBlackLists(
                $fkTransformer->transformCollection(
                    $dto->getBlackLists()
                )
            );
        }

        if (!is_null($dto->getWhiteLists())) {
            $self->replaceWhiteLists(
                $fkTransformer->transformCollection(
                    $dto->getWhiteLists()
                )
            );
        }

        if (!is_null($dto->getSchedules())) {
            $self->replaceSchedules(
                $fkTransformer->transformCollection(
                    $dto->getSchedules()
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
     * @param ExternalCallFilterDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getCalendars())) {
            $this->replaceCalendars(
                $fkTransformer->transformCollection(
                    $dto->getCalendars()
                )
            );
        }
        if (!is_null($dto->getBlackLists())) {
            $this->replaceBlackLists(
                $fkTransformer->transformCollection(
                    $dto->getBlackLists()
                )
            );
        }
        if (!is_null($dto->getWhiteLists())) {
            $this->replaceWhiteLists(
                $fkTransformer->transformCollection(
                    $dto->getWhiteLists()
                )
            );
        }
        if (!is_null($dto->getSchedules())) {
            $this->replaceSchedules(
                $fkTransformer->transformCollection(
                    $dto->getSchedules()
                )
            );
        }
        $this->sanitizeValues();

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
     * @return static
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
     * @param ArrayCollection $calendars of Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar\ExternalCallFilterRelCalendarInterface
     * @return static
     */
    public function replaceCalendars(ArrayCollection $calendars)
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
     * @param Criteria | null $criteria
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
     * @return static
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
     * @param ArrayCollection $blackLists of Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList\ExternalCallFilterBlackListInterface
     * @return static
     */
    public function replaceBlackLists(ArrayCollection $blackLists)
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
     * @param Criteria | null $criteria
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
     * @return static
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
     * @param ArrayCollection $whiteLists of Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList\ExternalCallFilterWhiteListInterface
     * @return static
     */
    public function replaceWhiteLists(ArrayCollection $whiteLists)
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
     * @param Criteria | null $criteria
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
     * @return static
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
     * @param ArrayCollection $schedules of Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule\ExternalCallFilterRelScheduleInterface
     * @return static
     */
    public function replaceSchedules(ArrayCollection $schedules)
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
     * @param Criteria | null $criteria
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
