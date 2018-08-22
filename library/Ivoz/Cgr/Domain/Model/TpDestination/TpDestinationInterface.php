<?php

namespace Ivoz\Cgr\Domain\Model\TpDestination;

use Ivoz\Core\Domain\Model\EntityInterface;

interface TpDestinationInterface extends EntityInterface
{
    /**
     * Set destination
     *
     * @param \Ivoz\Provider\Domain\Model\Destination\DestinationInterface | null $destination
     *
     * @return self
     */
    public function setDestination(\Ivoz\Provider\Domain\Model\Destination\DestinationInterface $destination = null);

    /**
     * Set routingPattern
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface | null $routingPattern
     *
     * @return self
     */
    public function setRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern = null);

    /**
     * Set tpid
     *
     * @param string $tpid
     *
     * @return self
     */
    public function setTpid($tpid);

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid();

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return self
     */
    public function setTag($tag = null);

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag();

    /**
     * Set prefix
     *
     * @param string $prefix
     *
     * @return self
     */
    public function setPrefix($prefix);

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix();

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt);

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Get destination
     *
     * @return \Ivoz\Provider\Domain\Model\Destination\DestinationInterface
     */
    public function getDestination();

    /**
     * Get routingPattern
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface
     */
    public function getRoutingPattern();

}

