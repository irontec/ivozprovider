<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ConditionalRoute;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait ConditionalRouteTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * ConditionalRoutesConditionInterface mappedBy conditionalRoute
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

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getConditions())) {
            $self->replaceConditions(
                $fkTransformer->transformCollection(
                    $dto->getConditions()
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getConditions())) {
            $this->replaceConditions(
                $fkTransformer->transformCollection(
                    $dto->getConditions()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): ConditionalRouteDto
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

    public function addCondition(ConditionalRoutesConditionInterface $condition): ConditionalRouteInterface
    {
        $this->conditions->add($condition);

        return $this;
    }

    public function removeCondition(ConditionalRoutesConditionInterface $condition): ConditionalRouteInterface
    {
        $this->conditions->removeElement($condition);

        return $this;
    }

    public function replaceConditions(ArrayCollection $conditions): ConditionalRouteInterface
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

    public function getConditions(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->conditions->matching($criteria)->toArray();
        }

        return $this->conditions->toArray();
    }
}
