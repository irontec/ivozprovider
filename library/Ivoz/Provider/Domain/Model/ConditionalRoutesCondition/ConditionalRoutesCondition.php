<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

class ConditionalRoutesCondition extends ConditionalRoutesConditionAbstract implements ConditionalRoutesConditionInterface
{
    use ConditionalRoutesConditionTrait;

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

