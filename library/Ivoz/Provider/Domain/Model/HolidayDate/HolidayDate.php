<?php

namespace Ivoz\Provider\Domain\Model\HolidayDate;

/**
 * HolidayDate
 */
class HolidayDate extends HolidayDateAbstract implements HolidayDateInterface
{
    use HolidayDateTrait;

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
