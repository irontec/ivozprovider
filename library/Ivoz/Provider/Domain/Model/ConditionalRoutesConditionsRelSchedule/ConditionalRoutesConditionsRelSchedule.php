<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule;

/**
 * ConditionalRoutesConditionsRelSchedule
 * @codeCoverageIgnore
 */
class ConditionalRoutesConditionsRelSchedule extends ConditionalRoutesConditionsRelScheduleAbstract implements ConditionalRoutesConditionsRelScheduleInterface
{
    use ConditionalRoutesConditionsRelScheduleTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

