<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule;

/**
 * ExternalCallFilterRelSchedule
 */
class ExternalCallFilterRelSchedule extends ExternalCallFilterRelScheduleAbstract implements ExternalCallFilterRelScheduleInterface
{
    use ExternalCallFilterRelScheduleTrait;

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

