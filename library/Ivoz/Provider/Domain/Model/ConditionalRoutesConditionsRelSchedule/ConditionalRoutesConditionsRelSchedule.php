<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule;

/**
 * ConditionalRoutesConditionsRelSchedule
 * @codeCoverageIgnore
 */
class ConditionalRoutesConditionsRelSchedule extends ConditionalRoutesConditionsRelScheduleAbstract
{
    use ConditionalRoutesConditionsRelScheduleTrait;

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

