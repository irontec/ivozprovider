<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist;

class ConditionalRoutesConditionsRelMatchlist extends ConditionalRoutesConditionsRelMatchlistAbstract implements ConditionalRoutesConditionsRelMatchlistInterface
{
    use ConditionalRoutesConditionsRelMatchlistTrait;

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

