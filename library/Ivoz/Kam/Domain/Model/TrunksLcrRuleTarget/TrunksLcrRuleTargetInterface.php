<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget;

use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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

    /**
     * Get lcrId
     *
     * @return int
     */
    public function getLcrId(): int;

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority(): int;

    /**
     * Get weight
     *
     * @return int
     */
    public function getWeight(): int;

    /**
     * Get rule
     *
     * @return TrunksLcrRuleInterface
     */
    public function getRule(): TrunksLcrRuleInterface;

    /**
     * Get gw
     *
     * @return TrunksLcrGatewayInterface
     */
    public function getGw(): TrunksLcrGatewayInterface;

    /**
     * Set outgoingRouting
     *
     * @param OutgoingRoutingInterface
     *
     * @return static
     */
    public function setOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): TrunksLcrRuleTargetInterface;

    /**
     * Get outgoingRouting
     *
     * @return OutgoingRoutingInterface
     */
    public function getOutgoingRouting(): OutgoingRoutingInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
