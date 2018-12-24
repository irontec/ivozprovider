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
     * Get tpid
     *
     * @return string
     */
    public function getTpid();

    /**
     * Get loadid
     *
     * @return string
     */
    public function getLoadid();

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
     * Get destinationIds
     *
     * @return string | null
     */
    public function getDestinationIds();

    /**
     * Get runid
     *
     * @return string
     */
    public function getRunid();

    /**
     * Get runFilters
     *
     * @return string
     */
    public function getRunFilters();

    /**
     * Get reqTypeField
     *
     * @return string
     */
    public function getReqTypeField();

    /**
     * Get directionField
     *
     * @return string
     */
    public function getDirectionField();

    /**
     * Get tenantField
     *
     * @return string
     */
    public function getTenantField();

    /**
     * Get categoryField
     *
     * @return string
     */
    public function getCategoryField();

    /**
     * Get accountField
     *
     * @return string
     */
    public function getAccountField();

    /**
     * Get subjectField
     *
     * @return string
     */
    public function getSubjectField();

    /**
     * Get destinationField
     *
     * @return string
     */
    public function getDestinationField();

    /**
     * Get setupTimeField
     *
     * @return string
     */
    public function getSetupTimeField();

    /**
     * Get pddField
     *
     * @return string
     */
    public function getPddField();

    /**
     * Get answerTimeField
     *
     * @return string
     */
    public function getAnswerTimeField();

    /**
     * Get usageField
     *
     * @return string
     */
    public function getUsageField();

    /**
     * Get supplierField
     *
     * @return string
     */
    public function getSupplierField();

    /**
     * Get disconnectCauseField
     *
     * @return string
     */
    public function getDisconnectCauseField();

    /**
     * Get ratedTimeField
     *
     * @return string
     */
    public function getRatedTimeField();

    /**
     * Get costField
     *
     * @return string
     */
    public function getCostField();

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
