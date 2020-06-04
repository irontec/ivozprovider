<?php

namespace Model;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/**
 * @codeCoverageIgnore
 */
class RegistrationSummary
{
    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $active;

    /**
     * @var integer
     * @AttributeDefinition(type="int")
     */
    protected $total;

    /**
     * @var float
     * @AttributeDefinition(type="int")
     */
    protected $percent = 0;

    public function __construct(
        int $active,
        int $total
    ) {
        $this->setActive($active);
        $this->setTotal($total);

        if ($total > 0) {
            $this->setPercent(
                round($active / $total * 100, 0)
            );
        }
    }

    /**
     * @return int
     */
    public function getActive(): int
    {
        return $this->active;
    }

    private function setActive(int $active): RegistrationSummary
    {
        $this->active = $active;

        return $this;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    private function setTotal(int $total): RegistrationSummary
    {
        $this->total = $total;

        return $this;
    }

    public function getPercent(): float
    {
        return $this->percent;
    }

    private function setPercent(float $percent): RegistrationSummary
    {
        $this->percent = $percent;

        return $this;
    }
}
