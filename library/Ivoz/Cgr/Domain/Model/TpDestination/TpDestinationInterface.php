<?php

namespace Ivoz\Cgr\Domain\Model\TpDestination;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface TpDestinationInterface extends LoggableEntityInterface
{
    public function getChangeSet();

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid(): string;

    /**
     * Get tag
     *
     * @return string | null
     */
    public function getTag();

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix(): string;

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime;

    /**
     * Set destination
     *
     * @param \Ivoz\Provider\Domain\Model\Destination\DestinationInterface $destination
     *
     * @return static
     */
    public function setDestination(\Ivoz\Provider\Domain\Model\Destination\DestinationInterface $destination);

    /**
     * Get destination
     *
     * @return \Ivoz\Provider\Domain\Model\Destination\DestinationInterface
     */
    public function getDestination();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
