<?php

namespace Ivoz\Cgr\Domain\Model\TpDestination;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Destination\Destination;

/**
* TpDestinationInterface
*/
interface TpDestinationInterface extends LoggableEntityInterface
{

    public function getChangeSet();

    public function getTpid(): string;

    public function getTag(): ?string;

    public function getPrefix(): string;

    public function getCreatedAt(): \DateTime;

    public function setDestination(Destination $destination): static;

    public function getDestination(): Destination;

    public function isInitialized(): bool;
}
