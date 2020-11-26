<?php

namespace Ivoz\Cgr\Domain\Model\TpDestination;

use Ivoz\Provider\Domain\Model\Destination\Destination;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* TpDestinationInterface
*/
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
    public function getTag(): ?string;

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix(): string;

    /**
     * Get createdAt
     *
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * Set destination
     *
     * @param Destination
     *
     * @return static
     */
    public function setDestination(Destination $destination): TpDestinationInterface;

    /**
     * Get destination
     *
     * @return Destination
     */
    public function getDestination(): Destination;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
