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
     * @return \DateTime | null
     */
    public function getStartTime();

    /**
     * @return string
     */
    public function getRatingPlanTag(): string;

    /**
     * @return string
     */
    public function getMatchedDestinationTag(): string;

    /**
     * Get cgrid
     *
     * @return string
     */
    public function getCgrid(): string;

    /**
     * Get runId
     *
     * @return string
     */
    public function getRunId(): string;

    /**
     * Get originHost
     *
     * @return string
     */
    public function getOriginHost(): string;

    /**
     * Get source
     *
     * @return string
     */
    public function getSource(): string;

    /**
     * Get originId
     *
     * @return string
     */
    public function getOriginId(): string;

    /**
     * Get tor
     *
     * @return string
     */
    public function getTor(): string;

    /**
     * Get requestType
     *
     * @return string
     */
    public function getRequestType(): string;

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
     * @return string
     */
    public function getSubject(): string;

    /**
     * Get destination
     *
     * @return string
     */
    public function getDestination(): string;

    /**
     * Get setupTime
     *
     * @return \DateTime
     */
    public function getSetupTime(): \DateTime;

    /**
     * Get answerTime
     *
     * @return \DateTime
     */
    public function getAnswerTime(): \DateTime;

    /**
     * Get usage
     *
     * @return integer
     */
    public function getUsage(): int;

    /**
     * Get extraFields
     *
     * @return string
     */
    public function getExtraFields(): string;

    /**
     * Get costSource
     *
     * @return string
     */
    public function getCostSource(): string;

    /**
     * Get cost
     *
     * @return float
     */
    public function getCost(): float;

    /**
     * Get costDetails
     *
     * @return array
     */
    public function getCostDetails(): array;

    /**
     * Get extraInfo
     *
     * @return string
     */
    public function getExtraInfo(): string;

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

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
