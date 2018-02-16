<?php

namespace Ivoz\Provider\Domain\Model\LcrRuleTarget;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface LcrRuleTargetInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
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
     * @param \Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface $rule
     *
     * @return self
     */
    public function setRule(\Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface $rule);

    /**
     * Get rule
     *
     * @return \Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface
     */
    public function getRule();

    /**
     * Set gw
     *
     * @param \Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayInterface $gw
     *
     * @return self
     */
    public function setGw(\Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayInterface $gw);

    /**
     * Get gw
     *
     * @return \Ivoz\Provider\Domain\Model\LcrGateway\LcrGatewayInterface
     */
    public function getGw();

    /**
     * Set outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     *
     * @return self
     */
    public function setOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting);

    /**
     * Get outgoingRouting
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface
     */
    public function getOutgoingRouting();

}

