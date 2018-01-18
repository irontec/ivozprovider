<?php

namespace Ivoz\Cgr\Domain\Model\Destination;

/**
 * Destination
 */
class Destination extends DestinationAbstract implements DestinationInterface
{
    use DestinationTrait;

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

