<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRule;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * OutgoingDdiRuleTrait
 * @codeCoverageIgnore
 */
trait OutgoingDdiRuleTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $patterns;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->patterns = new ArrayCollection();
    }

    /**
     * @return OutgoingDdiRuleDTO
     */
    public static function createDTO()
    {
        return new OutgoingDdiRuleDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto OutgoingDdiRuleDTO
         */
        $self = parent::fromDTO($dto);
        if ($dto->getPatterns()) {
            $self->replacePatterns($dto->getPatterns());
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
         * @var $dto OutgoingDdiRuleDTO
         */
        parent::updateFromDTO($dto);
        if ($dto->getPatterns()) {
            $this->replacePatterns($dto->getPatterns());
        }
        return $this;
    }

    /**
     * @return OutgoingDdiRuleDTO
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
            'id' => $this->getId()
        ];
    }


    /**
     * Add pattern
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface $pattern
     *
     * @return OutgoingDdiRuleTrait
     */
    public function addPattern(\Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface $pattern)
    {
        $this->patterns->add($pattern);

        return $this;
    }

    /**
     * Remove pattern
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface $pattern
     */
    public function removePattern(\Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface $pattern)
    {
        $this->patterns->removeElement($pattern);
    }

    /**
     * Replace patterns
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface[] $patterns
     * @return self
     */
    public function replacePatterns(Collection $patterns)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($patterns as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setOutgoingDdiRule($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->patterns as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->patterns->set($key, $updatedEntities[$identity]);
            } else {
                $this->patterns->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addPattern($entity);
        }

        return $this;
    }

    /**
     * Get patterns
     *
     * @return array
     */
    public function getPatterns(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->patterns->matching($criteria)->toArray();
        }

        return $this->patterns->toArray();
    }


}

