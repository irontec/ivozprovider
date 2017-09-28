<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist;

class ConditionalRoutesConditionsRelMatchlist extends ConditionalRoutesConditionsRelMatchlistAbstract implements ConditionalRoutesConditionsRelMatchlistInterface
{
    use ConditionalRoutesConditionsRelMatchlistTrait;

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

