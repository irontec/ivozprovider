<?php

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

/**
 * TransformationRuleSet
 */
class TransformationRuleSet extends TransformationRuleSetAbstract implements TransformationRuleSetInterface
{
    use TransformationRuleSetTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

