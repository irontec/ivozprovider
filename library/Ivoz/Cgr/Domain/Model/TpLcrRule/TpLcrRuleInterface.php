<?php

namespace Ivoz\Cgr\Domain\Model\TpLcrRule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

/**
* TpLcrRuleInterface
*/
interface TpLcrRuleInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    public function getTpid(): string;

    public function getDirection(): string;

    public function getTenant(): string;

    public function getCategory(): string;

    public function getAccount(): string;

    public function getSubject(): ?string;

    public function getDestinationTag(): ?string;

    public function getRpCategory(): string;

    public function getStrategy(): string;

    public function getStrategyParams(): ?string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getActivationTime(): \DateTimeInterface;

    public function getWeight(): float;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeInterface;

    public function setOutgoingRouting(?OutgoingRoutingInterface $outgoingRouting = null): static;

    public function getOutgoingRouting(): ?OutgoingRoutingInterface;

    public function isInitialized(): bool;
}
