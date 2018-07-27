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
     * Set tpid
     *
     * @param string $tpid
     *
     * @return self
     */
    public function setTpid($tpid);

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid();

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return self
     */
    public function setTag($tag);

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag();

    /**
     * Set queueLength
     *
     * @param integer $queueLength
     *
     * @return self
     */
    public function setQueueLength($queueLength);

    /**
     * Get queueLength
     *
     * @return integer
     */
    public function getQueueLength();

    /**
     * Set timeWindow
     *
     * @param string $timeWindow
     *
     * @return self
     */
    public function setTimeWindow($timeWindow);

    /**
     * Get timeWindow
     *
     * @return string
     */
    public function getTimeWindow();

    /**
     * Set saveInterval
     *
     * @param string $saveInterval
     *
     * @return self
     */
    public function setSaveInterval($saveInterval);

    /**
     * Get saveInterval
     *
     * @return string
     */
    public function getSaveInterval();

    /**
     * Set metrics
     *
     * @param string $metrics
     *
     * @return self
     */
    public function setMetrics($metrics);

    /**
     * Get metrics
     *
     * @return string
     */
    public function getMetrics();

    /**
     * Set setupInterval
     *
     * @param string $setupInterval
     *
     * @return self
     */
    public function setSetupInterval($setupInterval);

    /**
     * Get setupInterval
     *
     * @return string
     */
    public function getSetupInterval();

    /**
     * Set tors
     *
     * @param string $tors
     *
     * @return self
     */
    public function setTors($tors);

    /**
     * Get tors
     *
     * @return string
     */
    public function getTors();

    /**
     * Set cdrHosts
     *
     * @param string $cdrHosts
     *
     * @return self
     */
    public function setCdrHosts($cdrHosts);

    /**
     * Get cdrHosts
     *
     * @return string
     */
    public function getCdrHosts();

    /**
     * Set cdrSources
     *
     * @param string $cdrSources
     *
     * @return self
     */
    public function setCdrSources($cdrSources);

    /**
     * Get cdrSources
     *
     * @return string
     */
    public function getCdrSources();

    /**
     * Set reqTypes
     *
     * @param string $reqTypes
     *
     * @return self
     */
    public function setReqTypes($reqTypes);

    /**
     * Get reqTypes
     *
     * @return string
     */
    public function getReqTypes();

    /**
     * Set directions
     *
     * @param string $directions
     *
     * @return self
     */
    public function setDirections($directions);

    /**
     * Get directions
     *
     * @return string
     */
    public function getDirections();

    /**
     * Set tenants
     *
     * @param string $tenants
     *
     * @return self
     */
    public function setTenants($tenants);

    /**
     * Get tenants
     *
     * @return string
     */
    public function getTenants();

    /**
     * Set categories
     *
     * @param string $categories
     *
     * @return self
     */
    public function setCategories($categories);

    /**
     * Get categories
     *
     * @return string
     */
    public function getCategories();

    /**
     * Set accounts
     *
     * @param string $accounts
     *
     * @return self
     */
    public function setAccounts($accounts);

    /**
     * Get accounts
     *
     * @return string
     */
    public function getAccounts();

    /**
     * Set subjects
     *
     * @param string $subjects
     *
     * @return self
     */
    public function setSubjects($subjects);

    /**
     * Get subjects
     *
     * @return string
     */
    public function getSubjects();

    /**
     * Set destinationIds
     *
     * @param string $destinationIds
     *
     * @return self
     */
    public function setDestinationIds($destinationIds);

    /**
     * Get destinationIds
     *
     * @return string
     */
    public function getDestinationIds();

    /**
     * Set ppdInterval
     *
     * @param string $ppdInterval
     *
     * @return self
     */
    public function setPpdInterval($ppdInterval);

    /**
     * Get ppdInterval
     *
     * @return string
     */
    public function getPpdInterval();

    /**
     * Set usageInterval
     *
     * @param string $usageInterval
     *
     * @return self
     */
    public function setUsageInterval($usageInterval);

    /**
     * Get usageInterval
     *
     * @return string
     */
    public function getUsageInterval();

    /**
     * Set suppliers
     *
     * @param string $suppliers
     *
     * @return self
     */
    public function setSuppliers($suppliers);

    /**
     * Get suppliers
     *
     * @return string
     */
    public function getSuppliers();

    /**
     * Set disconnectCauses
     *
     * @param string $disconnectCauses
     *
     * @return self
     */
    public function setDisconnectCauses($disconnectCauses);

    /**
     * Get disconnectCauses
     *
     * @return string
     */
    public function getDisconnectCauses();

    /**
     * Set mediationRunids
     *
     * @param string $mediationRunids
     *
     * @return self
     */
    public function setMediationRunids($mediationRunids);

    /**
     * Get mediationRunids
     *
     * @return string
     */
    public function getMediationRunids();

    /**
     * Set ratedAccounts
     *
     * @param string $ratedAccounts
     *
     * @return self
     */
    public function setRatedAccounts($ratedAccounts);

    /**
     * Get ratedAccounts
     *
     * @return string
     */
    public function getRatedAccounts();

    /**
     * Set ratedSubjects
     *
     * @param string $ratedSubjects
     *
     * @return self
     */
    public function setRatedSubjects($ratedSubjects);

    /**
     * Get ratedSubjects
     *
     * @return string
     */
    public function getRatedSubjects();

    /**
     * Set costInterval
     *
     * @param string $costInterval
     *
     * @return self
     */
    public function setCostInterval($costInterval);

    /**
     * Get costInterval
     *
     * @return string
     */
    public function getCostInterval();

    /**
     * Set actionTriggers
     *
     * @param string $actionTriggers
     *
     * @return self
     */
    public function setActionTriggers($actionTriggers);

    /**
     * Get actionTriggers
     *
     * @return string
     */
    public function getActionTriggers();

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt);

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

