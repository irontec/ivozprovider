<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ConditionalRoute;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait ConditionalRouteTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, ConditionalRoutesConditionInterface> & Selectable<array-key, ConditionalRoutesConditionInterface>
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

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ConditionalRouteDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $conditions = $dto->getConditions();
        if (!is_null($conditions)) {

            /** @var Collection<array-key, ConditionalRoutesConditionInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $conditions
            );
            $self->replaceConditions($replacement);
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
     * @param ConditionalRouteDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $conditions = $dto->getConditions();
        if (!is_null($conditions)) {

            /** @var Collection<array-key, ConditionalRoutesConditionInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $conditions
            );
            $this->replaceConditions($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ConditionalRouteDto
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

    /**
     * @param Collection<array-key, ConditionalRoutesConditionInterface> $conditions
     */
    public function replaceConditions(Collection $conditions): ConditionalRouteInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($conditions as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setConditionalRoute($this);
        }

        foreach ($this->conditions as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->conditions->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->conditions->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->conditions->remove($key);
            }
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
