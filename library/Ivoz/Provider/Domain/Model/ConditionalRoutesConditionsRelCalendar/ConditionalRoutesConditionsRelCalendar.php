<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar;

/**
 * ConditionalRoutesConditionsRelCalendar
 * @codeCoverageIgnore
 */
class ConditionalRoutesConditionsRelCalendar extends ConditionalRoutesConditionsRelCalendarAbstract
{
    use ConditionalRoutesConditionsRelCalendarTrait;

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

