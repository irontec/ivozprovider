<?php

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * TransformationRuleSetTrait
 * @codeCoverageIgnore
 */
trait TransformationRuleSetTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
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

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TransformationRuleSetDto
         */
        $self = parent::fromDto($dto);
        if ($dto->getRules()) {
            $self->replaceRules($dto->getRules());
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
         * @var $dto TransformationRuleSetDto
         */
        parent::updateFromDto($dto);
        if ($dto->getRules()) {
            $this->replaceRules($dto->getRules());
        }
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TransformationRuleSetDto
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
     * Add rule
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface $rule
     *
     * @return TransformationRuleSetTrait
     */
    public function addRule(\Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface $rule)
    {
        $this->rules->add($rule);

        return $this;
    }

    /**
     * Remove rule
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface $rule
     */
    public function removeRule(\Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface $rule)
    {
        $this->rules->removeElement($rule);
    }

    /**
     * Replace rules
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface[] $rules
     * @return self
     */
    public function replaceRules(Collection $rules)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($rules as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setTransformationRuleSet($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->rules as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->rules->set($key, $updatedEntities[$identity]);
            } else {
                $this->rules->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRule($entity);
        }

        return $this;
    }

    /**
     * Get rules
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface[]
     */
    public function getRules(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->rules->matching($criteria)->toArray();
        }

        return $this->rules->toArray();
    }
}
