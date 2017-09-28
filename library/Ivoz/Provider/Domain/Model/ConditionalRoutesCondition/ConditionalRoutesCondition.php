<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

class ConditionalRoutesCondition extends ConditionalRoutesConditionAbstract implements ConditionalRoutesConditionInterface
{
    use ConditionalRoutesConditionTrait;

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

