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
    public function getTpid(): string;

    /**
     * Get loadid
     *
     * @return string
     */
    public function getLoadid(): string;

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
    public function getRunid(): string;

    /**
     * Get runFilters
     *
     * @return string
     */
    public function getRunFilters(): string;

    /**
     * Get reqTypeField
     *
     * @return string
     */
    public function getReqTypeField(): string;

    /**
     * Get directionField
     *
     * @return string
     */
    public function getDirectionField(): string;

    /**
     * Get tenantField
     *
     * @return string
     */
    public function getTenantField(): string;

    /**
     * Get categoryField
     *
     * @return string
     */
    public function getCategoryField(): string;

    /**
     * Get accountField
     *
     * @return string
     */
    public function getAccountField(): string;

    /**
     * Get subjectField
     *
     * @return string
     */
    public function getSubjectField(): string;

    /**
     * Get destinationField
     *
     * @return string
     */
    public function getDestinationField(): string;

    /**
     * Get setupTimeField
     *
     * @return string
     */
    public function getSetupTimeField(): string;

    /**
     * Get pddField
     *
     * @return string
     */
    public function getPddField(): string;

    /**
     * Get answerTimeField
     *
     * @return string
     */
    public function getAnswerTimeField(): string;

    /**
     * Get usageField
     *
     * @return string
     */
    public function getUsageField(): string;

    /**
     * Get supplierField
     *
     * @return string
     */
    public function getSupplierField(): string;

    /**
     * Get disconnectCauseField
     *
     * @return string
     */
    public function getDisconnectCauseField(): string;

    /**
     * Get ratedTimeField
     *
     * @return string
     */
    public function getRatedTimeField(): string;

    /**
     * Get costField
     *
     * @return string
     */
    public function getCostField(): string;

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime;

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
