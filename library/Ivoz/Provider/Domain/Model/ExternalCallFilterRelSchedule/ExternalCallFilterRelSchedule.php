<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule;

/**
 * ExternalCallFilterRelSchedule
 */
class ExternalCallFilterRelSchedule extends ExternalCallFilterRelScheduleAbstract implements ExternalCallFilterRelScheduleInterface
{
    use ExternalCallFilterRelScheduleTrait;

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
