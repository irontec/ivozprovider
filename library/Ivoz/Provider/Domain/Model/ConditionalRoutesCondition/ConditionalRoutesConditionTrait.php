<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist\ConditionalRoutesConditionsRelMatchlistInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule\ConditionalRoutesConditionsRelScheduleInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar\ConditionalRoutesConditionsRelCalendarInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock\ConditionalRoutesConditionsRelRouteLockInterface;

/**
* @codeCoverageIgnore
*/
trait ConditionalRoutesConditionTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * ConditionalRoutesConditionsRelMatchlistInterface mappedBy condition
     * orphanRemoval
     */
    protected $relMatchlists;

    /**
     * @var ArrayCollection
     * ConditionalRoutesConditionsRelScheduleInterface mappedBy condition
     * orphanRemoval
     */
    protected $relSchedules;

    /**
     * @var ArrayCollection
     * ConditionalRoutesConditionsRelCalendarInterface mappedBy condition
     * orphanRemoval
     */
    protected $relCalendars;

    /**
     * @var ArrayCollection
     * ConditionalRoutesConditionsRelRouteLockInterface mappedBy condition
     * orphanRemoval
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

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
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

        $self->sanitizeValues();
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ConditionalRoutesConditionDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
        $this->sanitizeValues();

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

    public function addRelMatchlist(ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist): ConditionalRoutesConditionInterface
    {
        $this->relMatchlists->add($relMatchlist);

        return $this;
    }

    public function removeRelMatchlist(ConditionalRoutesConditionsRelMatchlistInterface $relMatchlist): ConditionalRoutesConditionInterface
    {
        $this->relMatchlists->removeElement($relMatchlist);

        return $this;
    }

    public function replaceRelMatchlists(ArrayCollection $relMatchlists): ConditionalRoutesConditionInterface
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

    public function getRelMatchlists(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relMatchlists->matching($criteria)->toArray();
        }

        return $this->relMatchlists->toArray();
    }

    public function addRelSchedule(ConditionalRoutesConditionsRelScheduleInterface $relSchedule): ConditionalRoutesConditionInterface
    {
        $this->relSchedules->add($relSchedule);

        return $this;
    }

    public function removeRelSchedule(ConditionalRoutesConditionsRelScheduleInterface $relSchedule): ConditionalRoutesConditionInterface
    {
        $this->relSchedules->removeElement($relSchedule);

        return $this;
    }

    public function replaceRelSchedules(ArrayCollection $relSchedules): ConditionalRoutesConditionInterface
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

    public function getRelSchedules(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relSchedules->matching($criteria)->toArray();
        }

        return $this->relSchedules->toArray();
    }

    public function addRelCalendar(ConditionalRoutesConditionsRelCalendarInterface $relCalendar): ConditionalRoutesConditionInterface
    {
        $this->relCalendars->add($relCalendar);

        return $this;
    }

    public function removeRelCalendar(ConditionalRoutesConditionsRelCalendarInterface $relCalendar): ConditionalRoutesConditionInterface
    {
        $this->relCalendars->removeElement($relCalendar);

        return $this;
    }

    public function replaceRelCalendars(ArrayCollection $relCalendars): ConditionalRoutesConditionInterface
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

    public function getRelCalendars(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relCalendars->matching($criteria)->toArray();
        }

        return $this->relCalendars->toArray();
    }

    public function addRelRouteLock(ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock): ConditionalRoutesConditionInterface
    {
        $this->relRouteLocks->add($relRouteLock);

        return $this;
    }

    public function removeRelRouteLock(ConditionalRoutesConditionsRelRouteLockInterface $relRouteLock): ConditionalRoutesConditionInterface
    {
        $this->relRouteLocks->removeElement($relRouteLock);

        return $this;
    }

    public function replaceRelRouteLocks(ArrayCollection $relRouteLocks): ConditionalRoutesConditionInterface
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

    public function getRelRouteLocks(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relRouteLocks->matching($criteria)->toArray();
        }

        return $this->relRouteLocks->toArray();
    }
}
