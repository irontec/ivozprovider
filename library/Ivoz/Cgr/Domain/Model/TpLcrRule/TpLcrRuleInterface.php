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
    public function getTpid(): string;

    /**
     * Get direction
     *
     * @return string
     */
    public function getDirection(): string;

    /**
     * Get tenant
     *
     * @return string
     */
    public function getTenant(): string;

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory(): string;

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount(): string;

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
    public function getRpCategory(): string;

    /**
     * Get strategy
     *
     * @return string
     */
    public function getStrategy(): string;

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
    public function getActivationTime(): \DateTime;

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight(): float;

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime;

    /**
     * Set outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting | null
     *
     * @return static
     */
    public function setOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting = null);

    /**
     * Get outgoingRouting
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface | null
     */
    public function getOutgoingRouting();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
