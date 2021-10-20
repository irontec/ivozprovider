<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

/**
 * TpDestinationRate
 */
class TpDestinationRate extends TpDestinationRateAbstract implements TpDestinationRateInterface
{
    use TpDestinationRateTrait;

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
