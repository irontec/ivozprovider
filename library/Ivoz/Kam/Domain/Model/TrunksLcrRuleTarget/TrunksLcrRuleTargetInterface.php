<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

/**
* TrunksLcrRuleTargetInterface
*/
interface TrunksLcrRuleTargetInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function getLcrId(): int;

    public function getPriority(): int;

    public function getWeight(): int;

    public function getRule(): TrunksLcrRuleInterface;

    public function getGw(): TrunksLcrGatewayInterface;

    public function setOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): static;

    public function getOutgoingRouting(): OutgoingRoutingInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
