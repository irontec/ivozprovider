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
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->rules = new ArrayCollection();
    }

    /**
     * @return TransformationRuleSetDTO
     */
    public static function createDTO()
    {
        return new TransformationRuleSetDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TransformationRuleSetDTO
         */
        $self = parent::fromDTO($dto);
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
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TransformationRuleSetDTO
         */
        parent::updateFromDTO($dto);
        if ($dto->getRules()) {
            $this->replaceRules($dto->getRules());
        }
        return $this;
    }

    /**
     * @return TransformationRuleSetDTO
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
     * @return array
     */
    public function getRules(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->rules->matching($criteria)->toArray();
        }

        return $this->rules->toArray();
    }


}

