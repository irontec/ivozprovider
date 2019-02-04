<?php

namespace Ivoz\Cgr\Domain\Model\TpLcrRule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface TpLcrRuleInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid();

    /**
     * Get direction
     *
     * @return string
     */
    public function getDirection();

    /**
     * Get tenant
     *
     * @return string
     */
    public function getTenant();

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory();

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount();

    /**
     * Get subject
     *
     * @return string | null
     */
    public function getSubject();

    /**
     * Get destinationTag
     *
     * @return string | null
     */
    public function getDestinationTag();

    /**
     * Get rpCategory
     *
     * @return string
     */
    public function getRpCategory();

    /**
     * Get strategy
     *
     * @return string
     */
    public function getStrategy();

    /**
     * Get strategyParams
     *
     * @return string | null
     */
    public function getStrategyParams();

    /**
     * Get activationTime
     *
     * @return \DateTime
     */
    public function getActivationTime();

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight();

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

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
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface | null
     */
    public function getOutgoingRouting();
}
