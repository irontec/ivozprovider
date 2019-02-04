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
     * @var Collection
     */
    protected $relRouteLocks;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->relMatchlists = new ArrayCollection();
        $this->relSchedules = new ArrayCollection();
        $this->relCalendars = new ArrayCollection();
        $this->relRouteLocks = new ArrayCollection();
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto ConditionalRoutesConditionDto
         */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getRelMatchlists())) {
            $self->replaceRelMatchlists(
                $fkTransformer->transformCollection(
                    $dto->getRelMatchlists()
                )
            );
        }

        if (!is_null($dto->getRelSchedules())) {
            $self->replaceRelSchedules(
                $fkTransformer->transformCollection(
                    $dto->getRelSchedules()
                )
            );
        }

        if (!is_null($dto->getRelCalendars())) {
            $self->replaceRelCalendars(
                $fkTransformer->transformCollection(
                    $dto->getRelCalendars()
                )
            );
        }

        if (!is_null($dto->getRelRouteLocks())) {
            $self->replaceRelRouteLocks(
                $fkTransformer->transformCollection(
                    $dto->getRelRouteLocks()
                )
            );
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
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto ConditionalRoutesConditionDto
         */
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getRelMatchlists())) {
            $this->replaceRelMatchlists(
                $fkTransformer->transformCollection(
                    $dto->getRelMatchlists()
                )
            );
        }
        if (!is_null($dto->getRelSchedules())) {
            $this->replaceRelSchedules(
                $fkTransformer->transformCollection(
                    $dto->getRelSchedules()
                )
            );
        }
        if (!is_null($dto->getRelCalendars())) {
            $this->replaceRelCalendars(
                $fkTransformer->transformCollection(
                    $dto->getRelCalendars()
                )
            );
        }
        if (!is_null($dto->getRelRouteLocks())) {
            $this->replaceRelRouteLocks(
                $fkTransformer->transformCollection(
                    $dto->getRelRouteLocks()
                )
            );
        }
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ConditionalRoutesConditionDto
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
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface[]
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
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface[]
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
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface[]
     */
    public function getRelCalendars(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relCalendars->matching($criteria)->toArray();
        }

        return $this->relCalendars->toArray();
    }

    /**
     * Add relRouteLock
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock
     *
     * @return ConditionalRoutesConditionTrait
     */
    public function addRelRouteLock(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock)
    {
        $this->relRouteLocks->add($relRouteLock);

        return $this;
    }

    /**
     * Remove relRouteLock
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock
     */
    public function removeRelRouteLock(\Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock)
    {
        $this->relRouteLocks->removeElement($relRouteLock);
    }

    /**
     * Replace relRouteLocks
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockInterface[] $relRouteLocks
     * @return self
     */
    public function replaceRelRouteLocks(Collection $relRouteLocks)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relRouteLocks as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCondition($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relRouteLocks as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relRouteLocks->set($key, $updatedEntities[$identity]);
            } else {
                $this->relRouteLocks->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelRouteLock($entity);
        }

        return $this;
    }

    /**
     * Get relRouteLocks
     *
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockInterface[]
     */
    public function getRelRouteLocks(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relRouteLocks->matching($criteria)->toArray();
        }

        return $this->relRouteLocks->toArray();
    }
}
