<?php

namespace Ivoz\Provider\Domain\Model\Calendar;

/**
 * Calendar
 */
class Calendar extends CalendarAbstract implements CalendarInterface
{
    use CalendarTrait;

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

