<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

/**
 * TpDestinationRate
 */
class TpDestinationRate extends TpDestinationRateAbstract implements TpDestinationRateInterface
{
    use TpDestinationRateTrait;

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
