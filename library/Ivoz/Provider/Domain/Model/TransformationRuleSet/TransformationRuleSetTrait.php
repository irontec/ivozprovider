<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait TransformationRuleSetTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, TransformationRuleInterface> & Selectable<array-key, TransformationRuleInterface>
     * TransformationRuleInterface mappedBy transformationRuleSet
     */
    protected $rules;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->rules = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TransformationRuleSetDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $rules = $dto->getRules();
        if (!is_null($rules)) {

            /** @var Collection<array-key, TransformationRuleInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $rules
            );
            $self->replaceRules($replacement);
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
     * @param TransformationRuleSetDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $rules = $dto->getRules();
        if (!is_null($rules)) {

            /** @var Collection<array-key, TransformationRuleInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $rules
            );
            $this->replaceRules($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TransformationRuleSetDto
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }

    public function addRule(TransformationRuleInterface $rule): TransformationRuleSetInterface
    {
        $this->rules->add($rule);

        return $this;
    }

    public function removeRule(TransformationRuleInterface $rule): TransformationRuleSetInterface
    {
        $this->rules->removeElement($rule);

        return $this;
    }

    /**
     * @param Collection<array-key, TransformationRuleInterface> $rules
     */
    public function replaceRules(Collection $rules): TransformationRuleSetInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($rules as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setTransformationRuleSet($this);
        }

        foreach ($this->rules as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->rules->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->rules->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->rules->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addRule($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, TransformationRuleInterface>
     */
    public function getRules(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->rules->matching($criteria)->toArray();
        }

        return $this->rules->toArray();
    }
}
