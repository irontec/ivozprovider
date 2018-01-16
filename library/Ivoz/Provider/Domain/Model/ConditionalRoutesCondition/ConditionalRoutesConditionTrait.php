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
    protected $relMatchlists;

    /**
     * @var Collection
     */
    protected $relSchedules;

    /**
     * @var Collection
     */
    protected $relCalendars;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->relMatchlists = new ArrayCollection();
        $this->relSchedules = new ArrayCollection();
        $this->relCalendars = new ArrayCollection();
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
        if ($dto->getRelMatchlists()) {
            $self->replaceRelMatchlists($dto->getRelMatchlists());
        }

        if ($dto->getRelSchedules()) {
            $self->replaceRelSchedules($dto->getRelSchedules());
        }

        if ($dto->getRelCalendars()) {
            $self->replaceRelCalendars($dto->getRelCalendars());
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
        if ($dto->getRelMatchlists()) {
            $this->replaceRelMatchlists($dto->getRelMatchlists());
        }
        if ($dto->getRelSchedules()) {
            $this->replaceRelSchedules($dto->getRelSchedules());
        }
        if ($dto->getRelCalendars()) {
            $this->replaceRelCalendars($dto->getRelCalendars());
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
     * Add relMatchlist
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist
     *
     * @return ConditionalRoutesConditionTrait
     */
    public function addRelMatchlist(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist)
    {
        $this->relMatchlists->add($relMatchlist);

        return $this;
    }

    /**
     * Remove relMatchlist
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist
     */
    public function removeRelMatchlist(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist)
    {
        $this->relMatchlists->removeElement($relMatchlist);
    }

    /**
     * Replace relMatchlists
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface[] $relMatchlists
     * @return self
     */
    public function replaceRelMatchlists(Collection $relMatchlists)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relMatchlists as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCondition($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relMatchlists as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relMatchlists->set($key, $updatedEntities[$identity]);
            } else {
                $this->relMatchlists->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelMatchlist($entity);
        }

        return $this;
    }

    /**
     * Get relMatchlists
     *
     * @return array
     */
    public function getRelMatchlists(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relMatchlists->matching($criteria)->toArray();
        }

        return $this->relMatchlists->toArray();
    }

    /**
     * Add relSchedule
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface $relSchedule
     *
     * @return ConditionalRoutesConditionTrait
     */
    public function addRelSchedule(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface $relSchedule)
    {
        $this->relSchedules->add($relSchedule);

        return $this;
    }

    /**
     * Remove relSchedule
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface $relSchedule
     */
    public function removeRelSchedule(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface $relSchedule)
    {
        $this->relSchedules->removeElement($relSchedule);
    }

    /**
     * Replace relSchedules
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface[] $relSchedules
     * @return self
     */
    public function replaceRelSchedules(Collection $relSchedules)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relSchedules as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCondition($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relSchedules as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relSchedules->set($key, $updatedEntities[$identity]);
            } else {
                $this->relSchedules->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelSchedule($entity);
        }

        return $this;
    }

    /**
     * Get relSchedules
     *
     * @return array
     */
    public function getRelSchedules(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relSchedules->matching($criteria)->toArray();
        }

        return $this->relSchedules->toArray();
    }

    /**
     * Add relCalendar
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface $relCalendar
     *
     * @return ConditionalRoutesConditionTrait
     */
    public function addRelCalendar(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface $relCalendar)
    {
        $this->relCalendars->add($relCalendar);

        return $this;
    }

    /**
     * Remove relCalendar
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface $relCalendar
     */
    public function removeRelCalendar(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface $relCalendar)
    {
        $this->relCalendars->removeElement($relCalendar);
    }

    /**
     * Replace relCalendars
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface[] $relCalendars
     * @return self
     */
    public function replaceRelCalendars(Collection $relCalendars)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relCalendars as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCondition($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relCalendars as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relCalendars->set($key, $updatedEntities[$identity]);
            } else {
                $this->relCalendars->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelCalendar($entity);
        }

        return $this;
    }

    /**
     * Get relCalendars
     *
     * @return array
     */
    public function getRelCalendars(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relCalendars->matching($criteria)->toArray();
        }

        return $this->relCalendars->toArray();
    }


}

