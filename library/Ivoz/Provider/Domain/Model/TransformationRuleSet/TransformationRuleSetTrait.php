<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\TransformationRule\TransformationRuleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait TransformationRuleSetTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
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

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TransformationRuleSetDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getRules())) {
            $self->replaceRules(
                $fkTransformer->transformCollection(
                    $dto->getRules()
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
     * @param TransformationRuleSetDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getRules())) {
            $this->replaceRules(
                $fkTransformer->transformCollection(
                    $dto->getRules()
                )
            );
        }
        $this->sanitizeValues();

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

    public function replaceRules(ArrayCollection $rules): TransformationRuleSetInterface
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

    public function getRules(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->rules->matching($criteria)->toArray();
        }

        return $this->rules->toArray();
    }

}
