<?php

namespace Ivoz\Provider\Domain\Model\TransformationRulesetGroupsTrunk;

/**
 * TransformationRulesetGroupsTrunk
 */
class TransformationRulesetGroupsTrunk extends TransformationRulesetGroupsTrunkAbstract implements TransformationRulesetGroupsTrunkInterface
{
    use TransformationRulesetGroupsTrunkTrait;

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

