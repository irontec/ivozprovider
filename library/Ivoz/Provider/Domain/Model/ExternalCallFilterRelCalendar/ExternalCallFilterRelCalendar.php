<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar;

/**
 * ExternalCallFilterRelCalendar
 */
class ExternalCallFilterRelCalendar extends ExternalCallFilterRelCalendarAbstract implements ExternalCallFilterRelCalendarInterface
{
    use ExternalCallFilterRelCalendarTrait;

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

