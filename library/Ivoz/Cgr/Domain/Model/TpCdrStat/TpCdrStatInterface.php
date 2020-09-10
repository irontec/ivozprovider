<?php

namespace Ivoz\Cgr\Domain\Model\TpCdrStat;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface TpCdrStatInterface extends LoggableEntityInterface
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
     * Get tag
     *
     * @return string
     */
    public function getTag(): string;

    /**
     * Get queueLength
     *
     * @return integer
     */
    public function getQueueLength(): int;

    /**
     * Get timeWindow
     *
     * @return string
     */
    public function getTimeWindow(): string;

    /**
     * Get saveInterval
     *
     * @return string
     */
    public function getSaveInterval(): string;

    /**
     * Get metrics
     *
     * @return string
     */
    public function getMetrics(): string;

    /**
     * Get setupInterval
     *
     * @return string
     */
    public function getSetupInterval(): string;

    /**
     * Get tors
     *
     * @return string
     */
    public function getTors(): string;

    /**
     * Get cdrHosts
     *
     * @return string
     */
    public function getCdrHosts(): string;

    /**
     * Get cdrSources
     *
     * @return string
     */
    public function getCdrSources(): string;

    /**
     * Get reqTypes
     *
     * @return string
     */
    public function getReqTypes(): string;

    /**
     * Get directions
     *
     * @return string
     */
    public function getDirections(): string;

    /**
     * Get tenants
     *
     * @return string
     */
    public function getTenants(): string;

    /**
     * Get categories
     *
     * @return string
     */
    public function getCategories(): string;

    /**
     * Get accounts
     *
     * @return string
     */
    public function getAccounts(): string;

    /**
     * Get subjects
     *
     * @return string
     */
    public function getSubjects(): string;

    /**
     * Get destinationIds
     *
     * @return string
     */
    public function getDestinationIds(): string;

    /**
     * Get ppdInterval
     *
     * @return string
     */
    public function getPpdInterval(): string;

    /**
     * Get usageInterval
     *
     * @return string
     */
    public function getUsageInterval(): string;

    /**
     * Get suppliers
     *
     * @return string
     */
    public function getSuppliers(): string;

    /**
     * Get disconnectCauses
     *
     * @return string
     */
    public function getDisconnectCauses(): string;

    /**
     * Get mediationRunids
     *
     * @return string
     */
    public function getMediationRunids(): string;

    /**
     * Get ratedAccounts
     *
     * @return string
     */
    public function getRatedAccounts(): string;

    /**
     * Get ratedSubjects
     *
     * @return string
     */
    public function getRatedSubjects(): string;

    /**
     * Get costInterval
     *
     * @return string
     */
    public function getCostInterval(): string;

    /**
     * Get actionTriggers
     *
     * @return string
     */
    public function getActionTriggers(): string;

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime;

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier
     *
     * @return static
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier);

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    public function getCarrier();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
