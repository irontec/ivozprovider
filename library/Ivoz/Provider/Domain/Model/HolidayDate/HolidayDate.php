<?php

namespace Ivoz\Provider\Domain\Model\HolidayDate;

/**
 * HolidayDate
 */
class HolidayDate extends HolidayDateAbstract implements HolidayDateInterface
{
    use HolidayDateTrait;
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

