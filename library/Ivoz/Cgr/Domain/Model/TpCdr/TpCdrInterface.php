<?php

namespace Ivoz\Cgr\Domain\Model\TpCdr;

use Ivoz\Core\Domain\Model\EntityInterface;

interface TpCdrInterface extends EntityInterface
{
    public function getDuration();

    /**
     * @return array|null
     */
    public function getCostDetailsFirstTimespan();

    /**
     * @return \DateTime
     */
    public function getStartTime();

    /**
     * @return string
     */
    public function getRatingPlanTag();

    /**
     * @return string
     */
    public function getMatchedDestinationTag();

    /**
     * Get cgrid
     *
     * @return string
     */
    public function getCgrid();

    /**
     * Get runId
     *
     * @return string
     */
    public function getRunId();

    /**
     * Get originHost
     *
     * @return string
     */
    public function getOriginHost();

    /**
     * Get source
     *
     * @return string
     */
    public function getSource();

    /**
     * Get originId
     *
     * @return string
     */
    public function getOriginId();

    /**
     * Get tor
     *
     * @return string
     */
    public function getTor();

    /**
     * Get requestType
     *
     * @return string
     */
    public function getRequestType();

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
     * @return string
     */
    public function getSubject();

    /**
     * Get destination
     *
     * @return string
     */
    public function getDestination();

    /**
     * Get setupTime
     *
     * @return \DateTime
     */
    public function getSetupTime();

    /**
     * Get answerTime
     *
     * @return \DateTime
     */
    public function getAnswerTime();

    /**
     * Get usage
     *
     * @return integer
     */
    public function getUsage();

    /**
     * Get extraFields
     *
     * @return string
     */
    public function getExtraFields();

    /**
     * Get costSource
     *
     * @return string
     */
    public function getCostSource();

    /**
     * Get cost
     *
     * @return float
     */
    public function getCost();

    /**
     * Get costDetails
     *
     * @return array
     */
    public function getCostDetails();

    /**
     * Get extraInfo
     *
     * @return string
     */
    public function getExtraInfo();

    /**
     * Get createdAt
     *
     * @return \DateTime | null
     */
    public function getCreatedAt();

    /**
     * Get updatedAt
     *
     * @return \DateTime | null
     */
    public function getUpdatedAt();

    /**
     * Get deletedAt
     *
     * @return \DateTime | null
     */
    public function getDeletedAt();
}
