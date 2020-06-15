<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRuleTarget;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
     * @return integer
     */
    public function getLcrId(): int;

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority(): int;

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight(): int;

    /**
     * Get rule
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface
     */
    public function getRule();

    /**
     * Get gw
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface
     */
    public function getGw();

    /**
     * Set outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     *
     * @return static
     */
    public function setOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting);

    /**
     * Get outgoingRouting
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface
     */
    public function getOutgoingRouting();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
