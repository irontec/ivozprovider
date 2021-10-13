<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar;

/**
 * ConditionalRoutesConditionsRelCalendar
 * @codeCoverageIgnore
 */
class ConditionalRoutesConditionsRelCalendar extends ConditionalRoutesConditionsRelCalendarAbstract implements ConditionalRoutesConditionsRelCalendarInterface
{
    use ConditionalRoutesConditionsRelCalendarTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array
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
