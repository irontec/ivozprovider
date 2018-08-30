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
     * @deprecated
     * Set lcrId
     *
     * @param integer $lcrId
     *
     * @return self
     */
    public function setLcrId($lcrId);

    /**
     * Get lcrId
     *
     * @return integer
     */
    public function getLcrId();

    /**
     * @deprecated
     * Set priority
     *
     * @param integer $priority
     *
     * @return self
     */
    public function setPriority($priority);

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority();

    /**
     * @deprecated
     * Set weight
     *
     * @param integer $weight
     *
     * @return self
     */
    public function setWeight($weight);

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight();

    /**
     * Set rule
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface $rule
     *
     * @return self
     */
    public function setRule(\Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface $rule);

    /**
     * Get rule
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface
     */
    public function getRule();

    /**
     * Set gw
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface $gw
     *
     * @return self
     */
    public function setGw(\Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface $gw);

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
     * @return self
     */
    public function setOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting = null);

    /**
     * Get outgoingRouting
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface
     */
    public function getOutgoingRouting();

}

