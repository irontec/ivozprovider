<?php

namespace Ivoz\Cgr\Domain\Model\TpDerivedCharger;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface TpDerivedChargerInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @deprecated
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
     * @deprecated
     * Set loadid
     *
     * @param string $loadid
     *
     * @return self
     */
    public function setLoadid($loadid);

    /**
     * Get loadid
     *
     * @return string
     */
    public function getLoadid();

    /**
     * @deprecated
     * Set direction
     *
     * @param string $direction
     *
     * @return self
     */
    public function setDirection($direction);

    /**
     * Get direction
     *
     * @return string
     */
    public function getDirection();

    /**
     * @deprecated
     * Set tenant
     *
     * @param string $tenant
     *
     * @return self
     */
    public function setTenant($tenant);

    /**
     * Get tenant
     *
     * @return string
     */
    public function getTenant();

    /**
     * @deprecated
     * Set category
     *
     * @param string $category
     *
     * @return self
     */
    public function setCategory($category);

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory();

    /**
     * @deprecated
     * Set account
     *
     * @param string $account
     *
     * @return self
     */
    public function setAccount($account);

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount();

    /**
     * @deprecated
     * Set subject
     *
     * @param string $subject
     *
     * @return self
     */
    public function setSubject($subject = null);

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject();

    /**
     * @deprecated
     * Set destinationIds
     *
     * @param string $destinationIds
     *
     * @return self
     */
    public function setDestinationIds($destinationIds = null);

    /**
     * Get destinationIds
     *
     * @return string
     */
    public function getDestinationIds();

    /**
     * @deprecated
     * Set runid
     *
     * @param string $runid
     *
     * @return self
     */
    public function setRunid($runid);

    /**
     * Get runid
     *
     * @return string
     */
    public function getRunid();

    /**
     * @deprecated
     * Set runFilters
     *
     * @param string $runFilters
     *
     * @return self
     */
    public function setRunFilters($runFilters);

    /**
     * Get runFilters
     *
     * @return string
     */
    public function getRunFilters();

    /**
     * @deprecated
     * Set reqTypeField
     *
     * @param string $reqTypeField
     *
     * @return self
     */
    public function setReqTypeField($reqTypeField);

    /**
     * Get reqTypeField
     *
     * @return string
     */
    public function getReqTypeField();

    /**
     * @deprecated
     * Set directionField
     *
     * @param string $directionField
     *
     * @return self
     */
    public function setDirectionField($directionField);

    /**
     * Get directionField
     *
     * @return string
     */
    public function getDirectionField();

    /**
     * @deprecated
     * Set tenantField
     *
     * @param string $tenantField
     *
     * @return self
     */
    public function setTenantField($tenantField);

    /**
     * Get tenantField
     *
     * @return string
     */
    public function getTenantField();

    /**
     * @deprecated
     * Set categoryField
     *
     * @param string $categoryField
     *
     * @return self
     */
    public function setCategoryField($categoryField);

    /**
     * Get categoryField
     *
     * @return string
     */
    public function getCategoryField();

    /**
     * @deprecated
     * Set accountField
     *
     * @param string $accountField
     *
     * @return self
     */
    public function setAccountField($accountField);

    /**
     * Get accountField
     *
     * @return string
     */
    public function getAccountField();

    /**
     * @deprecated
     * Set subjectField
     *
     * @param string $subjectField
     *
     * @return self
     */
    public function setSubjectField($subjectField);

    /**
     * Get subjectField
     *
     * @return string
     */
    public function getSubjectField();

    /**
     * @deprecated
     * Set destinationField
     *
     * @param string $destinationField
     *
     * @return self
     */
    public function setDestinationField($destinationField);

    /**
     * Get destinationField
     *
     * @return string
     */
    public function getDestinationField();

    /**
     * @deprecated
     * Set setupTimeField
     *
     * @param string $setupTimeField
     *
     * @return self
     */
    public function setSetupTimeField($setupTimeField);

    /**
     * Get setupTimeField
     *
     * @return string
     */
    public function getSetupTimeField();

    /**
     * @deprecated
     * Set pddField
     *
     * @param string $pddField
     *
     * @return self
     */
    public function setPddField($pddField);

    /**
     * Get pddField
     *
     * @return string
     */
    public function getPddField();

    /**
     * @deprecated
     * Set answerTimeField
     *
     * @param string $answerTimeField
     *
     * @return self
     */
    public function setAnswerTimeField($answerTimeField);

    /**
     * Get answerTimeField
     *
     * @return string
     */
    public function getAnswerTimeField();

    /**
     * @deprecated
     * Set usageField
     *
     * @param string $usageField
     *
     * @return self
     */
    public function setUsageField($usageField);

    /**
     * Get usageField
     *
     * @return string
     */
    public function getUsageField();

    /**
     * @deprecated
     * Set supplierField
     *
     * @param string $supplierField
     *
     * @return self
     */
    public function setSupplierField($supplierField);

    /**
     * Get supplierField
     *
     * @return string
     */
    public function getSupplierField();

    /**
     * @deprecated
     * Set disconnectCauseField
     *
     * @param string $disconnectCauseField
     *
     * @return self
     */
    public function setDisconnectCauseField($disconnectCauseField);

    /**
     * Get disconnectCauseField
     *
     * @return string
     */
    public function getDisconnectCauseField();

    /**
     * @deprecated
     * Set ratedTimeField
     *
     * @param string $ratedTimeField
     *
     * @return self
     */
    public function setRatedTimeField($ratedTimeField);

    /**
     * Get ratedTimeField
     *
     * @return string
     */
    public function getRatedTimeField();

    /**
     * @deprecated
     * Set costField
     *
     * @param string $costField
     *
     * @return self
     */
    public function setCostField($costField);

    /**
     * Get costField
     *
     * @return string
     */
    public function getCostField();

    /**
     * @deprecated
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
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

}

