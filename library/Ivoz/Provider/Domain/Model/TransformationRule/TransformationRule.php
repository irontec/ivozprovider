<?php

namespace Ivoz\Provider\Domain\Model\TransformationRule;

/**
 * TransformationRule
 */
class TransformationRule extends TransformationRuleAbstract implements TransformationRuleInterface
{
    use TransformationRuleTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

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

