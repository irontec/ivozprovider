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

    /**
     * Set destination
     *
     * @param \Ivoz\Provider\Domain\Model\Destination\DestinationInterface | null $destination
     *
     * @return self
     */
    public function setDestination(\Ivoz\Provider\Domain\Model\Destination\DestinationInterface $destination = null)
    {
        if (!is_null($destination)) {
            parent::setDestination($destination);
        }
        return $this;
    }

    /**
     * Set routingPattern
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface | null $routingPattern
     *
     * @return self
     */
    public function setRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern = null)
    {
        if (!is_null($routingPattern)) {
            parent::setRoutingPattern($routingPattern);
        }
        return $this;
    }
}

