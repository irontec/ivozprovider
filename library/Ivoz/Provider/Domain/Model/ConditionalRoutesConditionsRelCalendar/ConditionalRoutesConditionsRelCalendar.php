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
     * @return array<string, mixed>
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
    public function getId(): ?int
    {
        return $this->id;
    }
}
