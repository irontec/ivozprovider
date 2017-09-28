<?php

namespace Ivoz\Provider\Domain\Model\Calendar;

/**
 * Calendar
 */
class Calendar extends CalendarAbstract implements CalendarInterface
{
    use CalendarTrait;

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

