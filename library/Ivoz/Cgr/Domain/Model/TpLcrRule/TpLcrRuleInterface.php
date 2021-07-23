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
    public function getChangeSet();

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

    public function getActivationTime(): \DateTime;

    public function getWeight(): float;

    public function getCreatedAt(): \DateTime;

    public function setOutgoingRouting(?OutgoingRoutingInterface $outgoingRouting = null): static;

    public function getOutgoingRouting(): ?OutgoingRoutingInterface;

    public function isInitialized(): bool;
}
