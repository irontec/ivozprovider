<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelSchedule;

/**
 * ConditionalRoutesConditionsRelSchedule
 * @codeCoverageIgnore
 */
class ConditionalRoutesConditionsRelSchedule extends ConditionalRoutesConditionsRelScheduleAbstract implements ConditionalRoutesConditionsRelScheduleInterface
{
    use ConditionalRoutesConditionsRelScheduleTrait;

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
