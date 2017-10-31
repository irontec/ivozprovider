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

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164()
    {
        return
            $this->getNumberCountry()->getCountryCode() .
            $this->getNumberValue();
    }
}

