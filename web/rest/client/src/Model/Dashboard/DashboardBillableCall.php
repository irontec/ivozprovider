<?php

namespace Model\Dashboard;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;

/**
 * @codeCoverageIgnore
 */
class DashboardBillableCall
{
    /**
     * @var \DateTime|null
     * @AttributeDefinition(type="string")
     */
    protected $startTime;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $caller;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $callee;

    /**
     * @var float
     * @AttributeDefinition(type="float")
     */
    protected $duration;

    private function __construct(
        ?\DateTime $startTime,
        string $caller,
        string $callee,
        float $duration,
    ) {
        $this->startTime = $startTime;
        $this->caller = $caller;
        $this->callee = $callee;
        $this->duration = $duration;
    }

    public static function fromBillableCall(BillableCall $billableCall): self
    {
        $caller = $billableCall->getCaller();
        $callee = $billableCall->getCallee();

        return new self(
            $billableCall->getStartTime(),
            $caller ?? '',
            $callee ?? '',
            $billableCall->getDuration()
        );
    }

    public function getStartTime(): ?\DateTime
    {
        return $this->startTime;
    }

    public function getCaller(): string
    {
        return $this->caller;
    }

    public function getCallee(): string
    {
        return $this->callee;
    }

    public function getDuration(): float
    {
        return $this->duration;
    }
}
