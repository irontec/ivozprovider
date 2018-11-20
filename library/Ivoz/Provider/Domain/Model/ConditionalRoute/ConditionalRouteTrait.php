<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoute;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * ConditionalRouteTrait
 * @codeCoverageIgnore
 */
trait ConditionalRouteTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $conditions;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->conditions = new ArrayCollection();
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
         * @var $dto ConditionalRouteDto
         */
        $self = parent::fromDto($dto);
        if ($dto->getConditions()) {
            $self->replaceConditions($dto->getConditions());
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
         * @var $dto ConditionalRouteDto
         */
        parent::updateFromDto($dto);
        if ($dto->getConditions()) {
            $this->replaceConditions($dto->getConditions());
        }
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ConditionalRouteDto
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
     * Add condition
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface $condition
     *
     * @return ConditionalRouteTrait
     */
    public function addCondition(\Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface $condition)
    {
        $this->conditions->add($condition);

        return $this;
    }

    /**
     * Remove condition
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface $condition
     */
    public function removeCondition(\Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface $condition)
    {
        $this->conditions->removeElement($condition);
    }

    /**
     * Replace conditions
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface[] $conditions
     * @return self
     */
    public function replaceConditions(Collection $conditions)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($conditions as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setConditionalRoute($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->conditions as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->conditions->set($key, $updatedEntities[$identity]);
            } else {
                $this->conditions->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addCondition($entity);
        }

        return $this;
    }

    /**
     * Get conditions
     *
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface[]
     */
    public function getConditions(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->conditions->matching($criteria)->toArray();
        }

        return $this->conditions->toArray();
    }
}
