<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar;

/**
 * ExternalCallFilterRelCalendar
 */
class ExternalCallFilterRelCalendar extends ExternalCallFilterRelCalendarAbstract implements ExternalCallFilterRelCalendarInterface
{
    use ExternalCallFilterRelCalendarTrait;

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
    public function getId(): ?int
    {
        return $this->id;
    }
}
