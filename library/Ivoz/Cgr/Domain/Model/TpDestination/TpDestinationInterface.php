<?php

namespace Ivoz\Cgr\Domain\Model\TpDestination;

use Ivoz\Core\Domain\Model\EntityInterface;

interface TpDestinationInterface extends EntityInterface
{
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
     * Set destination
     *
     * @param \Ivoz\Cgr\Domain\Model\Destination\DestinationInterface $destination
     *
     * @return self
     */
    public function setDestination(\Ivoz\Cgr\Domain\Model\Destination\DestinationInterface $destination = null);

    /**
     * Get destination
     *
     * @return \Ivoz\Cgr\Domain\Model\Destination\DestinationInterface
     */
    public function getDestination();

}

