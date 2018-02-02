<?php

namespace Ivoz\Cgr\Domain\Model\TpCdr;

use Ivoz\Core\Domain\Model\EntityInterface;

interface TpCdrInterface extends EntityInterface
{
    public function __toString();

    /**
     * Set cgrid
     *
     * @param string $cgrid
     *
     * @return self
     */
    public function setCgrid($cgrid);

    /**
     * Get cgrid
     *
     * @return string
     */
    public function getCgrid();

    /**
     * Set runId
     *
     * @param string $runId
     *
     * @return self
     */
    public function setRunId($runId);

    /**
     * Get runId
     *
     * @return string
     */
    public function getRunId();

    /**
     * Set originHost
     *
     * @param string $originHost
     *
     * @return self
     */
    public function setOriginHost($originHost);

    /**
     * Get originHost
     *
     * @return string
     */
    public function getOriginHost();

    /**
     * Set source
     *
     * @param string $source
     *
     * @return self
     */
    public function setSource($source);

    /**
     * Get source
     *
     * @return string
     */
    public function getSource();

    /**
     * Set originId
     *
     * @param string $originId
     *
     * @return self
     */
    public function setOriginId($originId);

    /**
     * Get originId
     *
     * @return string
     */
    public function getOriginId();

    /**
     * Set tor
     *
     * @param string $tor
     *
     * @return self
     */
    public function setTor($tor);

    /**
     * Get tor
     *
     * @return string
     */
    public function getTor();

    /**
     * Set requestType
     *
     * @param string $requestType
     *
     * @return self
     */
    public function setRequestType($requestType);

    /**
     * Get requestType
     *
     * @return string
     */
    public function getRequestType();

    /**
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
     * Set subject
     *
     * @param string $subject
     *
     * @return self
     */
    public function setSubject($subject);

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject();

    /**
     * Set destination
     *
     * @param string $destination
     *
     * @return self
     */
    public function setDestination($destination);

    /**
     * Get destination
     *
     * @return string
     */
    public function getDestination();

    /**
     * Set setupTime
     *
     * @param \DateTime $setupTime
     *
     * @return self
     */
    public function setSetupTime($setupTime);

    /**
     * Get setupTime
     *
     * @return \DateTime
     */
    public function getSetupTime();

    /**
     * Set answerTime
     *
     * @param \DateTime $answerTime
     *
     * @return self
     */
    public function setAnswerTime($answerTime);

    /**
     * Get answerTime
     *
     * @return \DateTime
     */
    public function getAnswerTime();

    /**
     * Set usage
     *
     * @param integer $usage
     *
     * @return self
     */
    public function setUsage($usage);

    /**
     * Get usage
     *
     * @return integer
     */
    public function getUsage();

    /**
     * Set extraFields
     *
     * @param string $extraFields
     *
     * @return self
     */
    public function setExtraFields($extraFields);

    /**
     * Get extraFields
     *
     * @return string
     */
    public function getExtraFields();

    /**
     * Set costSource
     *
     * @param string $costSource
     *
     * @return self
     */
    public function setCostSource($costSource);

    /**
     * Get costSource
     *
     * @return string
     */
    public function getCostSource();

    /**
     * Set cost
     *
     * @param string $cost
     *
     * @return self
     */
    public function setCost($cost);

    /**
     * Get cost
     *
     * @return string
     */
    public function getCost();

    /**
     * Set costDetails
     *
     * @param string $costDetails
     *
     * @return self
     */
    public function setCostDetails($costDetails);

    /**
     * Get costDetails
     *
     * @return string
     */
    public function getCostDetails();

    /**
     * Set extraInfo
     *
     * @param string $extraInfo
     *
     * @return self
     */
    public function setExtraInfo($extraInfo);

    /**
     * Get extraInfo
     *
     * @return string
     */
    public function getExtraInfo();

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt = null);

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt($updatedAt = null);

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return self
     */
    public function setDeletedAt($deletedAt = null);

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt();

}

