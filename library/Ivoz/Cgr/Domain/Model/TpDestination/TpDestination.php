<?php

namespace Ivoz\Cgr\Domain\Model\TpDestination;

/**
 * TpDestination
 */
class TpDestination extends TpDestinationAbstract implements TpDestinationInterface
{
    use TpDestinationTrait;

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
