<?php

namespace Ivoz\Cgr\Domain\Model\TpDestination;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Destination\DestinationInterface;

/**
* TpDestinationInterface
*/
interface TpDestinationInterface extends LoggableEntityInterface
{

    public function getChangeSet(): array;

    public function getTpid(): string;

    public function getTag(): ?string;

    public function getPrefix(): string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeInterface;

    public function setDestination(DestinationInterface $destination): static;

    public function getDestination(): DestinationInterface;

    public function isInitialized(): bool;
}
