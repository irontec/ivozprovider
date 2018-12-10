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
    public function getTpid();

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag();

    /**
     * Get queueLength
     *
     * @return integer
     */
    public function getQueueLength();

    /**
     * Get timeWindow
     *
     * @return string
     */
    public function getTimeWindow();

    /**
     * Get saveInterval
     *
     * @return string
     */
    public function getSaveInterval();

    /**
     * Get metrics
     *
     * @return string
     */
    public function getMetrics();

    /**
     * Get setupInterval
     *
     * @return string
     */
    public function getSetupInterval();

    /**
     * Get tors
     *
     * @return string
     */
    public function getTors();

    /**
     * Get cdrHosts
     *
     * @return string
     */
    public function getCdrHosts();

    /**
     * Get cdrSources
     *
     * @return string
     */
    public function getCdrSources();

    /**
     * Get reqTypes
     *
     * @return string
     */
    public function getReqTypes();

    /**
     * Get directions
     *
     * @return string
     */
    public function getDirections();

    /**
     * Get tenants
     *
     * @return string
     */
    public function getTenants();

    /**
     * Get categories
     *
     * @return string
     */
    public function getCategories();

    /**
     * Get accounts
     *
     * @return string
     */
    public function getAccounts();

    /**
     * Get subjects
     *
     * @return string
     */
    public function getSubjects();

    /**
     * Get destinationIds
     *
     * @return string
     */
    public function getDestinationIds();

    /**
     * Get ppdInterval
     *
     * @return string
     */
    public function getPpdInterval();

    /**
     * Get usageInterval
     *
     * @return string
     */
    public function getUsageInterval();

    /**
     * Get suppliers
     *
     * @return string
     */
    public function getSuppliers();

    /**
     * Get disconnectCauses
     *
     * @return string
     */
    public function getDisconnectCauses();

    /**
     * Get mediationRunids
     *
     * @return string
     */
    public function getMediationRunids();

    /**
     * Get ratedAccounts
     *
     * @return string
     */
    public function getRatedAccounts();

    /**
     * Get ratedSubjects
     *
     * @return string
     */
    public function getRatedSubjects();

    /**
     * Get costInterval
     *
     * @return string
     */
    public function getCostInterval();

    /**
     * Get actionTriggers
     *
     * @return string
     */
    public function getActionTriggers();

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier
     *
     * @return self
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null);

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    public function getCarrier();
}
