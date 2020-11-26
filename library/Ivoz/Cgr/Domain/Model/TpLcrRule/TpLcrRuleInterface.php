<?php

namespace Ivoz\Cgr\Domain\Model\TpLcrRule;

use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function getSubject(): ?string;

    /**
     * Get destinationTag
     *
     * @return string | null
     */
    public function getDestinationTag(): ?string;

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
    public function getStrategyParams(): ?string;

    /**
     * Get activationTime
     *
     * @return \DateTimeInterface
     */
    public function getActivationTime(): \DateTimeInterface;

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight(): float;

    /**
     * Get createdAt
     *
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * Set outgoingRouting
     *
     * @param OutgoingRouting | null
     *
     * @return static
     */
    public function setOutgoingRouting(?OutgoingRouting $outgoingRouting = null): TpLcrRuleInterface;

    /**
     * Get outgoingRouting
     *
     * @return OutgoingRouting | null
     */
    public function getOutgoingRouting(): ?OutgoingRouting;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
